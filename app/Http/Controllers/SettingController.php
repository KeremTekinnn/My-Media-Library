<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function update(Request $request)
    {
        $setting = Setting::first();
        $setting->max_storage = $request->input('max_storage');
        $setting->save();

        return redirect()->route('dashboard')->with('success', 'Settings updated successfully');
    }
}
