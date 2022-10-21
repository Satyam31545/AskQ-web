@extends('layout.main')

@push('title')
    <title>My Result</title>

    <style>
        .headd {
            /* border: 2px solid red; */
            height: 50px;
            margin-top: 10px;
            color: rgb(255, 255, 255);
            /* background-color: transparent; */
            text-align: center;
            font-size: 60px;
            /* width: 70%; */
            grid-column-start: 1;
            grid-column-end: 4;

        }

body{
            background-image: linear-gradient(to right, red, green);

}
        .resultcontainer {
            padding-left: 10px;
            /* height: 400px; */
            /* background-image: linear-gradient(to right, red, green); */
            /* left: 0;
                      padding: 0px;
                      margin: 0px; */
            display: grid;
            grid-template: 130px / auto auto auto;
            /* width: 100%; */
            /* grid-template-rows: 1fr 1fr; */ 
            place-items: center;
        }
        .result {
            /* width: 25px; */
            /* padding: 2px; */
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
    .headd {
            grid-column-start: 1;
            grid-column-end: 3;
        }
        .resultcontainer {
            grid-template: 130px / auto auto;
        }
        }
        @media screen and (max-width:700px) {
    .headd {
            grid-column-start: 1;
            grid-column-end: 2;
        }
        .resultcontainer {
            grid-template: 130px / auto;
        }
        .part1 {
            /* width: 280px; */
        }

        .part2 {
            /* width: 290px; */
        }
        }
    </style>
@endpush
@section('main-section')
    <div class="resultcontainer">
        <div class="headd">My Results </div>
@php
//    $myresults = DB::table('results')
//         ->join('contests','results.contest_id','=','contests.id')
//         ->where('results.user_id', Session::get('id'))
//         ->select('contests.con_name','results.*')->get();

$i=0;
foreach ($myresults as $myresult) {
    $i+=1;
      $s_result =  '<div class="result"><div>
            <div class="part1">
                <p>contest:'. $myresult->con_name .' </p>
                <p>creater:'. $myresult->name .' </p>
                <p>email:'. $myresult->email .' </p>

                </div>
            <div class="part2">'. $myresult->obtained_marks .' out of '. $myresult->total_marks .'</div></div>
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
