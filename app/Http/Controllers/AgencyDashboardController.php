<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\ActivityReport;
use App\Models\Property;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AgencyDashboardController extends Controller
{
    public function index()
    {
        $data = array();
        $data['title'] = 'Agent Dashboard';
        $data['properties'] = Property::where('agency_id', Sentinel::getUser()->id)->latest()->limit(8)->get();
        return view('agency.dashboard.index', $data);
    }

    public function profile()
    {
        $data = array();
        $data['title'] = 'Agent Profile';
        return view('agency.profile', $data);
    }

    public function profileUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => [
                'required',
                'regex:/^(\+?\d{1,4}|\d{1,4})?\s?\d{7,10}$/',
                'min:10'
            ],
            'whatsapp_phone' => [
                'required',
                'regex:/^(\+?\d{1,4}|\d{1,4})?\s?\d{7,10}$/',
                'min:10'
            ],
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|min:5|max:6',
            'bio' => 'nullable|string|min:5|max:1000',
            'agency_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'phone.required' => 'The phone number is required.',
            'phone.regex' => 'The phone number format is invalid.',
            'phone.min' => 'The phone number must be at least 10 digits.',
            'whatsapp_phone.required' => 'The WhatsApp phone number is required.',
            'whatsapp_phone.regex' => 'The WhatsApp phone number format is invalid.',
            'whatsapp_phone.min' => 'The WhatsApp phone number must be at least 10 digits.',
            'agency_logo.image' => 'The agency logo must be an image.',
            'agency_logo.mimes' => 'The agency logo must be a file of type: jpeg, png, jpg, gif.',
            'agency_logo.max' => 'The agency logo may not be greater than 2048 kilobytes.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Sentinel::getUser();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        $user->whatsapp_phone = $request->input('whatsapp_phone');
        $user->city = $request->input('city');
        $user->state = $request->input('state');
        $user->zip_code = $request->input('zip_code');
        $user->bio = $request->input('bio');

        if(isset($request->agency_logo)) {
            $file = $request->agency_logo;
            $extension = $file->getClientOriginalExtension();
            $filename = rand(0, 9999) . time() . '.' . $extension;
            $file->move(public_path('uploads'), $filename);
            $user->agency_logo = $filename;
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
        return view('agency.activity_report',$data);

    }
}
