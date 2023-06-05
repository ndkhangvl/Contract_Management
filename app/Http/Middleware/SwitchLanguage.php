<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SwitchLanguage
{
    public function handle($request, Closure $next)
    {
        $locale = Session::get('locale');
        
        if (in_array($locale, ['en', 'vi'])) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
