<?php

namespace App\Providers;

use App\Models\MailSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class DynamicMailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Avoid this in CLI like during `migrate:fresh`
        if ($this->app->runningInConsole()) {
            return;
        }

        $settings = MailSetting::first();

        if ($settings) {
            Config::set('mail.mailers.smtp.host', $settings->host);
            Config::set('mail.mailers.smtp.port', $settings->port);
            Config::set('mail.mailers.smtp.username', $settings->username);
            Config::set('mail.mailers.smtp.password', $settings->password);
            Config::set('mail.from.address', $settings->address);
            Config::set('mail.from.name', $settings->name);
        }
    }
}
