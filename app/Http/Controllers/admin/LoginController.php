<?php

namespace App\Http\Controllers\admin;

use App\Model\City;
use App\Model\Setting;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
use Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends BaseController
{
    public function index()
    {
        if (Auth::user()) {
            return redirect(url('/admin/home'));
        } else {
            $page = 'login';
            $title = 'Login  page';
            $data = compact('page', 'title');

            return view('admin.layout', $data);
        }
    }
    public function checklogin(Request $request)
    {
        $rules = [
            "mobile"       => "required",
            "password"    => "required",
        ];
        $request->validate($rules);

        $user_data = array(
            'mobile'     => $request->mobile,
            'password'  => $request->password
        );
        $user = User::where('mobile', $request->mobile)->first();

        if ($user) {
            $is_remembered = !empty($request->remember_me) ? true : false;
            if (User::where('is_verified', true)->find($user->id)) {
                if ($user->role_id == 1) {
                    if (Auth::attempt($user_data, $is_remembered)) {
                        return redirect(route('admin_home'));
                    } else {
                        return redirect()->back()->with('error', 'Credentials not matched.');
                    }
                } else {
                    if (Auth::attempt($user_data, $is_remembered)) {
                        return redirect(route('admin_home'));
                    } else {
                        return redirect()->back()->with('error', 'Credentials not matched.');
                    }
                }
            } else {
                $setting = Setting::find(1);
                $otp    = rand(100000, 999999);

                Mail::send('email.otp', ['otp' => $otp, 'setting' => $setting], function ($message) use ($user, $setting) {
                    $message->to($user->email);
                    $message->subject('One Time Password For Account Verification.');
                    $message->from(env('MAIL_USERNAME'), $setting->title);
                });

                $user->otp = $otp;
                $user->save();
                return redirect(route('verify', $user->id))->with('success', 'Please verify your account.');
            }
        } else {
            // return redirect()->back()->with('error', 'You are not authorize for admin.');
            return redirect()->back()->with('error', 'Mobile number not exists.');
        }
    }
    public function logout()
    {
        Auth::logout();

        return redirect(route('admin_login'));
    }

    public function register()
    {
        $page = 'register';
        $title = 'Register';

        $city = City::get();
        $cityArr  = ['' => 'Select City'];
        if (!$city->isEmpty()) {
            foreach ($city as $mcat) {
                $cityArr[$mcat->id] = $mcat->name;
            }
        }

        $data  = compact('page', 'title', 'cityArr');
        return view('admin.layout', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'name'      => 'required',
            'mobile'     => 'required|unique:users',
            'password'     => 'required|min:6',
        ];
        $messages = [
            'name.required'  => 'Please Enter Name.',
            'mobile.required'  => 'Please Enter Mobile.',
            'password.required'  => 'Please Enter Password.'
        ];
        $request->validate($rules, $messages);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['role_id'] = 2;
        // dd($input);
        $obj = new User($input);
        $obj->save();

        $user = $obj;

        $setting = Setting::find(1);
        $otp    = rand(100000, 999999);

        Mail::send('email.otp', ['otp' => $otp, 'setting' => $setting], function ($message) use ($user, $setting) {
            $message->to($user->email);
            $message->subject('One Time Password For Account Verification.');
            $message->from(env('MAIL_USERNAME'), $setting->title);
        });

        $user->otp = $otp;
        $user->save();

        return redirect(route('verify',$user->id))->with('success', 'Please verify your account.');
    }

    public function verify(Request $request, User $user)
    {
        $page = 'verify';
        $title = 'Verify Account';

        $data  = compact('page', 'title', 'user');
        return view('admin.layout', $data);
    }

    public function verifyed(Request $request, User $user)
    {
        $rules = [
            'otp'      => 'required',
        ];
        $messages = [
            'otp.required'  => 'Please Enter OTP.',
        ];
        $request->validate($rules, $messages);
        // dd($user);

        if ($user->otp == $request->otp) {
            $obj = $user;
            $obj->is_verified = true;
            $obj->otp = null;
            $obj->save();
            return redirect(url('/'))->with('success', 'Success! Account has been verify successfully.');
        } else {
            return redirect()->back()->with('error', 'Otp not match. please enter valid otp.');
        }
    }

    public function resend(Request $request, User $user)
    {
        $setting = Setting::find(1);
        $otp    = rand(100000, 999999);

        Mail::send('email.otp', ['otp' => $otp, 'setting' => $setting], function ($message) use ($user, $setting) {
            $message->to($user->email);
            $message->subject('One Time Password For Account Verification.');
            $message->from(env('MAIL_USERNAME'), $setting->title);
        });

        $user->otp = $otp;
        $user->save();

        return redirect()->back()->with('success', 'Success! OTP resend successfully.');
    }
}
