<?php
include 'connect.php';


// query all items from the product table

$query_res =[];
$sql_query = "SELECT * FROM Events order by likes desc";
$res_query = mysqli_query($conn , $sql_query);
  if (!$res_query){
      echo "Unable to create table <br>".mysqli_error($conn);
          echo "<script>alert('Error  .mysqli_error($conn)')</script>";
    }



if (isset($_POST['additem'])){
 $title = mysqli_real_escape_string($conn,$_POST['title']);
  $organizer = mysqli_real_escape_string($conn,$_POST['organizer']);
  $description = mysqli_real_escape_string($conn,$_POST['description']);
  $location= mysqli_real_escape_string($conn,$_POST['location']);
  $time = mysqli_real_escape_string($conn,$_POST['time']);
  $tickets= mysqli_real_escape_string($conn,$_POST['tickets']);
  $image = $_FILES['image']['name'];
  $image_tmp = $_FILES['image']['tmp_name'];
  // val img extensions
  $extensions = array("jpg","jpeg","png","gif");

  // select file extensions
  $imageExtension = strtolower(pathinfo($image,PATHINFO_EXTENSION));

  if(in_array($imageExtension,$extensions)){

    // move image to a Directory
    if(move_uploaded_file($image_tmp,'./uploads/'.$image)){

      $eventId = uniqid('event');
      // insert the details
      $insertDetails = "INSERT into Events(eventId ,title , description ,organizer_name ,eventAt , location  ,image , total_tickets) values('$eventId','$title','$description','$organizer' , '$time','$location','$image' , $tickets)";
      if(mysqli_query($conn , $insertDetails)){
        // echo "product added successfully!";
        $_SESSION['done'] = "Added product well";
        array_push($_SESSION['success'] , "Added product well");
        header("location:create_event.php");
      }
      else{
        $_SESSION['undone'] = "Unable to add product";
       // array_push($_SESSION['errors'] , "unable to add items");
        header("location:create_event.php");
      }

    }
    else{
      $_SESSION['undone'] = "Unable to save the image";
      array_push($_SESSION['errors'] , "Unable to save image in local setber");
    }
  }
  else{
    $_SESSION['undone'] = "Error while uploading file";
    array_push($_SESSION['errors'] , "Error in uploading file");
  }

}
 ?>
