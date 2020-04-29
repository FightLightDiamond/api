<?php

namespace ACL\Http\Controllers\Auth\API;


use ACL\Http\Resources\LoginResource;
use ACL\Models\Admin;
use App\User;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ServerRequestInterface;
use \Laravel\Passport\Http\Controllers\AccessTokenController as ATC;

/**
 * @group ACL
 *
 * APIs for acl
 */
class LoginController extends ATC
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
     * Login
     *
     * @param ServerRequestInterface $request
     * @return LoginResource|\Illuminate\Http\JsonResponse
     */
    public function login(ServerRequestInterface $request)
    {
        try {
            $tokenResponse = parent::issueToken($request);
            $content = $tokenResponse->getContent();
            $data = json_decode($content, true);

            if (isset($data["error"])) {
                throw new OAuthServerException('The user credentials were incorrect.', 6, 'invalid_credentials', 422);
            }

            $account = $this->getData($request, $data);
            return new LoginResource($account);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 401);
        }
    }

    protected function getAccountData($request)
    {
        $username = $request->getParsedBody()['username'];
        $provider = $request->getParsedBody()['provider'];

        if ($provider === 'users') {
            $account = User::where('email', $username)->where('is_active', 1)->first();
        } else {
            $account = Admin::where('email', $username)->where('is_active', 1)->first();
        }

        if(empty($account)) {
            throw  ValidationException::withMessages([
               'account' => 'Account is inactive'
            ]);
        }

        return $account;
    }

    protected function getData($request, $data)
    {
        $account = $this->getAccountData($request);

        $account = collect($account);
        $account->put('access_token', $data['access_token']);
        $account->put('token_type', $data['token_type']);
        $account->put('expires_in', $data['expires_in']);
        $account->put('refresh_token', $data['refresh_token']);

        return $account;
    }
}
