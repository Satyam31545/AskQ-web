<?php

namespace App\Http\Controllers;
use App\myuser;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use Validator;
use Illuminate\Validation\Rule;

class askcon extends Controller
{
public function RandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring .= $characters[rand(0, strlen($characters)-1)];
    }
    return $randstring;
}

   public function login(){
    return  view('login');
   } 
   public function home(){
      return  view('home');
     } 
        public function create(){
      return  view('create_user');
     } 
     public function create_contest(){
      return  view('create_contest');
     } 
       public function start_con(){
        return  view('start_con');
       } 
       public function enter_contest(){
        return  view('enter_contest');
       } 
       public function logout(){
        session()->flush();
        return redirect('/');
       } 
       public function my_result(){
        $myresults = DB::table('results')
        ->join('contests','results.contest_id','=','contests.id')
        ->join('myusers','results.creater_id','=','myusers.id')
        ->where('results.user_id', Session::get('id'))
        ->select('contests.con_name','results.*','myusers.name','myusers.email')->get();
    $data = compact('myresults');
      

        return  view('my_result')->with($data);
       } 


       public function contest_results($id){
    $contestresults = DB::table('results')
    ->join('contests','results.contest_id','=','contests.id')
    ->join('myusers','results.user_id','=','myusers.id')
    ->where('contests.id', $id)
    ->select('contests.con_name','contests.con_id','contests.con_password','contests.date','results.*','myusers.name','myusers.email')->get();
    
    $data = compact('contestresults','id');


        return  view('contest_results')->with($data);
       } 

       public function error($id){
        
        if ($id==1) {
            $statement ="Login first or Create Account to go forward";
            $link ="/";
        }elseif ($id==2) {
            $statement ="You Cannot access result of Contest ot created by you";
            $link ="/home";
        }elseif ($id==6) {
            $statement ="Today is not right date to participate in contest";
            $link ="/enter_contest";
        }elseif ($id==3) {
            $statement ="You are too early. Contest is yet to start";
            $link ="/enter_contest";
        }elseif ($id==4) {
            $statement ="You are too late. Contest is end now";
            $link ="/enter_contest";
        }elseif ($id==5) {
            $statement ="You had already participited in this contest";
            $link ="/my_result";
        }
    $data = compact('statement','link');
        return  view('error')->with($data);
       } 














   public function loginpost(request $req){
    // validator
       $val =  Validator::make($req->all(),[
            'email'=> 'required|email',
            'password'=> 'required'
    ],
    $messages= [
        'required'=> 'The field must be filled.'
    ])->validate();

    // validator

    $users = DB::table('myusers')->where('email', $req['email'])->where('password', $req['password'])->get();
if( $users->count() != 0){


foreach ($users as $user) {

   Session::put('name', $user->name);
       Session::put('id', $user->id);
   Session::put('email', $user->email);
   Session::put('photoid', $user->photoid);
}
 return 1;
}else{
   echo "user not exist"; 
}
 
     } 
     public function create_post(request $req){

    // validator
    $val =  Validator::make($req->all(),[
        'name'=> 'required',
        'email'=> 'required|email',
        'password'=> 'required'
],
$messages= [
    'required'=> 'The field must be filled.'
])->validate();

// validator

      DB::table('myusers')->insert(
         ['name' => $req['name'], 'email' => $req['email'],'password' => $req['password'], 'photoid' => $req['photoid']]
     );
 
     Session::put('name', $req['name']);
         Session::put('id', $req['id']);
     Session::put('email',$req['email']);
     Session::put('photoid', $req['photoid']);
 
    return  '/home';
       } 
       

       public function create_contest_q_post(request $req){
                        // validator
    $val =  Validator::make($req->all(),[
        'con_name'=> 'required',
        'q1'=> 'required',
        'q1o1'=> 'required',
        'q1o2'=> 'required'
    ],
    $messages= [
        'required'=> 'The field must be filled.'
    ]
    )->validate();

// validator
if($req['con_time'] == 'yes'){
   $con_timev = 1;
}else{
   $con_timev = 0;
}
$con_id = Session::get('name').time();
$con_password = $this->RandomString();
$contest = DB::table('contests')->insert(
            ['con_name' => $req['con_name'],'creater_id' => Session::get('id'), 'con_time' => $con_timev,'date' => $req['date'], 'from' => $req['from'],'to' => $req['to'], 'status' => 0,'con_id' =>$con_id, 'con_password' => $con_password]
        );

    if( $contest){


       
for( $i=1;$i<$req['qs'];$i++){



if($req['fq'.$i]!=''){
    $extension=pathinfo($req['fq'.$i],PATHINFO_EXTENSION);
    // echo $extension;
    $file_name = time().$i.Session::get('id').'.'.'jpeg';
    $req['fq'.$i]->move(public_path('file'),$file_name);

}else{
$file_name = "";
}
    
    $question = DB::table('questions')->insert(
        ['contest_id' => $con_id,'question' => $req['q'.$i],'option1' => $req['q'.$i.'o1'], 'option2' => $req['q'.$i.'o2'],'option3' => $req['q'.$i.'o3'], 'option4' => $req['q'.$i.'o4'],'option5' => $req['q'.$i.'o5'], 'img' => $file_name,'answer' => $req['answer'.$i]]
    );  
}

      return  1;
    }else{
return  0;
    }
       
          } 



          public function enter_contest_post(request $req){

                // validator
    $val =  Validator::make($req->all(),[
        'contest'=> 'required',
        'password'=> 'required'
],
$messages= [
    'required'=> 'The field must be filled.'
])->validate();

// validator
            $contests = DB::table('contests')->where('con_id', $req['contest'])->where('con_password', $req['password'])->get();
        if( $contests->count() != 0){
        
        
        foreach ($contests as $contest) {  
           Session::put('contest_id', $contest->con_id);
        }
        // 
         return  $contest->id;
        }else{

         return  -1;      
        }
         
             } 
             
             public function start_con_post(request $req){
               
                $id = Session::get('contest_id');
                $mcreater = DB::table('contests')->where('con_id', $id)->get();
                foreach ($mcreater as $contest) {  
                    $mycreater = $contest->creater_id;
                    $mycontest_id = $contest->id;
                 }
                // $mycreater = DB::table('contests')->find($id)->creater_id;
                $questions = DB::table('questions')->where('contest_id', $id)->get();
                $i=0;
                $c=0;
foreach ($questions as $question) {
$i += 1;
if($req[$question->id] != ''){

    if($req[$question->id]  == $question->answer){
$c += 1;  
    }
     DB::table('answers')->insert(
                    ['question_id' => $question->id, 'user_id' => Session::get('id'),'answer' => $req[$question->id]]
                );
}
    
}
DB::table('results')->insert(
    ['user_id' => Session::get('id'), 'creater_id' => $mycreater,'contest_id' => $mycontest_id, 'total_marks' => $i, 'obtained_marks' => $c]
);
             
return 1;
             }

}
