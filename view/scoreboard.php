<?php 
session_start();
include("../model/config.php");

?>
<DOCTYPE html>
<html>
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
    
<?php include('../Controller/nav.php'); ?>
    <div >
        <section class="pb-5" style="background-color: #DCD9D4;
                                       background-image: linear-gradient(to bottom, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), radial-gradient(at 50% 0%, rgba(255,255,255,0.10) 0%, rgba(0,0,0,0.50) 50%);
                                       background-blend-mode: soft-light,screen;">
            <div class="container pt-5">
               <h2 class="text-center text-dark text-uppercase text-decoration-underline" style="font-weight: 800;">Score Dashboard</h2 >
                <div class="row pt-4">
                    <div class="col-8 bg-white rounded p-4">
                      <br/>
                    
                     
                      <hr/>
                      <center>
                        <h2>Total Score <span id='total_score'></span></h2>
                      </center>
                      <h6 class="text-dark  mt-4" style="font-weight: 900;">Your Level</h6>
                      <div class="progress" style="height: 18px;">
                          <div class="progress-bar progress-bar-striped bg-danger" id="levelBar" role="progressbar" style="width: 10%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <div class="text-end">
                          <span style="font-weight:400;">Level : </span><span style="font-weight:400;" id="current_level"> </span><span style="font-weight:400;"> / 1000 </span>
                      </div>
                     
                      <br/>
                    </div>
                    <div class="col-4  ">
                        <div class="bg-white rounded p-4">
                            <h4 class="text-dark  mt-4 text-center text-decoration-underline text-uppercase" style="font-weight: 900;">Other  Players</h4>
                            <hr/>
                            <table class="table">
                                <thead style="background-color: #2A2A29;">
                                    <tr class="text-center">
                                        <td class="text-white">User Name</td>
                                        <td class="text-white">Total Score</td>
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
<script>
        
        /*
        * I get the code trom this tutorial https://www.tutsmake.com/how-to-fetch-data-from-database-in-php-using-ajax/
        * call  the backend url file and then decode the retrieve encoded json data using ajax jquery to fetch the data from database and  display data 
        */
        cal_t_score();
        
        // fetch/retrieve and  display  data from MySQL database using ajax jQuery
        function cal_t_score(){
            $.ajax({
                type: 'post',
                data: {
                    status: 'get_total_score'
                },
                url: '../Controller/socore_action.php',
                success: function(returnData) {

                    var cal_level = (JSON.parse(returnData.total_score) / 10.00);
                    const progressBar = document.getElementById('levelBar');
                    const progressValue = cal_level.toFixed(0); // set the progress value as desired
                    progressBar.style.width = `${progressValue}%`;
                    progressBar.setAttribute('aria-valuenow', progressValue);
                    
                    document.getElementById("current_level").innerHTML = cal_level.toFixed(0);
                    document.getElementById("total_score").innerHTML = " : "+returnData.total_score;
                }
            });
        }

        /*
        * Load the all players data and convert it into the json type data then  pass the data using for loop and display the score of all plyers in a table
        */
        top_players();
        function top_players(){
            $.ajax({
                type: 'post',
                data: {
                    status: 'get_all_players'
                },
                url: '../Controller/socore_action.php',
                success: function(returnData) {
                    var arr = JSON.parse(returnData);
                    var html = "";
                  /*
                  * pass the json type data using for loop and display  all players total score in  a  table
                  */
                    for(var i = 0; i < arr.length; i++){
                        html +="<tr class='text-center'><td>"+arr[i].user_id+"</td><td>"+arr[i].total_score+"</td></tr>";
                    }
                    $(".top_player_tbl").html(html);
                    
                }
            });
        }
</script>
</body>

</html>