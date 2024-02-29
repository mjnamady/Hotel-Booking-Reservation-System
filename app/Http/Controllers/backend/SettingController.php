<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function SmtpSetting(){
        $smtp = SmtpSetting::find(1);
        return view('backend.setting.smtp_update', compact('smtp'));
    } // End Method

    public function UpdateSmtp(Request $request){
        
        $smtp_id = $request->id;
        SmtpSetting::findOrFail($smtp_id)->update([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encription' => $request->encription,
            'from' => $request->from
        ]);

        $notification = array(
            'message' => 'Smtp Setting Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method
}
