<?php

namespace App\Http\Controllers\ums;

use App\Http\Controllers\Controller;
use App\Models\ums\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class SportsController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'nullable',
            'mobile' => 'required|numeric|digits:10',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
            // 'course_type' => 'nullable',
            // 'g-recaptcha-response' => 'required|captcha',
        ],
            [
                'email.unique' => 'This Email Address is Already Registered',
                'g-recaptcha-response.required' => 'Google Captcha field is required.',
            ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json($validator->messages(), 200);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->middle_name = $request->middle_name;
        $user->user_name = explode('@', $request->email)[0];
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($request->course_type){
            $user->course_type = $request->course_type;
        }

        $otp = mt_rand(100000, 999999);
        $user->otp = $otp;

        $user->save();

        if ($user) {
            $mobile = $user->mobile;
            $lastThreeDigits = substr($mobile, -3);
            $name = $user->first_name;
            $url = "https://2factor.in/API/R1/?module=TRANS_SMS&apikey=6812fd6a-d943-11e8-a895-0200cd936042&to=" . urlencode($mobile) . "&from=SDVINS&templatename=exitcode&var1=" . urlencode($name) . "&var2=" . urlencode($otp);
            $response = file_get_contents($url);
//            dd($response);
            if ($response) {
                return view('ums.sports.verify-otp', ['email' => $user->email,'mobile'=>$lastThreeDigits]);
            } else {
                return response()->json(['status' => false, 'message' => 'Failed to send OTP']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Some Error Occurred!']);
        }
    }
    // YourController.php

    public function verifyOTP(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|numeric|digits:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if ($user && $user->otp == $request->otp) {
            $user->otp = null;
            $user->is_mobile_verified = true;

            // Generate email verification token
            $user->email_verification_token = Str::random(32);
            $user->save();

            // Send verification email
            $verificationLink = route('verify.email', ['token' => $user->email_verification_token]);

            Mail::send('ums.sports.email_template', ['user' => $user, 'verificationLink' => $verificationLink], function($message) use ($user) {
                $message->to($user->email);
                $message->subject('Verify Your Email Address');
            });

            return view('ums.sports.confirm_email', ['email' => $user->email])->with('success','OTP verified successfully! Please check your email to verify your email address.');
        } else {
            return redirect()->route('verify.email', ['token' => $user->email_verification_token])->with('error', 'Invalid OTP, please try again.');
        }
    }
    public function verifyEmail(Request $request) {
        $token = $request->query('token');
        $user = User::where('email_verification_token', $token)->first();
        if ($user) {
            $user->is_email_verified = true;
            $user->status = 'active';
            $user->email_verification_token = null;
            $user->save();
            return redirect()->route('sports.login')->with('success','Email verified Successfully!');
        } else {
            return redirect()->route('sports.login')->with('error','Invalid or expired token.');
        }
    }



    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => 'required',
        ], [
            'password.required' => 'Password field is required',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json($validator->messages(), 200);
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember') ? true : false;

        if (Auth::guard('sports')->attempt($credentials, $remember)) {
            $user = Auth::user(); // Get the authenticated user
            if ($user && $user->status == 'pending') {
                $data['status'] = false;
                $data['message'] = 'Your account is not activated. To activate your account, please click on <a class="btn btn-success" href="activate-your-account/' . $credentials['email'] . '">Activate</a> button';
                Auth::logout();
                return response()->json($data);
            }

            $data['status'] = true;
            $data['message'] = 'Logged in Successfully';
            return response()->json($data);

        } else {
            $data['status'] = false;
            $data['message'] = 'Email ID or Password is wrong';
            return response()->json($data);
        }
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $data['status'] = true;
        $data['message'] = 'Logged out successfully';
//        return response()->json($data);
        return redirect()->route('sports.login')->with('success', 'Logged out successfully');
    }

}
