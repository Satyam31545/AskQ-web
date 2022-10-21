<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AskQ | Error</title>
    <link rel="stylesheet" href="http://127.0.0.1:8000/css/mystyle.css">
<style>
   #error-d{
margin-top: 8%;
display: grid;
grid-auto-rows: auto auto;
text-align: center;
   } 
   .error{

   }
</style>
</head>

<body>
    <div id="container">
        <div id="header">
            AskQ
        </div>
    </div>
    <div id="error-d">
<div class="error">{{$statement}}</div>
<div class="link"><a href="{{$link}}">Click Here</a></div>
    </div>

</body>

</html>
