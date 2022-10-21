<?php

namespace App\Http\Middleware;
use Session;
use Illuminate\Support\Facades\DB;

use Closure;

class Time
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
       
      $con=  DB::table('contests')
    ->where('con_id', Session::get('contest_id'))->first();
        // m
        
date_default_timezone_set('Asia/Kolkata'); 
$c_time =date('H:i:s');
$c_date =date('Y-m-d');
date_default_timezone_set("UTC");

        // m
// echo $c_time;
// echo "<br>";
// echo $c_date;
// echo "<br>";
// echo $con->date;
// echo "<br>";
// echo $c_date;
// echo "<br>";
// echo ($con->date == $c_date);
// echo ($con->to > $c_time);
// echo ($con->date == $c_date);

   $myresults = DB::table('results')
        ->join('contests','results.contest_id','=','contests.id')
        ->where('results.user_id', Session::get('id'))
        ->where('contests.con_id', Session::get('contest_id'))
        ->select('results.*')->get(); 
    
       $time = $myresults->toArray() ;

if (sizeof($time)!=0) {
   $r =1;
}else {
    $r=0;
}

if ((((($con->to > $c_time) && ($con->from < $c_time) && ($con->date == $c_date)) || ($con->to =='') )  && ($r==0)) || ($con->creater_id == Session::get('id')) ) {
    return $next($request);
}elseif (($r!=0)) {
    return  redirect('error/5');
    
}elseif (($con->date != $c_date)) {
    return  redirect('error/6');
    
}elseif (($con->from > $c_time)) {
    return  redirect('error/3');
    
}elseif (($con->to < $c_time)) {
    return  redirect('error/4');
    
}
    }
}
