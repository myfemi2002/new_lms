<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use App\Models\SmtpSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // public function boot(): void
    // {
    //     //
    //    if (\Schema::hasTable('smtp_settings')) {
    //        $smtpsetting = SmtpSetting::first();

    //        if ($smtpsetting) {
    //        $data = [
    //         'driver' => $smtpsetting->mailer, 
    //         'host' => $smtpsetting->host,
    //         'port' => $smtpsetting->port,
    //         'username' => $smtpsetting->username,
    //         'password' => $smtpsetting->password,
    //         'encryption' => $smtpsetting->encryption,
    //         'from' => [
    //             'address' => $smtpsetting->from_address,
    //             'name' => 'Learning Management System'
    //         ]

    //         ];
    //         Config::set('mail',$data);
    //        }
    //    } // end if




    // }


        public function boot(): void
        {
            if (Schema::hasTable('smtp_settings')) {
                $smtpSetting = SmtpSetting::first();

                if ($smtpSetting) {
                    $mailConfig = [
                        'driver' => $smtpSetting->mailer, 
                        'host' => $smtpSetting->host,
                        'port' => $smtpSetting->port,
                        'username' => $smtpSetting->username,
                        'password' => $smtpSetting->password,
                        'encryption' => $smtpSetting->encryption,
                        'from' => [
                            'address' => $smtpSetting->from_address,
                            'name' => 'Learning Management System'
                        ]
                    ];

                    Config::set('mail', $mailConfig);
                }
            }
        }






}
    
