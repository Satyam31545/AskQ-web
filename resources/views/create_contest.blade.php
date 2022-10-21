@extends('layout.main')

@push('title')
    <title>Create Contest</title>
    <style>
        ::placeholder {
            color: rgb(83, 67, 67);
            font-weight: 600;
        }

        select {
            height: 30px;
            width: 250px;
            border: 0px solid black;
            font-size: 15px;
            box-shadow: 0.5px 3px 3px #888888;
        }

        label {
            font-size: 25px;
            color: #455ff5;

        }

        p {
            width: 30%;
            height: 30px;
            font-size: 25px;
            background-color: rgb(172, 43, 43);
            color: white;
            text-align: center;
            margin-left: 10%;
        }

        #addqdiv {
            justify-content: center;
            display: flex;
        }
        #grid_div3{
          margin-left: 10px;
          padding: 0px 10px;
          background-color: white;
         box-shadow: 0.5px 0.5px 3px 3px #888888;

           
        }
        .ihead{
              text-align: center;
              padding-bottom: 15px;
              font-size: 28px;
              color: rgb(255, 0, 0);
        }
        li{
            font-size: 20px;
padding-top: 2px;
color: rgb(233, 7, 222);
        }
        li:nth-child(even){
color: rgb(21, 248, 59);

        }
        @media screen and (max-width:1100px) {
            #grid_container{
    grid-template-rows: auto auto;
    grid-template-columns: auto;
   
 height: 100%;
    padding-left: 3%;
}
        }
        @media screen and (max-width:700px) {
            .qdiv{
    width: 500px;

  }
        }
        @media screen and (max-width:540px) {
            .qdiv{
    width: 300px;
    
  }
        }
    </style>
@endpush
@section('main-section')
    {{-- main container --}}
    <div id="grid_container">
        {{-- second container --}}
        <div id="grid_div_con">
            {{-- first grid --}}
            <form id="form" method="post" enctype="multipart/form-data">
                <div id="grid_div">

                    <div>
                        <div id="login_h">
                            Create Contest
                        </div>

                        <div id="form_container">
                            <div id="forms">
                                {{-- <form id="form" action="/create_contest" method="post"  enctype="multipart/form-data"> --}}
                                {{-- enctype="multipart/form-data" --}}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label for=""> Enter Contest Name</label><br>
                                    <input type="text" name="con_name" id="con_name" aria-describedby="helpId">
                            <span id="econ_name"></span>
                                </div>
                                <div class="form-group">
                                    <label for=""> Do you want time barriour</label><br>
                                    <select name="con_time" id="con_time" required onchange="time(this.value);">
                                        <option value="no">no</option>
                                        <option value="yes">yes</option>
                                    </select>
                                </div>
                                <div class="form-group take_t">
                                    <label for=""> Contest Date </label><br>
                                    <input type="date" name="date" id="from" />
                                </div>
                                <div class="form-group take_t">
                                    <label for=""> Contest Start Time</label><br>
                                    <input type="time" name="from" id="from" />
                                </div>
                                <div class="form-group take_t">
                                    <label for=""> Contest End Time</label><br>
                                    <input type="time" name="to" id="to" />
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                {{-- second grid --}}
                <div id="grid_div2">


                    <div>
                        <div id="login_h">
                            Give Question
                        </div>

                        <div id="form_container">
                            <div id="forms">
                                <div class="qdiv1 qdiv">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <div class="form-group2">
                                        <label for="">Q.1</label><br>
                                        <input type="text" name="q1" id="q1" required />
                            <span id="eq1"></span>

                                    </div>
                                    <div class="form-group3">
                                        <label for="">Image (if required)</label><br>
                                        <input type="file" name="fq1" />
                                    </div>
                                    <div class="form-group3">
                                        <label for="">Option 1</label><br>
                                        <input type="text" name="q1o1" required />
                            <span id="eq1o1"></span>
                                        
                                    </div>
                                    <div class="form-group3">
                                        <label for="">Option 2</label><br>
                                        <input type="text" name="q1o2" required />
                            <span id="eq1o2"></span>
                                        
                                    </div>
                                    {{-- <button id="addq" >Add Option</button> --}}
                                    <p onclick="addo(this);" id="q1os">Add Option</p>
                                    {{-- onclick="addo(this);" --}}
                                    <input type="hidden" class="q1os" value=3 id=1>
                                    <div class="form-group3">
                                        <label for=""> Correct Answer</label><br>
                                        <select name="answer1" id="answer1" required>
                                            <option value="no">Select the correct option</option>
                                            <option value="1">Option 1</option>
                                            <option value="2">Option 2</option>
                                        </select>
                                    </div>
                                </div>
                                <p onclick="addq(this);" id="qs">Add Question</p>
                                <input type="hidden" class="qs" name="qs" value=2>
                                <div class="form-group">

                                    <input type="submit" name="submit" id="send" value="REGISTER">
                                </div>
                                {{-- --}}
                            </div>
                        </div>
                    </div>


                </div>
            </form>
        </div>



        {{-- third grid --}}

        <div id="grid_div3"><div class="ihead">
            Instruction
        </div>
        
<li> Give a name to contest.</li>
<li> Select 'yes' in ("do you want time") option to make your cotest live on a specific date and time.</li>
<li> If selected yes then select date and time.</li>
<li> If selected no the contest will e live for forever.</li>
<li> 5 option can be add to one question.</li>
<li> Click 'add option' to increase option.</li>
<li> Select the the correct option to generete automatic result.</li>
<li> Result will be wrong if answer will be wrong or empty.</li>
<li> Click 'add question' to increase question.</li>
<li> Unlimited on. of question cae added.</li>
 </pre>
        </div>
    </div>
    <script src="js/jquary.js"></script>

    <script>
        function time(value) {
            if (value == "yes") {
                $(".take_t").css("display", "block");
            } else {
                $(".take_t").css("display", "none");
            }
        }

        function addo(value) {

            opnum = $(value).attr('id');

            if ($('.' + opnum).attr('value') == 6) {
                $("#" + opnum).before("<div id= 'alart" + opnum + "'></div>");
                $("#alart" + opnum).html("");
                console.log();
                $("#alart" + opnum).append("<b>fgh</b>");

                return;
            }

            append = "<div class='form-group3'><label for=''>Option " + $('.' + opnum).attr('value') +
                "</label><br><input type='text' name='q" + $('.' + opnum).attr('id') + "o" + $('.' + opnum).attr('value') +
                "' /></div>";
            appendo = "<option value='" + $('.' + opnum).attr('value') + "'>Option " + $('.' + opnum).attr('value') +
                "</option>";
            $("#answer" + $('.' + opnum).attr('id')).append(appendo);

            $("#" + opnum).before(append);
            ropnum = $("." + opnum).attr('value');
            ropnum = eval(ropnum);
            $("." + opnum).attr('value', ropnum + 1);


            // console.log(append);
        }
        // add question function
        function addq(value) {
            console.log(value);

            qpnum = $(value).attr('id');

            append2 = ' <div class="qdiv1 qdiv"><div class="form-group2"><label for="">Q.' + $('.' + qpnum).attr('value') +
                '</label><br><input type="text" name="q' + $('.' + qpnum).attr('value') +
                '" /></div><div class="form-group3"><label for="">Image (if required)</label><br><input type="file" name="fq' +
                $('.' + qpnum).attr('value') +
                '" /></div><div class="form-group3"><label for="">Option 1</label><br><input type="text" name="q' + $('.' +
                    qpnum).attr('value') +
                'o1" /></div><div class="form-group3"><label for="">Option 2</label><br><input type="text" name="q' + $(
                    '.' + qpnum).attr('value') + 'o2" /></div><p onclick="addo(this);" id="q' + $('.' + qpnum).attr(
                    'value') + 'os">Add Option</p><input type="hidden" class="q' + $('.' + qpnum).attr('value') +
                'os" value=3 id =' + $('.' + qpnum).attr('value') +
                ' ><div class="form-group3"><label for=""> Correct Answer (if required)</label><br><select name="answer' +
                $('.' + qpnum).attr('value') + '" id="answer' + $('.' + qpnum).attr('value') +
                '"><option value="no">Select the correct option</option><option value="1">Option 1</option><option value="2">Option 2</option></select></div></div>';

            $("#" + qpnum).before(append2);
            rqpnum = $("." + qpnum).attr('value');
            rqpnum = eval(rqpnum);
            $("." + qpnum).attr('value', rqpnum + 1);
        }
        // ajax function

        $('#form').submit(function(e) {
            e.preventDefault();
            $.ajax({

                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                url: "{{ url('/create_contest_q') }}",
                type: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                processData: false,
                error:function (request,status,error){
                    var go= request.responseText;
                        var goo = JSON.parse(go);
                        document.getElementById("econ_name").innerHTML=goo.con_name[0];
                        document.getElementById("eq1").innerHTML=goo.q1[0];
                        document.getElementById("eq1o1").innerHTML=goo.q1o1[0];
                        document.getElementById("eq1o2").innerHTML=goo.q1o2[0];

                },
                success: function(result) {
if (result ==1) {
    window.location = '/home';
}

                }
            });
        });
    </script>
@endsection
