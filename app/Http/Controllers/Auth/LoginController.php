<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function login(Request $request) {
        $formFields = $request->validate([
            'email' =>'required|email',
            'password' =>'required'
        ]);

        $user = User::where('email', $formFields['email'])->first();
        if ($user) {
            if ($user->status === User::INACTIVE_USER) {
                return back()->withInput()->withErrors(['email' => 'Your account has been disabled.']);
            }

            if (Auth::attempt($formFields)) {
                if (Auth::user()->role == 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('user.home');
                }
            } else {
                return back()->withInput()->withErrors([
                    'email' => ' ',
                    'password' => 'Incorrect email or password.',
                ]);
            }
        } else {
            return back()->withInput()->withErrors([
                'email' => 'Account not found',
                'password' => ' ',
            ]);
        }
    }
}
