<?php
//start and intialize the session
session_start();
//import the database connection class 
include('../model/config.php');
?>
<html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="GENERATOR" content="A plain text editor">
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.3/cerulean/bootstrap.min.css"
        type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.3/cosmo/bootstrap.min.css"
        type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.3/sketchy/bootstrap.min."
        type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</head>

<body>
    
    <?php include '../Controller/nav.php'; ?>
    <div class="center-screen">
    <div class="text center">
    <section class="vh-100" style="background-color: #DCD9D4;
                                       background-image: linear-gradient(to bottom, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), radial-gradient(at 50% 0%, rgba(255,255,255,0.10) 0%, rgba(0,0,0,0.50) 50%);
                                       background-blend-mode: soft-light,screen;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;background-color:#F0F5FA">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block mb-5">
                                <img src="../Controller/images/unnamed.png"
                                    style="border-image-repeat: repeat;padding-top:25%;padding-left: 25%;size: 50%;"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                                    
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form action="home.php" method="post">
                                        <div class="d-flex align-items-center mb-3 pb-1"><span
                                                class="h1 fw-bold mb-0">Math Puzzle Game</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Home Interface</h5>
                                        <!-- I get and idea for the code from this website    https://www.w3schools.com/jsref/event_onclick.asp-->
                                        <div class="d-grid gap-2">
                                             
                                                <button class="btn btn-lg btn-primary" type="button" id="start"
                                                style="color:blue;" onclick="start_game()" >Start Game</button>

                                                <button class="btn btn-lg btn-primary" type="button" id="play"
                                                style="color:blue;" onclick="howtoplay()" >Game Conditions and Instructions</button>
                                                
                                                <button class="btn btn-lg btn-primary" type="button" id="scoreboard"
                                                style="color:blue;" onclick="score()" >ScoreBoard</button>

                                                <button name="logout"  class="btn btn-lg btn-primary" type="button" style="color:blue" onclick="return confirmLogOut()" id="logout" > Logout</button>


                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<!--This is how I used Event Driven Programming to this game -->
<script type="text/javascript" charset="utf-8" language="javascript">
function start_game() {
    window.location.href = "./start_game.php";
}
function howtoplay() {
    window.location.href = "./play.php";
}
function score() {
    document.location.href = "./scoreboard.php";
}
// implement event driven programming  using javascript to logout button
function confirmLogOut() {
var reallyLogout = confirm("Do you really want to log out?");
  if(reallyLogout){
    window.location.href= "../Controller/logout.php";
    return true;
    }else{
    return false;
    }
}
/* add event driven programming using  jQuery Event Handling ,
Event binding using addEventListener  */

/*  I get this code from this website  https://stackoverflow.com/questions/22604401/how-to-add-onclick-to-a-html-element-dynamically-using-javascript */
/*  Add an Observer Eventlistener  to the code  Dynamically */

var logout = document.getElementById("logout");
logout.addEventListener("click", function(event) {
    alert("You are logout");
}, false);
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

</html>