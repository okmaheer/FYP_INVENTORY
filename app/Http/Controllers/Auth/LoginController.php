<?php

namespace App\Http\Controllers\Auth;

use App\Enum\CacheEnum;
use App\Enum\RoleEnum;
use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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

//    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show Login Form
     * @return Application|Factory|View
     */
    public function showLoginForm()
    {
        $page_title = trans('auth.login');
        return view('auth.login', compact('page_title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->has('remember');

        if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1], $remember)) {
            $user = Auth::user();
            RoleEnum::getUserRolePermissions($user);
            $request->session()->regenerate();

            if ($user->hasRole(RoleEnum::ROLE_SUPER_ADMIN)) {
                return redirect()->route(RouteServiceProvider::SUPER_ADMIN_LOCATIONS);

            } elseif (!$user->hasRole(RoleEnum::ROLE_SUPER_ADMIN) && isset($user->location)) {
                session()->put(SessionEnum::SESSION_LOCATION_ID, $user->location->id);
                session()->put(SessionEnum::SESSION_BUSINESS_ID, $user->location->business->id);
                CacheEnum::storeLocation($user->location);
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        } else {
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => __('auth.failed')]);
        }
    }

    public function logout(Request $request)
    {
        if (auth()->user()->hasRole(RoleEnum::ROLE_SUPER_ADMIN)) {
            User::find(auth()->user()->id)->update(['location_id' => NULL]);
        }
        session()->forget(SessionEnum::SESSION_BUSINESS_ID);
        session()->forget(SessionEnum::SESSION_LOCATION_ID);
        Cache::forget(CacheEnum::AUTH_ROLES_PERMISSIONS);
        Cache::forget(CacheEnum::AUTH_LOCATION);
        auth()->logout();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
