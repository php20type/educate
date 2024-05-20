<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        dd(1);
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            if (request()->getHttpHost() === 'admin.topsidefacilities.test') {
                if ($user->is_admin) {
                    // Admin user
                    $token = md5(uniqid());
                    $user->update(['token' => $token]);

                    return redirect()->route('admin.customer.index');
                } else {
                    return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                        'error' => 'Invalid email or password. Please try again.',
                    ]);
                }
            } else {

                if ($user->is_admin) {
                    return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                        'error' => 'Invalid email or password. Please try again.',
                    ]);
                } else {
                    // Regular user
                    if ($user->approve_at !== null && $user->is_approve == 1) {
                        $token = md5(uniqid());
                        $user->update(['token' => $token]);
                        return redirect()->route('user.property.index');
                    } else if ($user->email_verified_at == null) {
                        return redirect('/verify-page');
                    } else if ($user->approve_at !== null && $user->is_approve == 0) {
                        return redirect('/disapprove-page');
                    } else {
                        return redirect('/thank-you');
                    }
                }
            }

        } else {
            // Login attempt failed
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'error' => 'Invalid email or password. Please try again.',
            ]);
        }
    }
}
