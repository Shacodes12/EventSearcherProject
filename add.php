<?php
// session_start();
include ('connect.php');

if(isset($_GET['ticket'])){
    // Get the user
    $username = $_SESSION['username'];
    $getUser = "SELECT * from Users where username = '$username'";
    $q = mysqli_query($conn , $getUser);
    $user = mysqli_fetch_array($q);

    $user_id = $user['id'];
    $id = $_GET['ticket'];

    // create an order first
    $orderID = uniqid('tickets');
    // ticket_number	eventId	userId	time_booked
    $myorder = "INSERT INTO Atendee(ticket_number , eventId,user_id) VALUES('$orderID' , '$id', '$user_id')";

    if(!mysqli_query($conn, $myorder)){
      echo "Error    ".mysqli_error($conn);
        echo false;
        return;
    }
    echo true;
    return;
}

echo 'GET method not allowed';

?>
