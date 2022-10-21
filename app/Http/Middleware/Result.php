<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

use Closure;
use Illuminate\Support\Facades\DB;
use Session;

class Result
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
       $co = $request->route()->parameter('id');
       $contests = DB::table('contests')
       ->where('id',$co)
       ->first();
       if ($contests->creater_id == Session::get('id')) {
           return $next($request);
       }else {
        return redirect('error/2');
        
       }
        
    }
}
