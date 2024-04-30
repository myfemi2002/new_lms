<?php

namespace App\Http\Controllers;

use App\Models\SmtpSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function smtpSettings(){
        $smtp = SmtpSetting::find(1);
        return view('backend.settings.smtp_update', compact('smtp'));
    }

    public function smtpUpdate(Request $request)
    {
        $smtp = SmtpSetting::find($request->id);
        $smtp->update([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address, 
        ]);

        $notification = [
            'message' => 'SMTP settings updated successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);  
    }

}
