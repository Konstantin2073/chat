<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
//        $lang = Cookie::get('LANG', 'eng');
/*
	$lang = session('lang', 'eng');
	View::share('lange', $lang);
        App::setLocale($lang);
*/
	$lang = session('lang', 'eng');
	$segment = request()->segment(1);
        View::share('lange', $lang);
	if ($segment == 'fb')
	        $ModelPage = config('pages.fb.' . $lang);
	else
	        $ModelPage = config('pages.nofb.' . $lang);


        View::share('ModelPage', $ModelPage);
        return $next($request);

    }
}
