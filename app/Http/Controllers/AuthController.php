<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function loginForm() {
        if (Sentinel::check()) {
            return redirect()->back()->with('error', 'You have been already  login.');
        }
        $data = array();
        $data['title'] = 'Login';
        return view('frontend/login', $data);
    }

    public function signupForm() {

        if (Sentinel::check()) {
            return redirect()->back()->with('error', 'You have been already  login.');
        }

        $data = array();
        $data['title'] = 'Signup';
        $data['states'] = AppHelper::states();
        $data['cities'] =  AppHelper::cities();
        return view('frontend/signup', $data);
    }



    public function userStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'state_id' => 'required',
            'city_id' => 'required',
            'password' => 'required|min:8',
            'phone' => 'required|numeric|min:11|unique:users,phone',
            'role_type' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [];
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['phone'] = $request->phone;
        $data['country_id'] = AppHelper::state($request->state_id)->country_id;
        $data['state_id'] = $request->state_id;
        $data['city_id'] = $request->city_id;
        $password = Hash::make($request->input('password'));
        $user = Sentinel::register(array(
            'email' => $request->email,
            'password' => $password,

        ));

        $activations =  DB::table('activations')->insert(
            [
                'user_id' => $user->id,
                'code' => Str::random(60),
                'completed' => 1,
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        $data['password'] = Hash::make($request->input('password'));
        User::where('id', $user->id)->update($data);
        $role = null;
        if($request->has('role_type') && $request->input('role_type') == 'customer' ) {
            $role = Sentinel::findRoleByName('customer');
         }elseif($request->has('role_type') && $request->input('role_type') == 'agent' ) {
          $role = Sentinel::findRoleByName('agent');
        }
        if ($role) {
            $role->users()->attach($user);
            $user = User::find($user->id);
            $this->sendWelcomeEmail($user);
            return redirect()->to('login')->with('success', 'Registration successful. Please log in.');
        } else {
            return back()->with('error', 'Registration not successful');
        }
    }


    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');

        try {
            $user = Sentinel::authenticate($credentials);
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return redirect()->back()->withErrors($message)->withInput();
        }

        if ($user) {
            if ($user->inRole('admin')) {
                return redirect('/admin/dashboard')->with('success', 'Successfully logged in');
            } elseif ($user->inRole('agent')) {
                AppHelper::storeActivity(
                    'Agent Login',
                    'Agent ' . Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name . ' logged in successfully.', // Content
                    'success',
                    Sentinel::getUser()->id,
                    1, // Type
                    Sentinel::getUser()->id,
                    'Agent' // Role
                );
                return redirect('/agent/dashboard')->with('success', 'Successfully logged in');
            } elseif ($user->inRole('customer')) {
                AppHelper::storeActivity(
                    'Customer Login',
                    'Customer ' . Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name . ' logged in successfully.', // Content
                    'success',
                    Sentinel::getUser()->id,
                    1, // Type
                    Sentinel::getUser()->id,
                    'Customer' // Role
                );
                return redirect('/customer/dashboard')->with('success', 'Successfully logged in');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function destroy()
    {
        AppHelper::storeActivity(
            'User Logout',
            'User ' . Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name . ' Logout in successfully.', // Content
            'success',
            Sentinel::getUser()->id,
            1, // Type
            Sentinel::getUser()->id,
            'User' // Role
        );
        Sentinel::logout();
        Auth::logout();
        return redirect('login')->with('success', 'Logout successfully');
    }

    public function adminLogout()
    {
        Sentinel::logout();
        Auth::logout();

        return redirect('admin/login')->with('success', 'Logout successfully');
    }


    public function getLoginPage() {
        $data = array();
        $data['title'] = 'Admin Login';
        return view('admin.login',$data);
    }


    protected function sendWelcomeEmail($user)
    {
        $data = ['user' => $user];
        Mail::send('emails.welcome', $data, function ($message) use ($user) {
            $site = AppHelper::site_name();
            $message->to($user->email, $user->first_name)
                ->subject('Welcome to'.'  '.$site);
        });
    }


    public function showForgotPasswordForm()
    {
        $data = [];
        $data['title'] = 'Forgot Password';
        return view('frontend.forgot-password', $data);
    }

    public function sendResetPasswordEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::where('email', $request->email)->first();
        $token = Password::createToken($user);
        $this->sendResetEmail($user, $token);
        return back()->with('success', 'Password reset link sent to your email address.');
    }

    protected function sendResetEmail($user, $token)
    {
        $email = $user->email;
        $name = $user->first_name . ' ' . $user->last_name;
        $link = url('reset-password/' . $token);
        $request_time = date('h:i:s', time());
        Mail::send('emails.password-reset', compact('link', 'name','email','request_time'), function ($message) use ($email, $name) {
            $message->to($email, $name)
                ->subject('Your Password Reset Link');
        });
    }

    public function showResetPasswordForm($token)
    {
        $data = [];
        $data['title'] = 'Reset Password';
        $data['token'] = $token;
        return view('frontend.reset-password', $data);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('frontend.login_form')->with('success', 'Your password has been successfully reset.')
            : back()->withErrors(['email' => [__($status)]]);
    }


}
