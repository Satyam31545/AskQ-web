@extends('layout.main')

@push('title')
    <title>Enter Contest</title>

    <style>
        .headd {
            color: red;
            text-align: center;
            font-size: 55px;
margin-bottom: 30px;
padding-bottom: 15px; 
        } 
       .entercon{
        display: flex;
        justify-content: center;
margin-top: 20px;
margin-bottom: 20px;
       }
       .enter{
        border: 2px solid red ;
       width: 450px;
        height: 500px;
        background-color: white;
        text-align: center;
       }
       form>span{
        color: red;
       }
       input{
        margin-top: 20px;
        width:300px;
        height: 30px;
        font-size: 20px;
        border-bottom: 2px solid black;
    box-shadow: 0px 0px 0px #888888;   

       }
       .submit{
        color: white;
        border-bottom: 0px solid black;
        background-color: red;
        height: 35px;
        /* width:240px; */
}
#footer{
    display: none;
}
@media screen and (max-width:520px) {
    .enter{
       width: 400px;
        height: 500px;
       }
       .headd {
            height: 60px;
            font-size: 45px;
        }
        input{
      
        width:300px;
        height: 30px;
       }
        }
        @media screen and (max-width:420px) {
    .enter{
       width: 300px;
        height: 400px;
       }
       .headd {
            height: 60px;
            font-size: 40px;
        }
        input{
      
        width:250px;
        height: 30px;
       }
        }


    </style>
@endpush
@section('main-section')
    
       
       <div class="entercon">
        <div class="enter">
            <div class="headd">Enter Contests</div>
            <form id = "form">
                <input type="hidden" name="_token" value="{{csrf_token() }}">
                
       <input type="text" placeholder="Contest name" name="contest"><br><span id="econtest"> </span>
       <input type="password" placeholder="Password" name="password"><br><span id="epassword"> </span><br>
       <input type="submit" class="submit"></form>
       </div>
    </div>
    <script src="js/jquary.js"></script> 
             <script> 
          
          jQuery('#form').submit(function(e){
  e.preventDefault();
  jQuery.ajax({
    headers:
    {
        'X-CSRF-Token': $('input[name="_token"]').val()
    },
                  url: "{{url('/enter_contest')}}",
                    type: "POST",
                    data: jQuery('#form').serialize(),
                    error:function (request,status,error){
                    var go= request.responseText;
                        var goo = JSON.parse(go);
                        document.getElementById("econtest").innerHTML=goo.contest[0];
                        document.getElementById("epassword").innerHTML=goo.password[0];

                },
                    success : function(result){
               if(result != -1){
 
 window.location = '/start_con';
               }
              
              }
  });
});

    </script>
@endsection
