<?php

namespace ACL\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController
 * @package ACL\Http\Controllers\Admin\Auth
 */
class LoginController extends Controller
{
    use Authenticatable;

    /**
     * @var string
     */
    protected $redirectTo = '/admin';
    /**
     * @var string
     */
    protected $afterLogout = '/admin';
    /**
     * @var string
     */
    protected $guard = 'admin';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('acl::admin.auth.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only( 'password', 'email');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin');
        }
        session()->flash('error', 'Login fail');
        return back();
    }

    /**
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * @return mixed
     */
    protected function guard()
    {
        return Auth::guard($this->guard);
    }

    /**
     * @return bool
     */
    protected function isAnyGuardLoggedIn()
    {
        $configGuards = config('auth.guards');
        foreach ($configGuards as $guard => $config) {
            if (Auth::guard($guard)->check()) {
                return true;
            }
        }

        return false;
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        if (!$this->isAnyGuardLoggedIn()) {
            $request->session()->invalidate();
        }
        return redirect($this->afterLogout);
    }
}
