@extends('layout.main')

@push('title')
<meta property="og:title" content="How to share wesite"/>
<meta property="og:image" content="file/myfile/26095.svg"/>
<meta property="og:url" content="/home"/>
<meta property="og:title" content="How to share wesite title"/>
<meta property="og:site_name" content="/"/>
    <title>Contest Result</title>
    <link rel="stylesheet" href="http://127.0.0.1:8000/css/mystyle.css">

    <style>
        .headd {
            /* border: 2px solid red; */
            height: 50px;
            margin-top: 10px;
            color: rgb(255, 255, 255);
            /* background-color: transparent; */
            text-align: center;
            font-size: 50px;
            /* width: 70%; */
            grid-column-start: 1;
            grid-column-end: 4;

        }

body{
            background-image: linear-gradient(to right, red, green);

}
        .resultcontainer {
            padding-left: 10px;
            padding-right: 10px;
            display: grid;
            grid-template: 130px 150px / auto auto auto;
            place-items: center;
        }
        .share{
            grid-column-start: 1;
            grid-column-end: 4;
            width: 100%;
height: 100%;
        }
        .sharediv{
             display: grid;
           grid-template:  0px/auto auto ;
        }
        .shareop{
             height:   110px;
             border-radius: 0px 7px 7px 0px;
             background-color: rgb(248, 69, 99);
             padding-left: 10px;
font-size:25px ;

        }
        .sharede{
       min-height:  110px;
       max-height:  130px;
            border-radius: 7px 0px 0px 7px;
background-color: rgb(248, 69, 99);
padding-left: 10px;
font-size:25px ;
word-wrap:unset;
             
        }
        .sharede>p,.shareop>p{
            margin: 5px 0px;
        }
        .result {
            width: 80%;

        }

        .part1 {
            background-color: rgb(158, 49, 168);
            height: 250px;
            border-radius: 10px 10px 0px 0px;
            padding-left: 10px;
            font-size: 35px;
            word-wrap:break-word;
            padding-left: 10px;
            padding-right: 10px;
            /* width: 100%; */
        }

        .part2 {
            position: relative;
            /* width: 103%; */
            font-size: 35px;
            background-color: white;
            color: blue;
            border-radius: 0px 0px 10px 10px;
            height: 40px;
            padding-left: 10px;
        }
        #footer{
    display: none;
}
.error{
    grid-column-start: 1;
    grid-column-end: 4;
    text-align: center;
    font-size: 30px;
    color: white;
}
@media screen and (max-width:1100px) {
    .headd,.share {
            grid-column-start: 1;
            grid-column-end: 3;
        }
        .resultcontainer {
            grid-template: 130px 130px / auto auto;
        }
        .error{
    grid-column-start: 1;
    grid-column-end: 3;
}
        }

        @media screen and (max-width:700px) {
    .headd,.share {
            grid-column-start: 1;
            grid-column-end: 2;
            /* font-size: 40px; */
        }
        .resultcontainer {
            grid-template: 130px 260px / auto;
        }
        .error{
    grid-column-start: 1;
    grid-column-end: 2;
}
.sharediv{
           grid-template: auto/auto;
           
        }
        .shareop{
border-radius: 7px;
margin-top: 10px;
        }
        .sharede{
border-radius: 7px; 
margin-top: 10px;

        }
        }

        @media screen and (max-width:520px) {
    .headd {
            font-size: 36px;
        }
        }
        a{
            text-decoration: none;
        }
        img{
            width: 25px;
            height: 25px;
        
        }
        #sp{
color:rgb(52, 32, 233);
        }
    </style>
@endpush
@section('main-section')
@php
    
$contestdetails = DB::table('contests')->where('id', $id)->first();
$wmessage = "Hi, %0A ".Session::get('name')." has invited you to participate in his contest.%0A Use following id and password to enter in the contest.  %0A Id=".$contestdetails->con_id." %0A Password = ".$contestdetails->con_password." %0A *This should not be shared with any one."
@endphp
    <div class="resultcontainer">
        <div class="headd">My Contest Result</div>
        <div class="share">
            <div class="sharediv">
               
                 <div class="sharede">
                    <p>Contest name : {{$contestdetails->con_name}}</p>
                    <p>Contest id : {{$contestdetails->con_id}}</p>
                    <p>Contest password : {{$contestdetails->con_password}}</p>
                    
   
                </div>
         <div class="shareop">
        <p id="sp">Share Id & Password </p>
    <p><a href="http://api.whatsapp.com/send?phone=&text={{$wmessage}}" target="_blank"><img src="/file/myfile/whatsapp-svgrepo-com.svg" alt="whatsapp"> Whatsapp </a> </p>   
        </div>  
            </div>
         
        </div>
@php      
$i=0;
foreach ($contestresults as $contestresult) {
    if ($contestresult->date =='') {
       $da = "Not given";
    }else {
        $da =$contestresult->date;
    }
    
$i+=1;
      $s_result =  '<div class="result">
            <div class="part1">
               
                <p>Candidate:'. $contestresult->name .' </p>
                <p>Email:'. $contestresult->email .' </p>
                 <p>Date:'. $da .' </p>
                </div>
            <div class="part2">'. $contestresult->obtained_marks .' out of '. $contestresult->total_marks .'</div>
        </div>';
        echo $s_result; 
}
if ($i==0) {
   echo '<div class="error">No result found</div>';
}
@endphp

        
        


    </div>
   

    </div>
@endsection
