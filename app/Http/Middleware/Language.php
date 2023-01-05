<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

class Language
{
    public function handle($request, \Closure $next)
    {
        $locale = "english";

        if (  Schema::hasTable('settings')) {
            $language = Setting::getSettingValue('language_setting');

            if ($language) {
                $locale = strtolower($language->setting_value);
            }

        }

        app()->setLocale($locale);

        return $next($request);
    }
}