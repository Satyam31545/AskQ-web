@extends('layout.main')

@push('title')
    <title>Contest Started</title>

    <style>
        #headd {
            height: 60px;
            color: red;
            text-align: center;
            font-size: 50px;

        }

        .grid_cover {
            background-color: white;
            border: 2px solid red;
            margin-top: 10px;

        }

        .option {
            display: grid;
            grid-template-columns: 1fr 1fr;
            font-size: 28px;
        }

        .q_div {
            margin-left: 20px;
            margin-top: 15px;

        }

        .question {
            font-size: 35px;

        }

        .submit {
            margin-left: 20px;
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .submiti {
            font-size: 30px;
            color: white;
            background-color: red;
            padding-bottom: 10px;
        }

        .time {
            position: fixed;
            top:50%;
            right: 10%;
        }

        .img {
            margin-bottom: 20px;
            margin-top: 20px;
        }

        img {
            max-width: 250px;
            max-height: 250px;
        }
        .time>img{
            height: 70px;
        }
        #timer{
            background: rgba(0, 0, 0, 0.7);
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 100;
            left: 0;
            top: 0;
            display: none;
            justify-content: center;
        }
        .itime{
            background: #fff;
            position: relative;
            width: 275px;
            top: 20%;
            display: grid;
            justify-content: center;
            padding: 15px;
            border-radius: 4px;
            height: 250px;
            border: 2px solid red;
            grid-template-columns:auto auto auto; 
            align-items: center;
        }
        p{
            margin-left: 5px;
            margin-right: 5px;
            background-color: red;
            width: 80px;
            justify-content: center;
            font-size: 35px;
            height: 100px;
            display: flex;
            align-items: center;
            color: #fff;
        }
        #close-btn {
            background: red;
            width: 30px;
            height: 30px;
            color: white;
            line-height: 30px;
            text-align: center;
            position: absolute;
            top: -15px;
            right: -15px;
            border-radius: 50%;
            cursor: pointer;
            display: inline-block;
        }
       input{
            width: 16px;
     box-shadow: 0px  0px 0px #888888;
        }
        #footer{
    display: none;
}
        .submiti{
            width: 200px;
            cursor: pointer;
        }

    </style>
@endpush
@section('main-section')

 @php

 
            $id = Session::get('contest_id');
    $myquestions = DB::table('contests')
    ->join('questions','contests.con_id','=','questions.contest_id')
    ->where('contests.con_id', Session::get('contest_id'))
    ->select('questions.*','contests.con_name','contests.date','contests.from','contests.to')->get();


    $time = $myquestions->toArray() ;


        @endphp

  

    <div class="grid_cover">
@if ($time[0]->to !='')

    <div class="time">
            <img src="file/myfile/26095.svg" alt="Jellyfish" onclick="timer()">
        </div>
@endif
        

        <div id="timer">
            <div class="itime">
                    <p id="h">H</p>
            <p id="m">M</p>
            <p id="s">S</p> 
            <div id="close-btn" onclick="closebtn()">X</div>
            </div>
       
        </div>
        <div id="headd">con</div>
       
        <form id="form">
            <input type="hidden" name="_token" value="{{csrf_token() }}">

            @php
            
            $i=0;
            // var $name;
foreach ($myquestions as $question) {
    $name = $question->con_name;
   
    $i+=1;
          
           $myquestion ='<div class="q_div">
                <div class="question">
                    ('.$i.') '. $question->question .'
                </div><br>';
                    if ($question->img !='') {
                        $myquestion .='<div class="img">
                    <img src="file/'.$question->img.'" alt="Jellyfish">
                </div>';
                    }
                

                $myquestion .='<div class="option">
                    <div><input type="radio" name="'.$question->id.'" value="1"> <label for="">'.$question->option1 .'</label></div>
                    <div><input type="radio" name="'.$question->id.'" value="2"> <label for="">'.$question->option2 .'</label></div>';
                    if ($question->option3 != '') {
                       $myquestion .= '<div><input type="radio" name="'.$question->id.'" value="3"> <label for="">'.$question->option3 .'</label></div>';
                    }
                    if ($question->option4 != '') {
                       $myquestion .= '<div><input type="radio" name="'.$question->id.'" value="4"> <label for="">'.$question->option4 .'</label></div>';
                    }
                    if ($question->option5 != '') {
                       $myquestion .= '<div><input type="radio" name="'.$question->id.'" value="5"> <label for="">'.$question->option5 .'</label></div>';
                    }
                    $myquestion .= '</div></div>';
                    echo $myquestion;
                 } 
               
                    @endphp

            <div class="submit">
                <input type="submit" value="SUBMIT" class="submiti">
            </div>

        </form>
    </div>


    <script src="js/jquary.js"></script> 
    <script> 
 
 function timeout() {
  jQuery.ajax({
headers:
{
'X-CSRF-Token': $('input[name="_token"]').val()
},
         url: "{{url('/start_con')}}",
           type: "POST",
           data: jQuery('#form').serialize(),
           success : function(result){

   
      if(result == 1){
window.location = '/my_result';
      }
     
     }
});  
}
 jQuery('#form').submit(function(e){
    console.log("result");
e.preventDefault();

timeout();

});
// time

var x = setInterval(function() {
    var now = new Date().getTime();
    now = Math.floor(now/1000);

var second= ({{(strtotime($time[0]->to))}}-(now+(330*60)));
var seconds=second%60;
var minutes = Math.floor(((second)/60)%60);
var hours = Math.floor(second/(60*60));

document.getElementById("h").innerHTML = hours;
document.getElementById("m").innerHTML = minutes;
document.getElementById("s").innerHTML = seconds;
if (hours ==0 && minutes==0 && second==0) {

    timeout();
}



}, 1000);




function timer() {
    document.getElementById("timer").style.display = "flex";
}
function closebtn() {
    
            document.getElementById("timer").style.display = "none";
            
        }
</script>
@endsection
