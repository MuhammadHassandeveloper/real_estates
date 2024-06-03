<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\PropertyImage;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AgencyAgentController extends Controller
{
    public function agents()
    {
        $data = array();
        $data['title'] = 'Agent Properties';
        $data['agents'] = User::where('agency_id', Sentinel::getUser()->id)->get();
        return view('agency.agents.index', $data);
    }

    public function agentCreate()
    {
        $data = array();
        $data['title'] = 'Create Agent';
        return view('agency.agents.create', $data);
    }

    public function agentDetail($id)
    {
        $data = array();
        $data['title'] = 'Agent Detail';
        $data['agent'] = User::find($id);
        $data['agency'] = Helpers::agency($data['agent']->agency_id);
        $data['properties'] = Helpers::agentProperties($id);
        $data['properties_count'] = Helpers::agentPropertiesCount($id);
        return view('agency.agents.detail', $data);
    }


    public function agentEdit($id)
    {
        $data = array();
        $data['title'] = 'Agent Edit';
        $data['agent'] = User::findOrFail($id);
        return view('agency.agents.edit', $data);
    }


    public function agentStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone' => 'required|numeric|min:11|unique:users,phone',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'bio' => 'required',
            'photo' => 'required|image',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [];
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['phone'] = $request->phone;
        $data['city'] = $request->city;
        $data['state'] = $request->state;
        $data['zip_code'] = $request->zip_code;
        $data['bio'] = $request->bio;
        $data['agency_id'] = Sentinel::getUser()->id;
        $password = Hash::make($request->input('password'));
        $user = Sentinel::register(array(
            'email' => $request->email,
            'password' => $password,

        ));

        DB::table('activations')->insert(
            [
                'user_id' => $user->id,
                'code' => Str::random(60),
                'completed' => 1,
                'completed_at' => date('Y-m-d H:i:s'),
                'created_at' =>  date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        if(isset($request->photo)) {
            $file = $request->photo;
            $extension = $file->getClientOriginalExtension();
            $filename = rand(0, 9999) . time() . '.' . $extension;
            $file->move(public_path('property_images'), $filename);
            $data['photo'] = $filename;
        }

        $data['password'] = Hash::make($request->input('password'));
        User::where('id', $user->id)->update($data);
        $role = Sentinel::findRoleByName('agent');
        if ($role) {
            $role->users()->attach($user);
        } else {
            return back()->with('error', 'Registration not successful');
        }

        Helpers::storeActivity(
            'New Agent Created', // Heading
            'Agency created by ' . Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name . '.', // Content
            'success', // Color
            Sentinel::getUser()->id, // User ID
            1, // Type
            Sentinel::getUser()->id, // System ID
            'Agency' // Role
        );
        return redirect()->route('agency.agents')->with('success', 'Agent added successfully.');
    }


    public function agentUpdate(Request $request)
    {
        $id = $request->id;
        $agent = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
            'phone' => 'required|numeric|min:11|unique:users,phone,' . $id,
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'bio' => 'required',
            'photo' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only([
            'first_name','last_name','phone',
            'city','state','zip_code','bio',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = rand(0, 9999) . time() . '.' . $extension;
            $file->move(public_path('property_images'), $filename);
            $data['photo'] = $filename;
            if ($agent->photo && file_exists(public_path('property_images/' . $agent->photo))) {
                unlink(public_path('property_images/' . $agent->photo));
            }
        }
        $agent->update($data);
        if ($agent->email !== $request->email) {
            $agent->email = $request->email;
            $agent->save();
        }

        $role = Sentinel::findRoleByName('agent');
        if ($role && !$role->users()->find($agent->id)) {
            $role->users()->attach($agent);
        }

        Helpers::storeActivity(
            'Agent Updated', // Heading
            'Agent updated by ' . Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name . '.', // Content
            'success', // Color
            Sentinel::getUser()->id, // User ID
            1, // Type
            Sentinel::getUser()->id, // System ID
            'Agent' // Role
        );

        return redirect()->route('agency.agents')->with('success', 'Agent updated successfully.');
    }

    public function agentDelete(Request $request)
    {
        $id = $request->id;
        DB::beginTransaction();
        try {
            $agent = User::findOrFail($id);
            Property::where('agent_id', $id)->delete();
            $agent->delete();
            Helpers::storeActivity(
                'Agent Deleted', // Heading
                'Agent deleted by Agent ' . Sentinel::getUser()->first_name . ' ' . Sentinel::getUser()->last_name . '.', // Content
                'success', // Color
                Sentinel::getUser()->id, // User ID
                1, // Type
                Sentinel::getUser()->id, // System ID
                'Agent' // Role
            );
            DB::commit();
            return redirect()->route('agency.agents')->with('success', 'Agent deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('agency.agents')->with('error', 'Failed to delete agent.');
        }
    }



}
