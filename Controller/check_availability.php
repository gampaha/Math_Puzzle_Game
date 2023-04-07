<?php 
require_once("../model/config.php");
if(!empty($_POST["emailid"])) {
	$email= $_POST["emailid"];
	    $result =mysqli_query($con,"SELECT  email FROM  users WHERE  email='$email'");
		$count=mysqli_num_rows($result);
//Validate credentials 		
if($count> 0)
{
 echo "<span style='color:red'> Email already exists .</span>";
 echo "<script>$('#submit').prop('disabled',true);</script>";
} else{
 echo "<span style='color:green'> Email available for Registration</span>";
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
?>
