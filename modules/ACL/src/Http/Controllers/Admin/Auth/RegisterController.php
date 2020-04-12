<?php

namespace ACL\Http\Controllers\Admin\Auth;

use ACL\Models\VerifyUser;
use ACL\Notifications\VerifyEmail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = $this->validator($request->all());
            if($validator->fails()) {
                return back()->withErrors($validator->errors());
            }
            event(new Registered($user = $this->create($request->all())));
            $this->verify($user);
            $user->notify(new VerifyEmail($user));
            $this->guard()->login($user);
            DB::commit();
            session()->flash('success', 'Register successfully, please verify email');
            return $this->registered($request, $user)
                ?: redirect($this->redirectPath());
        } catch (\Exception $exception) {
            DB::rollBack();
            session()->flash('errors', $exception->getMessage());
            return back();
        }
    }

    private function verify($user) {
        $data = [
            'user_id' => $user->id,
            'code' => uniqid() . str_random(10)
        ];
        VerifyUser::create($data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
