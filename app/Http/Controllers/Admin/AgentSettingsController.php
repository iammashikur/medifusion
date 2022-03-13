<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentSetting;
use Illuminate\Http\Request;

class AgentSettingsController extends Controller
{


    public function store(Request $request){
        $setting = AgentSetting::firstOrCreate([
            'default_commission' => $request->default_commission,
        ]);
        $setting->default_commission =  $request->default_commission;
        $setting->save();

        return redirect()->back();

    }
}