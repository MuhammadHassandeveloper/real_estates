<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


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


    public function getLoginPage() {
        $data = array();
        $data['title'] = 'Admin Login';
        return view('admin.login',$data);
    }
}
