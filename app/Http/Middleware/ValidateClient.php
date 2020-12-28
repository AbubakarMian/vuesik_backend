<?php

namespace App\Http\Middleware;

use App\Exceptions\UnAuthorizedRequestException;
use App\Libraries\APIResponse;
use Closure;
use DB;
use Illuminate\Support\Facades\Config;

class ValidateClient
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
   
    	$client_id = $request->header('client-id');
    	$authorization_header = $request->header('Authorization');
    	$authorization_header = $authorization_header ?? $request->header('Authorization-secure');
    	$client_secret = str_replace("Basic ", "", $authorization_header);
           
        $client = DB::table('client')
                    ->where('client_id', $client_id)
                    ->where('client_secret', $client_secret)
                    ->first();
                    // dd($client);
                    
        if($client){
            return $next($request);
            
        }
throw new UnAuthorizedRequestException;
    	try{
            // dd('asd');
            
            
    	}

    	catch(Exception $e) {
    		return $this->sendResponse(Config::get('error.code.INTERNAL_SERVER_ERROR'),
    				[],
    				['User not found'],
                    Config::get('error.code.INTERNAL_SERVER_ERROR'));
                   
    	}
    }
}
