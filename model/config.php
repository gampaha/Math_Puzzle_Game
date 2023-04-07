<?php
//DBMS connection code -> hostname,username, password, database name
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'math_puzzel');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//create the database connection class 
class databaseConnection{
    function dbconnect(){
            $host="localhost";
            $uname="root";
            $pword="";
            $db="math_puzzel";
            //making connection string with db
            $con=new mysqli($host,$uname,$pword,$db);
            return $con;
            //error handling
            if($con->connect_error){
                    echo $con->connect_errno; //error number
            }
    }

}
//making an object of databaseConnection class
 $conobj=new databaseConnection();
//using above object calling dbconnect method
 $con=$conobj->dbconnect();

?>