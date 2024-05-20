<?php

namespace App\Http\Controllers;

use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        return view('frontend/signup', $data);
    }



    public function userStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
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
        }elseif($request->has('agency') && $request->input('role_type') == 'agency' ) {
            $role = Sentinel::findRoleByName('agency');
        }
        if ($role) {
            $role->users()->attach($user);
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
                return redirect('/agent/dashboard')->with('success', 'Successfully logged in');
            } elseif ($user->inRole('customer')) {
                return redirect('/customer/dashboard')->with('success', 'Successfully logged in');
            } elseif ($user->inRole('agency')) {
                return redirect('/agency/dashboard')->with('success', 'Successfully logged in');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function destroy()
    {
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
}
