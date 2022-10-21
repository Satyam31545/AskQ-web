@extends('layout.main')

@push('title')
    <title>Home</title>
    <style>
        
        .container {
            display: grid;
            grid-template-columns: auto auto;
            grid-template-rows: auto auto;
        }

        .feature {
            grid-column-start: 1;
            grid-column-end: 3;
        background: linear-gradient(red,green);
            text-align: center;
            /* padding-left: 10px; */
            padding-right: 10px;
            margin: 10px;
            border-radius: 20px;
            display: grid;
            grid-template: 130px/auto auto auto;
            padding-bottom: 5px;
        }

        p {
            font-size: 50px;
            color: aliceblue;
            margin-bottom: 10px;
        }
        .feature>p {
            grid-column-start: 1;
            grid-column-end: 4;
        }
        .score {
            text-align: center;
            background-color: red;
            padding-left: 10px;
            padding-right: 10px;
            margin: 10px;
            border-radius: 20px;
        }

        .score>div {
            font-size: 25px;
            color: rgb(219, 224, 167)
        }

        .result {
            text-align: center;
            background-color: green;
            padding-left: 10px;
            padding-right: 10px;
            margin: 10px;
            border-radius: 20px;
            height: 250px;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .co {
            background-color: red;
            border-radius: 20px;
            text-align: initial;
          
            padding: 2px;
            /* padding-left: 10px; */
            padding-right: 10px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            font-size: 25px;
            width: 100%;
            margin: 2px;
        }

        a {
            text-decoration: none;
            color: black;
        }
        /* model */
        .mycon {
            position: relative;
           width: 250px;

        }
        .omyco{
        display: flex;
        justify-content: center;
        margin: 2px;
        }

        /* Make the image to responsive */
        .image {
            display: block;
            width: 100%;
            height: auto;
            padding: 20px;

        }

        /* The overlay effect - lays on top of the container and over the image */
        .overlay {
            position: absolute;
            bottom: 0;
            background: rgb(0, 0, 0);
            background: rgba(0, 0, 0, 0.5);
            
            /* Black see-through */
            color: #ffddb0d5;
            width: 250px;
            
          
            /* color: white; */
            font-size: 25px;
            padding: 20px;
            text-align: center;
            
        }
        .overlay>p {
            display:none;
            font-size: 20px;
            margin-top: 5px;
    margin-bottom: 5px;
    color: rgb(255, 255, 255);
        }

        /* When you mouse over the container, fade in the overlay title */
        .mycon:hover .overlay>p {
            display:block;
        }
        @media screen and (max-width:1100px) {
            .feature {
            grid-template: 130px/auto auto ;
            grid-column-start: 1;
            grid-column-end: 2;

        }
        .feature>p {
            grid-column-start: 1;
            grid-column-end: 3;
        }
        .container {
            grid-template-columns: auto ;
        }
        }
        @media screen and (max-width:700px) {
            .feature {
    
            grid-template: 130px/auto ;

        }
        .feature>p {
            grid-column-start: 1;
            grid-column-end: 2;
        }
        .mycon {
          
            width: 400px;
        }
        .overlay {
           
            width: 400px;
            font-size: 25px;
           
        }
        }
        @media screen and (max-width:520px) {
        .mycon {
            width: 300px;
        }
        .overlay {  
            width: 300px;
            font-size: 25px;
        }
        p {
        font-size: 45px;
        }
        }
    </style>
@endpush
@section('main-section')
    <div class="container">
        <div class="feature">
            <p>Feature</p>
            <div class="omyco">
                <div class="mycon">
                <img src="/file/myfile/cup-award-svgrepo-com.svg" alt="Avatar" class="image">
                <div class="overlay">Comlete Solution<p>A complete solution for organising contest</p></div>
            </div>
            </div>
            <div class="omyco">
                <div class="mycon">
                <img src="/file/myfile/i-exam-multiple-choice-svgrepo-com.svg" alt="Avatar" class="image">
                <div class="overlay">MCQ Based<p>Contest are MCQ based</p></div>
            </div>
            </div>
            <div class="omyco">
                <div class="mycon">
                <img src="/file/myfile/timer-svgrepo-com.svg" alt="Avatar" class="image">
                <div class="overlay">Time Boundation<p>Time can be desided for starting and ending of contest</p></div>
            </div>
            </div>
            <div class="omyco">
                <div class="mycon">
                <img src="/file/myfile/evaluation-exam-svgrepo-com.svg" alt="Avatar" class="image">
                <div class="overlay">Automatic Result<p> Automatic result is generated</p></div>
            </div>
            </div>
            <div class="omyco">
                <div class="mycon">
                <img src="/file/myfile/protection-shield-svgrepo-com.svg" alt="Avatar" class="image">
                <div class="overlay">Protected<p>Id & Password is needed to give contest</p></div>
            </div>
            </div>
            <div class="omyco">
                <div class="mycon">
                <img src="/file/myfile/desk-svgrepo-com.svg" alt="Avatar" class="image">
                <div class="overlay">Preorganising<p>Date can be desided on which contest is going to be live.</p></div>
            </div>
            </div>
             
        </div>



        @php
            $scores = DB::table('results')
                ->join('contests', 'results.contest_id', '=', 'contests.id')
                ->where('results.user_id', Session::get('id'))
                ->select('contests.con_name', 'results.obtained_marks', 'results.total_marks')
                ->get();
            $myscore = -1;
            $con = '';
            $ob = 0;
            $to = 0;
            foreach ($scores as $score) {
                if ($score->obtained_marks / $score->total_marks > $myscore) {
                    $myscore = $score->obtained_marks / $score->total_marks;
                    $con = $score->con_name;
                    $ob = $score->obtained_marks;
                    $to = $score->total_marks;
                }
            }
            
        @endphp
        <div class="score">
            <p>Highest Score</p>
            <div>
                You had scored highest {{ $ob }} out of {{ $to }} in contest ({{ $con }}).<br>
                To see all you result <a href="/my_result">click here</a>.
            </div>

        </div>
        @php
            $contests = DB::table('contests')
                ->where('creater_id', Session::get('id'))
                ->get();
        @endphp
        <div class="result">
            <p>My Contest Result</p>
            @php
            $i=0;
                foreach ($contests as $contest) {
                    $i += 1;
                    $mycontests = '<a href="/contest_result/' . $contest->id . '"><div class="co">'.$i.') ' . $contest->con_name . '</div></a>';
                    echo $mycontests;

                }
                
            @endphp
        </div>
    </div>
@endsection
