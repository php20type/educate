<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\OtpEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'confirm_email' => ['required', 'string', 'email', 'max:255', 'same:email'],
    //         'phone' => ['required', 'string', 'max:15'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'email' => $data['email'],
    //         'phone' => $data['phone'],
    //     ]);
    // }

    // public function showRegistrationForm()
    // {
    //     return view('auth.register');
    // }

    // public function register(Request $request)
    // {
    //     $this->validator($request->all())->validate();

    //     $user = $this->create($request->all());

    //     $this->guard()->login($user);

    //     if ($user->user_type === 'admin') {
    //         return redirect()->route('admin.dashboard');
    //     } elseif ($user->user_type === 'student') {
    //         return redirect()->route('student.dashboard');
    //     }

    //     return redirect($this->redirectTo);
    // }

    public function showStep1()
    {
        return view('auth.register');
    }

    public function postStep1(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'confirm_email' => ['required', 'string', 'email', 'max:255', 'same:email'],
            'phone' => ['required'],
        ]);

        // Store the data in session
        Session::put('registration', [
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Redirect to step 2
        return redirect()->route('register.step2');
    }

    public function showStep2()
    {
        // Check if step 1 data is in session
        if (!Session::has('registration')) {
            return redirect()->route('register.step1');
        }

        return view('auth.register2');
    }

    public function sendOTP(Request $request)
    {
        Session::forget('otp');
        $otp = mt_rand(100000, 999999);
        // Send OTP via email
        // Mail::to($request->email)->send(new OtpEmail($otp));

        // Store the OTP in session for verification in the next step
        Session::put('otp', $otp);

        return response()->json(['message' => 'OTP sent successfully']);
    }

    public function postStep2(Request $request)
    {
        $registrationData = Session::get('registration');

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'instagram' => 'required',
        ]);

        $otp = $request->digit1 . $request->digit2 . $request->digit3 . $request->digit4 . $request->digit5 . $request->digit6;
        $otpData = Session::get('otp');
        if ($otpData != $otp) {
            return redirect()->back()->withInput()->withErrors(['otp' => 'Invalid OTP']);
        }

        // Complete registration process
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $registrationData['email'],
            'phone' => $registrationData['phone'],
            'instagram' => $request->instagram,
            // 'password' => bcrypt($request->password),
        ]);

        // Clear the session data
        Session::forget('registration');
        Session::forget('otp');

        // Log the user in or redirect to login page
        auth()->login($user);

        return redirect()->route('login');
    }




}
