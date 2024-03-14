<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use App\Models\SiteSetting;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

    public function SiteSetting(){
        $siteSetting = SiteSetting::find(1);
        return view('backend.setting.site_setting',compact('siteSetting'));
    } // End Method

    public function UpdateSetting(Request $request){
        // dd($request);

        if($request->hasFile('logo'))
        {
            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()).'.'. $request->file('logo')->getClientOriginalExtension();
            
            $img = $manager->read($request->file('logo'));
            $img = $img->resize(110,44);

            $img->toPng(80)->save(base_path('public/upload/site/'.$name_gen));
            $save_url = 'upload/site/'.$name_gen;

            SiteSetting::findOrFail($request->id)->update([
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
                'logo' => $save_url,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'SiteSetting Updated With Image Successfully!',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
        else 
        {
             SiteSetting::findOrFail($request->id)->update([
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'copyright' => $request->copyright,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'SiteSetting Updated Without Image Successfully!',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    } // End Method

}
