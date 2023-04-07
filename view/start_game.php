<?php
//start the session 
 session_start();

?>
<!DOCTYPE html>
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

    <title>Start Game-Smile Game</title>
    <script>
        //timer
        /*
        * I get an idea and the concept of below code from https://stackoverflow.com/questions/61008898/javascript-time-counter-running-backwards
        */
       //set the coundwon timer 
        var countdown = "";
        timer();
        /*
        * call the timer function when start the game by  player.The player must give the answer with 3 minutes .
        */
        function timer(){
            //Convert minutes to the seconds 
            let secondsLeft = 3 * 60; // 3 minutes in seconds

           //using the setinterval function decrease the time backward 
            countdown = setInterval(() => {
                const minutes = Math.floor(secondsLeft / 60);
                const seconds = secondsLeft % 60;

                document.getElementById("timer").innerHTML = `00:${('0' + minutes).slice(-2)}:${seconds.toString().padStart(2, '0')}`;
                // the timer display green color when the timer is rnning backward and time  duration between  2-3 minutes  from the game start time by the player 
                if(minutes >= 2){
                    document.getElementById("timer").style.color = "#119271";
                
                // the timer is dsiplay red color when time is down  less than 1 minutes from the timer is running backward from game start time
                }else if((minutes < 2) && (minutes >= 1)){
                    document.getElementById("timer").style.color = "#E49B08";
                }else{
                    document.getElementById("timer").style.color = "#D30808";
                }
                // when the timer is zero (0) then  display the timeout message 
                if (secondsLeft === 0) {
                    clearInterval(countdown);
                    alert_time_close();
                }
                
                secondsLeft--;
            }, 1000);
        }
        // display the time over message when over the 3 minutes of play  duration  for a player 
        
        // I get the idea and customize the code using this library https://sweetalert2.github.io/
        function alert_time_close(){
            
            //when time over, system will show this message
            Swal.fire({
                    title: 'Time Over!',
                    imageUrl: 'https://media.tenor.com/zcgSvQM7muYAAAAC/clock-alarm-clock.gif',
                    imageWidth: 400,
                    imageHeight: 350,
                    imageAlt: 'Custom image',
                    confirmButtonText: 'New Game..',
                    cancelButtonText: 'Exit',
                    showCancelButton: true,
                    showCloseButton: false,
                    timerProgressBar: true
            }).then((result) => {
                    if (result.isConfirmed) {
                        newgame();
                    }else{
                        newgame();
                    }
            });
        }

        var quest = "";
        var solution = -1;
        var Points = 0;
        var counter = 0;
        let newgame = function(x) {
            startup();
            document.getElementById("input").value = "";
            // clear the count down timer and refresh and calculate the total score 
            clearTimeout(countdown);
            timer();
            cal_t_score();
        }
        // Implement the handle input function  
        let handleInput = function(x) {
            let inp  = document.getElementById("input");
            var note = document.getElementById("note");
            if (inp.value == solution) {
                note.innerHTML =
                    ' Nice 😎 Your answer is Correct!<span> congrats! 🎉 -  <button class="button-62 btn btn-dark" onClick="newgame()" >New game?</button>';
                
                //if answer is correct
                /*
                * add the score value to the score table in math_puzzle game database 
                */
                /*
                * I get the idea from this library https://sweetalert2.github.io/
                */
                add_socore_db();
                Swal.fire({
                    title: 'Congratulation!',
                    imageUrl: 'https://www.gifcen.com/wp-content/uploads/2021/07/well-done-gif-12.gif',
                    imageWidth: 400,
                    imageHeight: 300,
                    imageAlt: 'Custom image',
                    timer: 5000,
                    confirmButtonText: 'New Game..',
                    cancelButtonText: 'Exit',
                    showCancelButton: true,
                    showCloseButton: false,
                    timerProgressBar: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        newgame();
                    }else{
                        newgame();
                    }
                });
            } else {

                //if answer is not correct
                note.innerHTML = "Sorry 😐 , Your answer is not Correct! ";
            }
     
        }
        
        let startQuest = function(data) {
            var parsed = JSON.parse(data);
            quest = parsed.question;
            solution = parsed.solution;
            let img = document.getElementById("quest");
            img.src = quest;
            let note = document.getElementById("note");
            note.innerHTML = "Quest is ready.";
            img.onerror = () => {
                note.innerHTML = "Invalid Image Score.";
            }
        }
        /* This is the code how  I have addressed/implementing Interoperability  into my  game (API that smile  game is connected with) */
        /*  API that my  game is connected with */
        let fetchText = async function() {
            let response = await fetch('https://marcconrad.com/uob/smile/api.php');
            let data = await response.text();
            startQuest(data);
        }
        let startup = function() {
            fetchText();
        }
        // save the score details to the score table in math_puzzle Database
        function add_socore_db(){
            $.ajax({
                type: 'post',
                data: {
                    status: 'add_score'
                },
                url: '../Controller/socore_action.php',
                success: function(returnData) {
                    console.log(returnData);
                }
            });
        }
        // display the score when load the page  using ajax call  the  function in the backend 
        cal_t_score();
        function cal_t_score(){
            $.ajax({
                type: 'post',
                data: {
                    status: 'get_total_score'
                },
                url: '../Controller/socore_action.php',
                success: function(returnData) {
                    // If the player give the correct value as the input level is raised 
                    var cal_level = (JSON.parse(returnData.total_score) / 10.00);
                    const progressBar = document.getElementById('levelBar');
                    const progressValue = cal_level.toFixed(0); // set the progress value as desired
                    progressBar.style.width = `${progressValue}%`;
                    progressBar.setAttribute('aria-valuenow', progressValue);
                    
                    document.getElementById("curSrent_level").innerHTML = cal_level.toFixed(0);
                }
            });
        }



        // retrieve  the data from score table and display  other players details 
        top_players();
        function top_players(){
            $.ajax({
                type: 'post',
                data: {
                    status: 'get_top_players'
                },
                url: '../Controller/socore_action.php',
                success: function(returnData) {
                    var arr = JSON.parse(returnData);
                    var html = "";
                  
                    for(var i = 0; i < arr.length; i++){
                        html +="<tr class='text-center'><td>"+arr[i].user_id+"</td><td>"+arr[i].total_score+"</td></tr>";
                    }
                    $(".top_player_tbl").html(html);
                    
                }
            });
        }
    </script>
</head>
<body>
    <?php include('../Controller/nav.php'); ?>
    <div>
        <section class="pb-5" style="background-color: #DCD9D4;
                                       background-image: linear-gradient(to bottom, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), radial-gradient(at 50% 0%, rgba(255,255,255,0.10) 0%, rgba(0,0,0,0.50) 50%);
                                       background-blend-mode: soft-light,screen;">
            <div class="container pt-5">
                <div class="row pt-2">
                    <div class="col-8 bg-white rounded p-4">
                        
                        <script>
                            startup();
                            
                        </script>
                        <h2 class="text-center text-dark mt-2" style="font-weight: 800;">MATHS PUZZEL GAME.</h2>
                        <h4 class="text-dark text-center" id="note">Not ready</h4>
                        <br/>
                        <div class=" text-center rounded" style="border: 1px solid #DEDCD6;">
                            <img id="quest" class="p-4"  width="90%" />
                        </div>
                        <div>
                            <br/>
                            <h5 style="color:#935E22;">Enter the missing value : <h5>
                            <div class="row">
                                <div class="col-8">
                                    <input class="form-control form-control-lg rounded" style="background-color:#E1CF98; font-weight:600; " id="input" name="answer" onchange="handleInput()" type="number" step="1" min="0" max="9" />
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-success btn-lg" name="answer"><i class="bi bi-check-circle"></i> Submit</button>
                                    <button type="button"  class="btn btn-danger btn-lg"  class="" id="quit" onclick="window.location.href='home.php'" ><i class="bi bi-x-circle"></i> Quit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4  ">
                        <div class="bg-white rounded p-4">
                            <h1 class="text-center mt-3 display-3" id="timer" style="font-weight: 800;">00:00:00</h1>
                            <center><span class="text-muted">Count Down</span></center>
                            <hr/>
                            <h6 class="text-dark  mt-4" style="font-weight: 900;">Your Level</h6>
                            <div class="progress" style="height: 18px;">
                                <div class="progress-bar progress-bar-striped bg-danger" id="levelBar" role="progressbar" style="width: 10%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="text-end">
                                <span style="font-weight:400;">Level : </span><span style="font-weight:400;" id="current_level"> </span><span style="font-weight:400;"> / 1000 </span>
                            </div>
                            <br/>
                            <h6 class="text-dark  mt-4" style="font-weight: 900;">Top 10  Players</h6>
                            <table class="table">
                                <thead style="background-color: #2A2A29;">
                                    <tr class="text-center">
                                        <td class="text-white">User Name</td>
                                        <td class="text-white">Level</td>
                                    </tr>
                                </thead>
                                <tbody class="top_player_tbl">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
           
        </section>
    </div>
</body>
</html>