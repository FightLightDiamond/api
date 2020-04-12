<?php

namespace ACL\Http\Controllers\Auth\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

/**
 * @group ACL
 *
 * APIs for acl
 */
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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

    /**
     * Reset the given user's password.
     *
     * @bodyParam email required The email of the user. Example: phamminhcuong1704bnfrv@gmail.com
     * @bodyParam token required The token of the user. Example: 658fda2f0b79b92b406e4e80d8f5354ecc52e2423f99ea96d436a9e16538a962
     * @bodyParam password required The password of the user. Example: 123456aA@
     * @bodyParam password_confirmation required The password_confirmation of the user. Example: 123456aA@
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */

    public function reset(Request $request)
    {
        $user = $this->valid($request);

        try {
            \DB::beginTransaction();

            $user->password = Hash::make($request->password);
            $user->save();

            \DB::table('password_resets')->where('email', $request->email)->delete();
            \DB::commit();
            return response()->json(['message' => 'Success'], 200);
        } catch (\Exception $exception) {
            \DB::rollback();
            return response()->json(['errors' => [$exception->getMessage()]], 500);
        }
    }

    public function valid($request)
    {
        $validator = Validator::make($request->all(), $this->rules(), $this->validationErrorMessages());

        if ($validator->fails()) {
           throw ValidationException::withMessages(['errors' => $validator->errors()]);
        }

        $user = User::where('email', $request->email)->first();

        if (empty($user)) {
            throw ValidationException::withMessages( ['errors' => ['Email not found']]);
        }

        $reset = \DB::table('password_resets')->where('email', $request->email)->first();

        if (empty($reset)) {
            throw ValidationException::withMessages( ['errors' => ['Email invalid reset password']]);
        }

        $check = Hash::check($request->token, $reset->token);

        if (!$check) {
            throw ValidationException::withMessages( ['errors' => ['Token invalid']]);
        }

        return $user;
    }
}
