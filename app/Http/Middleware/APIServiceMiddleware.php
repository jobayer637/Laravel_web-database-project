<?php

namespace App\Http\Middleware;

use Closure;
use App\Apikey;

class APIServiceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(isset($request->apikey)){
            if(Apikey::where('key',$request->apikey)->first()){
                return $next($request);
            }else{
                return response()->json('Invalid api key');
            }
            
        }else{
            return response()->json('apikey not found');
        }
        
    }
}
