<?php

namespace ACL\Http\Controllers\Auth\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * @group ACL
 *
 * APIs for acl
 */
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
     * Forgot Password
     * @bodyParam email required The email of the user. Example: phamminhcuong1704bnfrv@gmail.com
     * @return \Illuminate\Http\JsonResponse
     */

    public function sendResetLinkEmail(Request $request)
    {
        $input = $request->only('email');

        $validator = Validator::make($input, ['email' => 'required|email']);

        if ($validator->fails()) {
            throw ValidationException::withMessages( ['errors' => $validator->errors()]);
        }

        $user = User::where($input)->first();

        if(empty($user)) {
            throw ValidationException::withMessages( ['errors' => 'Email not found']);
        }

        try {
            $response = $this->broker()->sendResetLink($input);

            if (Password::RESET_LINK_SENT) {
                return response()->json(['data' => $response]);
            }

            return response()->json(['errors' => $response], 500);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
