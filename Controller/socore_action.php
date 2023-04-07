<?php
//start the session 
session_start();
include('../model/config.php');
/*
* Insert the  Score Value Using Isset  Function 
*/
if (isset($_POST['status']) && $_POST['status'] == 'add_score') {

    //increase the score by 10 points and add the value to score table 

    $sql = "INSERT INTO score (user_id, score) VALUES ('".$_SESSION['id']."', '10')";
    $query=mysqli_query($con,$sql);
    //check the errors
    if($query) 
    {
       echo "1";
    }
    else{
        echo "error".$sql;
    }

}
//call the isset function to get total score 
if (isset($_POST['status']) && $_POST['status'] == 'get_total_score') {
  

        // Get username from request
        $username = $_SESSION['id'];

        // Prepare SQL statement to calculate the summation of total score 
        $sql = "SELECT SUM(score) as total_score FROM score WHERE user_id = '$username'";
        // execute the query and get the result set
        $result = $con->query($sql);

        // check for errors
        if (!$result) {
        die("Error executing query: " . $con->error);
        }

        // get the total score from the result set
        $row = $result->fetch_assoc();
        $total_score = $row['total_score'];

        // return the total score as a JSON response to the client
        $response = array('total_score' => $total_score);
        header('Content-Type: application/json');
        //pass the data from backend to frontend as string using 
        echo json_encode($response);

        // close the database connection
        $con->close();

}
/*
* call the isset function to get  top players details 
*/
if (isset($_POST['status']) && $_POST['status'] == 'get_top_players') {
    
    // Get username from session
    $username = $_SESSION['id'];

    // prepare and execute the query
    $sql = "SELECT  SUM(score) as total_score , user_id FROM score  where user_id != '$username'  group by user_id order by total_score DESC LIMIT 10";
    $result = $con->query($sql);

    // check for errors
    if (!$result) {
        die('Error: ' . $conn->error);
    }

    $data = array();
    while ($row = $result->fetch_assoc()) {
        //data for retrivew
        $data[] = array(
          
            'total_score' => $row['total_score'],
            'user_id' => get_user_name($con , $row['user_id'])
        );
    }

    echo json_encode($data,true);
}


if (isset($_POST['status']) && $_POST['status'] == 'get_all_players') {
    

    // Get username from session
    $username = $_SESSION['id'];

    // prepare and execute the query
    $sql = "SELECT  SUM(score) as total_score , user_id FROM score where user_id != '$username' group by user_id order by total_score DESC ";
    $result = $con->query($sql);

    // check for errors
    if (!$result) {
        die('Error: ' . $conn->error);
    }

    $data = array();
    while ($row = $result->fetch_assoc()) {
        
        $data[] = array(
          
            'total_score' => $row['total_score'],
            'user_id' => get_user_name($con , $row['user_id'])
        );
    }

    //json encode
    echo json_encode($data,true);
}
/*
*  Get username using userid 
*/
function get_user_name($conn , $user_id){

        // Prepare SQL statement
        $sql = "SELECT * FROM users WHERE id = '$user_id'";
        // execute the query and get the result set
        $result = $conn->query($sql);

        // check for errors
        if (!$result) {
        die("Error executing query: " . $conn->error);
        }

        // get the total score from the result set
        $row = $result->fetch_assoc();
        $name = $row['name'];

        return $name;
}
/*
* get user profile details using isset function 
*/
if (isset($_POST['status']) && $_POST['status'] == 'get_user_profile') {
    //creeate the session id and saved the username and ititilize the session with the session id when the server encounters the PHPSESSID cokkie.
    $username = $_SESSION['id'];
    // prepare and execute the query
    $sql = "SELECT * FROM users where id = $username";
    $result = $con->query($sql);

    // check for errors
    if (!$result) {
        die('Error: ' . $conn->error);
    }

    $data = array();
    while ($row = $result->fetch_assoc()) {
        
        $data[] = array(
            
            'id' => $row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'score' => $row['score'],
            'regDate' => $row['regDate']
        );
    }

    echo json_encode($data,true);
}


?>