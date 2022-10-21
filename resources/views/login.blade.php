<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AskQ | Login</title>
    <link rel="stylesheet" href="css/mystyle.css">

</head>

<body>
    <div id="container">
        <div id="header">
            AskQ
        </div>
    </div>
    <div id="login_box">

        <div id="login">
            <div id="login_h">
                LOGIN 

            </div>

            <div id="form_container">
                <div id="forms">
                    <form id="form">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">

                            <input type="email" name="email" id="email" aria-describedby="helpId"
                                placeholder="     Email">

                            <span id="eemail"></span>
                        </div>
                        <div class="form-group">

                            <input type="password" name="password" id="password" aria-describedby="helpId"
                                placeholder="    Password">
                                <span id="epassword"></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="send" value="LOGIN">
                        </div>
                    </form>
                </div>
            </div>
            <div id="create">Not Registered ? <a href="/create">Create Account</a></div>
        </div>
    </div>
    <script src="js/jquary.js"></script>
    <script>
        jQuery('#form').submit(function(e) {
            e.preventDefault();
            jQuery.ajax({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                url: "{{ url('/login') }}",
                type: "POST",
                data: jQuery('#form').serialize(),
                error:function (request,status,error){
                    var go= request.responseText;
                        var goo = JSON.parse(go);
                        document.getElementById("eemail").innerHTML=goo.email[0];
                        document.getElementById("epassword").innerHTML=goo.password[0];

                },
                

                success: function(data) {
if (data ==1) {
      window.location = '/home';
}

                }
            });
        });
    </script>

</body>

</html>

{{-- /*
body{
  background-color: rgb(252, 230, 230);   
}
#container{
padding: 0px;
margin :0px ;
display:flex;
justify-content: center;
color: rgb(240, 27, 27);
background-color: rgb(121, 210, 233);   
border-bottom: 2px solid rgb(0, 0, 0);
font-size: 80px;

}
#login_box{


display:flex;
justify-content: center;
margin: 10px;
}
#login{
height: 500px;
width: 400px;
/* display:block; */
/* justify-content: center;  */  
/* border: 2px solid black; */
/* box-shadow: 2px solid red; */
box-shadow: 0.5px 0.5px 3px 3px #888888;

background-color: rgb(243, 243, 252);   

}
#login_h{
display:flex;
justify-content: center; 
font-size: 25px; 
}
#form_container{
display:flex;
justify-content: center;  
}
input{
height: 30px;
width: 250px;
border: 0px solid black;
font-size: 15px;
/* padding-left: 10px; */
}
label{
font-size: 35px;
}
.form-group{
margin: 15px;
}
#send{
background-color: rgb(252, 4, 4);  
color:rgb(252, 243, 243) ;
/* padding-left: 0px; */
font-size: 25px;
width: 255px;
}
#create{
text-align: center;
}*/ --}}
