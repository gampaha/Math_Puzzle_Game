<?php
session_start();

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
    <section class="vh-100" style="background-color: #DCD9D4;
                                       background-image: linear-gradient(to bottom, rgba(255,255,255,0.50) 0%, rgba(0,0,0,0.50) 100%), radial-gradient(at 50% 0%, rgba(255,255,255,0.10) 0%, rgba(0,0,0,0.50) 50%);
                                       background-blend-mode: soft-light,screen;">
        <div class="container py-5 h-100" >
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;background: #F8F9FA;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block ">
                                <img src="../Controller/images/play3-modified.png"
                                    style="border-image-repeat: repeat;padding-top:25%;padding-left: 25%; size: 100%;"
                                    alt="login form" class="img-fluid " style="border-radius: 1rem 0 0 1rem;" />
                                    
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form action="home.php" method="post">
                                        <div class="d-flex align-items-center mb-3 pb-1" style="font:large cursive;"><span
                                                class="h1 fw-bold mb-0" style="text-transform:capitalize">Math Puzzle Game</span>
                                        </div>

                                        <h5 style="color:solid black;font: size 19px;font:large cursive;font: size 19px;">Please Refer the instructions before play the Game</h5>
                                        <p class="text-info" style="align-content:justify;color:#ACC3DE;font: size 19px;font:large cursive;">1.Complete each level by finding the missing digit</p>
                                        <p class="text-info" style="align-content:justify;color:#ACC3DE;font: size 19px;font:large cursive;">2.If you give the correct answer for the question update your score within 10 points</p>
                                        <p class="text-info" style="align-content:justify;color:#ACC3DE;font: size 19px;font:large cursive;">3.If you give incorrect answer you have not get marks and you can  try again</p>

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


</html>