<?php
session_start();
error_reporting(0);
include('../model/config.php');
// Code user Registration
//That 's how i addressed /implemented  virtual identity for this game
if(isset($_POST['submit']))
{
    $name=$_POST['fullname'];
    $email=$_POST['emailid'];
    $password=md5($_POST['password']);
    $confirm_password  = $_POST['confirmpassword'];
    //prepare a SQL statement to insert the user's data into the user table
    $query=mysqli_query($con,"insert into users(name,email,password)values('$name','$email','$password')");
    if($query) 
    {
        echo "<script>
                alert('Registration success.');
                window.location.href='./index.php';
              </script>";
    }
    else{
        echo "<script>alert('Not register something went worng');</script>";
    }
}
?>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="../Controller/css/mdb.min.css">
    <!-- This is how I used and discuss/implemented  virtual identity for this game -->
     <!-- This is how I used and discuss/implemented  virtual identity for this game -->
    <!-- Validate the Password , fullname and  Email   Address using javascript function -->
    <script type="text/javascript">
        function valid()
        {
            if(document.register.password.value!= document.register.confirmpassword.value)
            {
                alert("Password and Confirm Password Field do not match!!");
                document.register.confirmpassword.focus();
                return false;
            }
                return true;
        }

        var x= document.forms["register"]["fullname"].value;
        if(x==null || x==""){
                alert("Full name must be filled out");
                return false;
        }

        var y = document.forms["register"]["emailid"].value;
        var atpos  = y.indexOf("@");
        var dotpos = y.lastIndexOf(".");
        if( atpos< 1 || dotpos< atpos+2 ||  dotpos +2 >=y.length){
            alert("Not a valid e-mail address");
            return false;
        }
    </script>
    
    <script>
        /*
        * Check the user's avialbility using the  HTTP  POST method  using jquery  ajax  function to validate the email address.
        */
        function userAvailability() {
            $("#loaderIcon").show();
                jQuery.ajax({
                url: "check_availability.php",
                data:'email='+$("#email").val(),
                type: "POST",
                success:function(data){
                    $("#user-availability-status1").html(data);
                    $("#loaderIcon").hide();
                },
                error:function (){}
            });
        }
    </script>
</head>
<body>
    <section class="vh-100" style="background-color: #acc3de;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="../Controller/images/download (3)-modified.png"
                                    style="border-image-repeat: repeat;padding-top:30%;padding-left: 30%;size: 50%;"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form role="form" method="post" name="register" onSubmit="return valid();">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0">Math Game</span>
                                        </div>
                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                                            account
                                        </h5>
                                        <div class="form-outline mb-4">
                                            <input type="text" id="fullname"  name="fullname"
                                                class="form-control form-control-lg"     required="required"/>
                                            <label class="form-label" for="fullname">Full Name<span>*</span></label>
                                        </div>
                                        <div class="form-outline ">
                                            <input type="email" id="email"  onBlur="userAvailability()" name="emailid" class="form-control form-control-lg" oninput="check_email()"  required/>
                                            <label class="form-label" for="exampleInputEmail2">Email address<span>*</span></label>
                                            <span id="user-availability-status1" style="font-size:12px;"></span>
                                        </div>
                                        <span id="email_status" style="font-size: 12px;"></span>
                                        <div class="form-outline mt-4 mb-4">
                                            <input type="password"  id="password" name="password" class="form-control form-control-lg"  required="required"      />
                                            <label class="form-label" for="form2Example27">Password</label>
                                        </div>
                                        <div class="form-outline">
                                            <input type="password" id="confirmpassword" name="confirmpassword"  class="form-control form-control-lg" required oninput="pass_match_check()"/>
                                            <label class="form-label" for="confirmpassword">Confirm Password<span>*</span></label>
                                        </div>
                                        <span id="re_pass_status" style="font-size: 12px;"></span>
                                        <div class="pt-4 mb-4">
                                            <button type="submit"  class="btn btn-dark btn-lg btn-block"  name="submit" id="submit"
                                                style="color: rgba(21, 21, 24, 0.873);background-color: blue;">Register</button>
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

<!-- Latest compiled JavaScript -->
<script type="text/javascript" src="../Controller/js/mdb.min.js"></script>

<script type="text/javascript" src="../Controller/js/mdb.min.js.map"></script>
<!-- implemented Javascript validation functions to verify the  password  and email-->

<script>
      // Validate the password 
    function pass_match_check(){
        var pass = document.getElementById("password").value;
        var repass = document.getElementById("confirmpassword").value;

        if(pass == repass){
            document.getElementById("re_pass_status").innerHTML = "Passwords are matching.";
            document.getElementById("re_pass_status").style.color = "green";
        }else{
            document.getElementById("re_pass_status").innerHTML = "Passwords are not matching.";
            document.getElementById("re_pass_status").style.color = "red";
        }
    }
 // vaidate the email 
    function check_email(){
        var email = document.getElementById("email").value;
       
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(emailRegex.test(email)){
            document.getElementById("email_status").innerHTML = "Valid email";
            document.getElementById("email_status").style.color = "green";
        }else{
            document.getElementById("email_status").innerHTML = "Invalid email";
            document.getElementById("email_status").style.color = "red";
        }

    }
</script>
</html>