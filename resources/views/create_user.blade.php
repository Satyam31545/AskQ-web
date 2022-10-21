<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AskQ | Create</title>
    <link rel="stylesheet" href="css/mystyle.css">
<style>
    #login{
      width: 450px;
  }

</style>
</head>
<body>
    <div id="container">
        <div id="header">
           AskQ
        </div></div>
         <div id="login_box">
             
              <div id="login">
            <div id="login_h">
                 REGISTRATION 
            </div>
   
             <div id="form_container">
             <div id="forms">
                <form id="form">
                    <input type="hidden" name="_token" value="{{csrf_token() }}">
                    <div class="form-group">
                      
                        <input type="text" name="name" id="name" aria-describedby="helpId" placeholder="     Name">
                        <span id="ename"></span>
                      </div>
                   <div class="form-group">
                      
                      <input type="email" name="email" id="email" aria-describedby="helpId" placeholder="     Email">
                      <span id="eemail"></span>

                    </div>
                    <div class="form-group">
            
                      <input type="password" name="password" id="password" aria-describedby="helpId" placeholder="    Password">
                      <span id="epassword"></span>
                      
                    </div>
                    <div class="form-group">
            
                        <input type="number" name="photoid"  aria-describedby="helpId" placeholder="    photoid">

                      </div>
                    <div class="form-group">
                    <input type="submit" name="submit" id="send"  value="REGISTER"> </div>
                  </form>
             </div>
            </div>
            <div id="create">Already Registered ? <a href="/">Login</a></div>
           </div></div>
           <script src="js/jquary.js"></script> 
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  <script> 
          
          jQuery('#form').submit(function(e){
  e.preventDefault();
  jQuery.ajax({
    headers:
    {
        'X-CSRF-Token': $('input[name="_token"]').val()
    },
    url: "{{url('/create')}}",
                    type: "POST",
                    data: jQuery('#form').serialize(),
                    error:function (request,status,error){
                    var go= request.responseText;
                        var goo = JSON.parse(go);
                        document.getElementById("eemail").innerHTML=goo.email[0];
                        document.getElementById("epassword").innerHTML=goo.password[0];
                        document.getElementById("ename").innerHTML=goo.name[0];

                },
                    success : function(result){
               window.location = result;
              }
  });
});

    </script>

</body>
</html>