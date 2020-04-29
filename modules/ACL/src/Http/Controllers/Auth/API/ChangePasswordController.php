<?php


namespace ACL\Http\Controllers\Auth\API;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangePasswordController extends Controller
{
    public function change()
    {
        $user = auth('api')->user();
        $check = Hash::check(request('password'), $user->password);

        if(!$check) {
            throw ValidationException::withMessages([
                'password' => 'Password incorrect'
            ]);
        }

        try {
            $password = request('new_password');
            $password = Hash::make($password);

            $user->password = $password;
            $user->save();

            return response()->json(['data' => $user]);
        } catch (\Exception $exception) {
            logger($exception->getMessage(), 500);
            return response()->json($exception->getMessage(), 500);
        }
    }
}
