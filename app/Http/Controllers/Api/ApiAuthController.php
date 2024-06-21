<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\AppHelper;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ApiAuthController extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:6|string',
            'last_name' => 'required|min:6|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
            'state_id' => 'required',
            'city_id' => 'required',
            'phone' => 'required|numeric|min:11|unique:users,phone',
            'role_type' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }
        try {
            $password = Hash::make($request->input('password'));
            $user = User::create([
                'email' => $request->input('email'),
                'password' => $password,
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone' => $request->input('phone'),
                'city_id' => $request->input('city_id'),
                'state_id' => $request->input('state_id'),
                'country_id' => AppHelper::state($request->state_id)->country_id,
            ]);

            $role = null;
            if ($request->has('role_type')) {
                switch ($request->input('role_type')) {
                    case 'customer':
                        $role = Sentinel::findRoleByName('customer');
                        break;
                    case 'agent':
                        $role = Sentinel::findRoleByName('agent');
                        break;
                    case 'agency':
                        $role = Sentinel::findRoleByName('agency');
                        break;
                    default:
                        return response()->json([
                            'success' => false,
                            'message' => 'Invalid role type',
                        ], 400);
                }
            }
            if ($role) {
                $role->users()->attach($user);
                DB::table('activations')->insert([
                    'user_id' => $user->id,
                    'code' => Str::random(60),
                    'completed' => 1,
                    'completed_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            if ($role) {
                $userRole = [
                    'name' => $role->name,
                    'slug' => $role->slug,
                ];
            }
            $data['token'] = $user->createToken('MyApp')->plainTextToken;
            $data['user'] = $user;
            $data['role'] = $userRole ?? null;
            if ($user) {
                $response = [
                    'success' => true,
                    'data' => $data,
                    'msg' => 'User registered successfully'
                ];
                return response()->json($response, 200);
            } else {
                $response = [
                    'success' => false,
                    'data' => $data,
                    'msg' => 'User registration failed'
                ];
                return response()->json($response, 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Registration failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            if(Auth::attempt(['email' =>$request->email,'password' =>$request->password])){
                $user = Auth::user();
                $data['token'] = $user->createToken('MyApp')->plainTextToken;
                $data['user'] = $user;
                return response()->json([
                    'success' => true,
                    'msg' => 'Successfully logged in',
                    'data' => $data,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => 'Invalid email or password',
                ], 401);
            }
        } catch (\Cartalyst\Sentinel\Checkpoints\NotActivatedException $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Your account has not been activated yet.',
            ], 403);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => 'Authentication error: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function logout(Request $request)
    {
        Sentinel::logout();
        return response()->json(['msg' => 'Logout successful','code' => 200]);
    }

}
