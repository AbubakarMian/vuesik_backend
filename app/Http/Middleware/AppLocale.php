<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Config;
use App\Libraries\APIResponse;
class AppLocale
{
	use APIResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		
    	if(!$request->lang){
    		$request->lang = 'en';
    	}
    		
    	$validator = Validator::make([$request->lang], [
    			'lang' => 'in:en,ur'
    	]);
    	    	
		if(!$validator->fails()) {
    		$lang = '_en';
    		if($request->lang == 'en'){
    			$lang = '_en';
    		}
    		else if($request->lang == 'ur'){
    			$lang = '_ur';
    		}
		}
		else {
			return $this->sendResponse(
					Config::get('error.code.INTERNAL_SERVER_ERROR'),
					null,
					[$validator->errors()->all()],
					Config::get('error.code.INTERNAL_SERVER_ERROR')
			);
		}
    	//Setting the language locale
    	App::setLocale($lang);
    	
        return $next($request);
    }
}
