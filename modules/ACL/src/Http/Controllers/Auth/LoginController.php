<?php

namespace ACL\Http\Controllers\Auth;

use ACL\Events\LogoutEvent;
use IO\Core\Events\OnlineEvent;
use App\Http\Controllers\Controller;
use ACL\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
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
        $this->middleware('guest', ['except' => ['logout', 'spy']]);
    }

    public function showLoginForm()
    {
        return view('acl::auth.login');
    }

    public function login(LoginRequest $request)
    {
        $input = $request->all();
        $remember = isset($input['remember']);
        if ($user = Auth::attempt(['email' => $input['email'], 'password' => $input['password'], 'is_active' => 1], $remember)) {
            event($e = new OnlineEvent(\auth()->user()));
            if (\ACL::isRole('admin')) {
                return redirect()->route('admin');
            }
            return back();
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        event(new LogoutEvent());
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/');
    }

    public function spy(int $id) {
        $this->guard()->logout();
        auth()->loginUsingId($id);
        return back();
    }
}
