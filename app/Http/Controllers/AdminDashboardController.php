<?php

namespace App\Http\Controllers;

use App\Models\SiteData;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index() {
        $data = array();
        $data['title'] = 'admin';
        return view('admin.dashboard.index',$data);
    }

    public function create()
    {
        $siteSetting = SiteData::first();
        return view('site_settings.create', compact('SiteData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'owner_name' => 'nullable|string',
            'site_title' => 'nullable|string',
            'currency_sign' => 'nullable|string',
            'currency_code' => 'nullable|string',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:2048',
            'stripe_public_key' => 'nullable|string',
            'stripe_secret_key' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'contact_address' => 'nullable|string',
            'contact_city' => 'nullable|string',
            'contact_state' => 'nullable|string',
            'contact_zip' => 'nullable|string',
            'contact_country' => 'nullable|string',
            'additional_data' => 'nullable|json',
        ]);

        $data = $request->except(['site_logo', 'favicon']);

        // Handle file uploads
        if ($request->hasFile('site_logo')) {
            $data['site_logo'] = $request->file('site_logo')->store('logos', 'public');
        }

        if ($request->hasFile('favicon')) {
            $data['favicon'] = $request->file('favicon')->store('favicons', 'public');
        }

        // Create or update the site settings
        $siteSetting = SiteData::first();
        if ($siteSetting) {
            $siteSetting->update($data);
        } else {
            SiteData::create($data);
        }

        return redirect()->back()->with('success', 'Site settings saved successfully!');
    }
}
