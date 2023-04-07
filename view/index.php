<?php
// Starting the session, necessary for using session variables
session_start();
error_reporting(0);
/* include config file */
include('../model/config.php');
// Code for User login
// This is how i addressed  Virtual identity in this game
/*
* I get this code from https://www.javatpoint.com/how-to-get-the-ip-address-in-php#:~:text=The%20simplest%20way%20to%20collect,is%20currently%20viewing%20the%20webpage
*  It returns the IP address of the user currently visiting the webpage.The simplest way to collect the visitor IP address in PHP is the REMOTE_ADDR. Pass the 'REMOTE_ADDR' in PHP $_SERVER variable. It will return the IP address of the visitor who is currently viewing the webpage.
*/
function getClientIP():string
{
    $keys=array('HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR');
    foreach($keys as $k)
    {
        if (!empty($_SERVER[$k]) && filter_var($_SERVER[$k], FILTER_VALIDATE_IP))
        {
            return $_SERVER[$k];
        }
    }
    return "UNKNOWN";
}

if(isset($_POST['login-submit']))
{
    // Receiving the values entered and storing in the variables
    $email=$_POST['emailid'];
    // Password encryption to increase data security
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
    $num=mysqli_fetch_array($query);
    if($num>0)
    {
            $extra="home.php";
            // Storing username in session variable
            $_SESSION['login-submit']= $_POST['emailid'];
            /*  I have used PHPSESSID cookie, which stores the session id passed by the
            server. I have stored  username in session variable . Initialize the 
            session  with  session id */
            $_SESSION['id']=$num['id'];
            $_SESSION['username']=$num['name'];

            $status=1;
            // prepare a  SQL  statement to Insert data into the userlog table
            $log=mysqli_query($con,"insert into userlog(userEmail,userip,status)values('".$_SESSION['login-submit']."','".getClientIP()."','$status')");
            $host=$_SERVER['HTTP_HOST'];
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            // Page on which the user will be redirected after logging in
            header("location:http://$host$uri/$extra");
            exit();
    }
    else
    {
            $extra="index.php";
            $email=$_POST['emailid'];
            $uip=$_SERVER['REMOTE_ADDR'];
            $status=0;
            $log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
            $host = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/$extra");
            $_SESSION['errmsg']="Invalid email id or Password";
            exit();
    }
}
/**
 * Ensuring that the user has not left any input field blank error messages will be displayed for every blank input
 * I get this code from https://www.geeksforgeeks.org/how-to-display-logged-in-user-information-in-php/
 */
/**
 * Validate credentials 
 */
$errors = array();
if (empty($email)) { 
        array_push($errors, "Email is required"); 
    }
    if (empty($password)) { 
        array_push($errors, "Password is required"); 
    }
?>
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="../Controller/jquery/jquery.js"></script>
    <script type="text/javascript" src="../Controller/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../Controller/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="../Controller/css/mdb.min.css">
    </head>
<body>
<section class="vh-100" style="background-color:#acc3de;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="../Controller/images/loginicon.png" alt="login form" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
        <form class="register-form outer-top-xs" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method="post">

                                        <span style="color:red;">
                                            <?php
                                            // Display error messages 
                      echo htmlentities($_SESSION['errmsg']);
                      ?>
                                            <?php
                      echo htmlentities($_SESSION['errmsg']="");
                      ?>
                                        </span>
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0">Math Puzzle Game</span>
                                        </div>
                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing:1px;">Sign into your
                                            account</h5>
                                        <div class="form-outline mb-4">
                                            <input type="email" name="emailid" id="exampleInputEmail1"
                                                class="form-control form-control-lg"
                                                placeholder="Enter Your Email Address" />
                                            <label class="form-label" for="exampleInputEmail1"">Email address</label>
                                        </div>
                                                <div class=" form-outline mb-4">
                                                <input type="password" name="password"
                                                    class="form-control form-control-lg" id="password"
                                                    placeholder="Enter Your Password" required />
                                                <label class="form-label" for="exampleInputPassword1">Password</label>
                                        </div>
                                        <div class="pt-1 mb-4">
                                            <p id="demo">
                                                <button type="submit"   name="login-submit" class="btn btn-dark btn-lg btn-block"
                                                    onclick="myFunction()" id="demo"
                                                    style="color: rgba(21, 21, 24, 0.873);background-color: blue;">Login</button>
                                                
                                            </p>
                                        </div>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Sign up here if you don't have
                                            an account? <a href="register.php" style="color: #393f81;">Register here</a>
                                        </p>
                                        
                                        
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
<!-- Event  Driven programming for submit button click  event -->
<script>
function myFunction() {
    let x = document.getElementById("demo");
    x.style.fontSize = "25px";
    x.style.color = "red";
}
</script>
<script type="text/javascript" src="../Controller/js/mdb.min.js"></script>
<script type="text/javascript" src="../Controller/js/mdb.min.js.map"></script>
</html>