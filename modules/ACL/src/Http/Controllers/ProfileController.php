<?php

namespace ACL\Http\Controllers;

use ACL\Http\Requests\DisableOtpRequest;
use ACL\Http\Requests\EnableOtpRequest;
use ACL\Models\VerifyUser;
use ACL\Http\Repositories\UserRepositoryEloquent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $repository;
    private $googleAuthenticator;

    public function __construct(UserRepositoryEloquent $repository)
    {
        $this->repository = $repository;
        $this->googleAuthenticator = new \PHPGangsta_GoogleAuthenticator();
    }
    public function index($id)
    {
        $user = $this->repository->find($id);
        return view('acl::users.profile', compact($user));
    }

    public function createGoogleOtp(Request $request) {
        $user = $request->user();
        if ($user->google_authentication) {
            $secret = $user->google_authentication;
        } else {
            $verify = auth()->user()->verifyUser;
            if(empty($verify)) {
                VerifyUser::create(['user_id' => auth()->id(), 'code' => uniqid() . str_random(10)]);
            }
            $secret = $this->googleAuthenticator->createSecret();
            auth()->user()->verifyUser()->update(['google_authentication' => $secret]);
        }
        $qrCodeUrl = $this->googleAuthenticator->getQRCodeGoogleUrl($user->email, $secret, "CuongPm");
        return response()->json(array('key' => $secret,'url' => $qrCodeUrl));
    }

    public function enableOtp(EnableOtpRequest $request) {
        auth()->user()->verifyUser()->update(['otp_verified' => 1]);
        return response()->json(true);
    }

    public function disableOtp(DisableOtpRequest $request) {
        auth()->user()->verifyUser()->update(['otp_verified' => 0]);
        return response()->json(true);
    }
}
