<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/mystyle.css">
    @stack('title')
    <link rel="icon" type="image/x-icon" href="/file/myfile/favicon.ico">
    <style>
@media screen and (max-width:520px) {
    #menu{
      font-size: 70px;
       }
       .bar1, .bar2, .bar3 {
  width: 40px;
  height: 7px;
  margin: 7px 0;

}
       
        }
    </style>
</head>

<body>
    <div id="h_container">
        <div id="menu">
            <div class="menu_container" onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            AskQ
        </div>
    </div>
    <div id="mySidenav" class="sidenav">
        <a href="/home">Home</a>
        <a href="/create_contest">create_contest</a>
        <a href="/enter_contest">Enter Contest</a>
        <a href="/my_result">My Result</a>
        <a href="/logout" onclick="return confirm('are you sure want to logout ?')">Logout</a>

    </div>
    <script>
        var a = 0;
        // menu script
        function myFunction(x) {
            x.classList.toggle("change");
            if (a == 0) {
                openNav()
                a = 1;
            } else {
                closeNav()
                a = 0;
            }
        }
        // nav script
        function openNav() {
            document.getElementById("mySidenav").style.width = "300px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";

        }
    </script>
