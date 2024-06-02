<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\ActivityReport;
use App\Models\Property;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $data = array();
        $data['title'] = 'Agent Dashboard';
        $data['properties'] = Property::where('agent_id', Sentinel::getUser()->id)->latest()->limit(8)->get();
        return view('agent.dashboard.index', $data);
    }

    public function profile()
    {
        $data = array();
        $data['title'] = 'Agent Profile';
        return view('agent.profile', $data);
    }

    public function profileUpdate(Request $request)
    {
        $user = Sentinel::getUser();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        $user->whatsapp_phone = $request->input('whatsapp_phone');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->zip_code = $request->input('zip_code');
        $user->bio = $request->input('bio');

        if(isset($request->photo)) {
            $file = $request->photo;
            $extension = $file->getClientOriginalExtension();
            $filename = rand(0, 9999) . time() . '.' . $extension;
            $file->move(public_path('uploads'), $filename);
            $user->photo = $filename;
        }
        $user->save();
        AppHelper::storeActivity('Profile Update','Update by','success',Sentinel::getUser()->id,1,Sentinel::getUser()->id,'Agent');
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function passwordUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Sentinel::getUser();

        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        AppHelper::storeActivity('Password Update','Update by','success',Sentinel::getUser()->id,1,Sentinel::getUser()->id,'Agent');
        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function activities() {
        $data = array();
        $data['activities'] = ActivityReport::where('system_id',Sentinel::getUser()->id)->where('type',1)->where('role','Agent')->latest()->get();
        $data['title'] = 'Activity';
        return view('agent.activity_report',$data);

    }
}
