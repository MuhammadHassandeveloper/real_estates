<?php

namespace App\Http\Controllers;

use App\Models\SiteData;
use Illuminate\Http\Request;

class SiteDataController extends Controller
{

    public function edit()
    {
        $siteData = SiteData::first();
        return view('admin.site_data', compact('siteData'));
    }

    public function updateSiteData(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string',
            'email' => 'required|email',
            'owner_name' => 'required|string',
            'site_title' => 'required|string',
            'currency_sign' => 'required|string',
            'currency_code' => 'required|string',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stripe_public_key' => 'required|string',
            'stripe_secret_key' => 'required|string',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'contact_address' => 'required|string',
            'contact_city' => 'required|string',
            'contact_state' => 'required|string',
            'contact_zip' => 'required|string',
            'contact_country' => 'required|string',
            'additional_data' => 'nullable|array',
        ]);

        $siteData = SiteData::first(); // Assuming there's only one site data record
        if (!$siteData) {
            $siteData = new SiteData();
        }

        $siteData->fill($validated);

        if ($request->hasFile('site_logo')) {
            $file = $request->file('site_logo');
            $extension = $file->getClientOriginalExtension();
            $filename = rand(0, 9999) . time() . '.' . $extension;
            $file->move(public_path('uploads'), $filename);
            $siteData->site_logo = asset('uploads/' . $filename); // Store full path
        }

        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $extension = $file->getClientOriginalExtension();
            $filename = rand(0, 9999) . time() . '.' . $extension;
            $file->move(public_path('uploads'), $filename);
            $siteData->favicon = asset('uploads/' . $filename); // Store full path
        }

        if ($request->hasFile('dashboard_logo')) {
            $file = $request->file('dashboard_logo');
            $extension = $file->getClientOriginalExtension();
            $filename = rand(0, 9999) . time() . '.' . $extension;
            $file->move(public_path('uploads'), $filename);
            $siteData->dashboard_logo = asset('uploads/' . $filename); // Store full path
        }

        if ($request->hasFile('dashboard_favicon')) {
            $file = $request->file('dashboard_favicon');
            $extension = $file->getClientOriginalExtension();
            $filename = rand(0, 9999) . time() . '.' . $extension;
            $file->move(public_path('uploads'), $filename);
            $siteData->dashboard_favicon = asset('uploads/' . $filename); // Store full path
        }


        $siteData->save();

        return redirect()->back()->with('success', 'Site data updated successfully.');
    }

}
