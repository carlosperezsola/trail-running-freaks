<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;

class SettingController extends Controller
{
    public function index()
    {
        $generalSettings = GeneralSetting::first();
        //$emailSettings = EmailConfiguration::first();
        //$logoSetting = LogoSetting::first();
        //$pusherSetting = PusherSetting::first();
        return view('admin_user.setting.index', compact('generalSettings'/*, 'emailSettings', 'logoSetting', 'pusherSetting'*/));
    }

    public function generalSettingUpdate(Request $request)
    {        
        $request->validate([
            'site_name' => ['required', 'max:200'],
            'layout' => ['required', 'max:200'],
            'contact_email' => ['required', 'max:200'],
            'currency_name' => ['required', 'max:200'],
            'time_zone' => ['required', 'max:200'],
            'currency_icon' => ['required', 'max:200'],
        ]);

        GeneralSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => $request->site_name,
                'layout' => $request->layout,
                'contact_email' => $request->contact_email,
                //'contact_phone' => $request->contact_phone,
                //'contact_address' => $request->contact_address,
                //'map' => $request->map,
                'currency_name' => $request->currency_name,
                'currency_icon' => $request->currency_icon,
                'time_zone' => $request->time_zone
            ]
        );

        toastr('Updated successfully!', 'success', 'Success');

        return redirect()->back();

    }
}
