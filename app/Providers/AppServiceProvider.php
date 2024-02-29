<?php

namespace App\Providers;

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
    public function boot(): void
    {
        if(\Schema::hasTable('smtp_settings')){
            $smtpsetting = SmtpSetting::first();
            if($smtpsetting){
                $data = [
                    'driver' => $smtpsetting->mailer,
                    'host' => $smtpsetting->host,
                    'port' => $smtpsetting->port,
                    'username' => $smtpsetting->username,
                    'password' => $smtpsetting->password,
                    'encription' => $smtpsetting->encription,
                    'from' => [
                        'address' => $smtpsetting->from,
                        'name' => 'MJNamadi'
                    ]
                ];
                Config::set('mail',$data);
            }
        }
    }
}
