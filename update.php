<?php
session_start();
include ('connect.php');

if(isset($_POST['id_name'])){
    // Get the user
    $username = $_SESSION['username'];
    $getUser = "SELECT * from Users where username = '$username'";
    $q = mysqli_query($conn , $getUser);
    $user = mysqli_fetch_array($q);

    $user_id = $user['id'];

    $id_item = $_POST['id_name'];




    // Cart is json encoded
    $id_item = json_decode($id_item, true);
    $id_item = $id_item['value'];

    $q = "UPDATE Events SET likes = likes +1  WHERE eventId = '$id_item'";
    if(!mysqli_query($conn, $q)){
    echo "Error    ".mysqli_error($conn);
      echo false;
      return;
    }

    // create an order first
    echo true;
    return;

}

echo 'GET method not allowed';

?>
