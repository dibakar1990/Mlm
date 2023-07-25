<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\EmailConfiguration;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (\Schema::hasTable('email_configurations')) {
            $mailsetting = EmailConfiguration::first();
            if($mailsetting){
                $data = [
                    'driver'            => $mailsetting->driver,
                    'host'              => $mailsetting->host,
                    'port'              => $mailsetting->port,
                    'encryption'        => $mailsetting->encryption,
                    'username'          => $mailsetting->user_name,
                    'password'          => $mailsetting->password,
                    'from'              => [
                        'address'=>$mailsetting->from_address,
                        'name'   => $mailsetting->from_name
                    ]
                ];
                Config::set('mail',$data);
            }
        }
    }
}
