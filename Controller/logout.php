<?php
// intialize the session
session_start();
// import  the database connection 
include("../model/config.php");
$_SESSION['login-submit']=="";
date_default_timezone_set('Asia/Kolkata');
$ldate=date( 'd-m-Y h:i:s A', time () );
mysqli_query($con,"UPDATE userlog  SET logout = '$ldate' WHERE userEmail = '".$_SESSION['login-submit']."' ORDER BY id DESC LIMIT 1");
//unset all the session variables  
session_unset();
$_SESSION['errmsg']="You have successfully logout";
?>
<!--  Redirect to the  login page -->
<script language="javascript">
document.location="../view/index.php";
</script>
