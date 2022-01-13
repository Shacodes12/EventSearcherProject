
<?php
session_start();
include 'top.php';
include 'server.php';



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
    $myorder = "INSERT INTO Atendee(ticket_number , eventId,userId) VALUES('$orderID' , '$id', '$user_id')";

    if(!mysqli_query($conn, $myorder)){
      echo "Error    ".mysqli_error($conn);
        echo false;
        return;
    }
    echo "<script>alert('YOu have booked An event with Ticket Number  $id')</script>";
    echo '
        <div class="row align-center">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">TICKET BOOKED WELL</h5>
            <p class="card-text text ">YOu have booked An event with Ticket Number  $id</p>
            <a href="index.php" class="btn btn-primary">back Home</a>
          </div>
        </div>
      </div>
    ';
    return;
}


?>
<body>

<!-- main body.. -->
<div id="main-wrapper" class="section">

  <!-- header start -->
  <?php
  include 'header.php';
   ?>
    <!-- header end -->
    <div class="hero-slider section fix">
        <div class="hero-item" style="background-image: url(img/product/img5.jpg)">
            <div class="hero-content text-center m-auto">

               <h1>Find More Fun</h1>

                <!-- check against session if someone is logined -->
                <?php
                if (!isset($_SESSION['username'])) {
                  echo '<a href="login.php" style="margin-right:40px">SignIn</a>';
                }
                ?>
               <!-- <a class="btn-full" href="#">More Events</a> --->
            </div>
        </div>
    </div>
    <div class="product-section section pt-70 pb-60">
        <div class="container">
            <div class="row">
                <div class="section-title text-center col mb-60">
                    <h1>Events</h1>
                </div>
            </div>
            <!-- <style media="screen">
              #MyUL{
                height: 35px;
              }
            </style> -->
            <div class="row  " id="MyUL">
                <?php
                while ($row = mysqli_fetch_array($res_query))
                {
                  $image =  $row["image"];
                  $id = $row['eventId'];
                  $desc = $row["description"];
                  $org = $row['organizer_name'];
                  $title = $row['title'];
                  $location = $row['location'];
                  $eventAt = $row['eventAt'];
                  $likes = $row['likes'];


                  ?>
                     <div class="col-lg-4 col-md-6 col-12 mb-60 ItemVal  w-100" id="ItemVal">
                     <div class="product">
                     <div class="image">

                    <?php
                    if ($org == "EVENT BRITE") {
                      ?>
                      <a href="details.php?id=<?php echo $id; ?>" class="img"><img style="height:300px;" src=<?php echo $image; ?>  ></a>

                      <?php
                    }
                    else{
                      ?>
                      <a href="details.php?id=<?php echo $id; ?>" class="img"><img style="height:300px;" src=<?php echo './uploads/'.$image; ?>  ></a>
                      <?php
                    }
                     ?>
                     </div>
                     <div class="content">
                     <div class="head fix">
                     <div class="title-category float-left">
                         <h3 class="title" id="title"><a href="details.php?id=<?php echo $id; ?>"><?php echo $title; ?></a></h3>
                     </div>
                     <div class="price float-right">
                     <span class="new"><?php echo $location; ?></span>
                     </div>
                     </div>
                     <style media="screen">
                     .fa {
                        font-size: 30px;
                        cursor: pointer;
                        user-select: none;
                        }

                      .fa:hover {
                        color: darkblue;
                        }
                        #likebtn{
                          background-color: #c1cc1c;
                          border-radius: 4px;
                          margin-left: 13px;
                          padding-top: 13px;
                          text-align: center;
                          margin-bottom: 24px;
                          padding-bottom: -24px;
                          border: none;
                        }
                        #like{
                          color: red;
                          font-size: 20;
                          font-weight: bold;
                        }
                     </style>
                     <div class="action-button fix">
                       <?php
                       if (isset($_SESSION['username'])) {
                          echo "<a class='action-button fix addToCart' href='index.php?ticket='$id''>Book</a>";
                          echo "<button id='likebtn' onclick=Update_like('$id')> <span>likes  $likes</span>  <i class='fa fa-thumbs-up'></i></button>";
                          }
                         // echo "<a href='index.php?ticket=$id' class='addToCart'  onclick='addCartItem('$id')'>Book</a>";
                        else {
                          echo '<a href="login.php" style="margin-right:40px">SignIn</a>';
                        }
                         ?>
                     </div>
                     </div>
                     </div>
                     </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>


    <!-- testimonials -->
    <div class="testimonial-section section bg-gray pt-100 pb-65" >
        <div class="container">
            <div class="row">
                <div class="section-title text-center col mb-60">
                    <h1>Customer Reviews</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-10 col-12 ml-auto mr-auto">
                    <div class="testimonial-slider text-center">
                        <div class="single-testimonial">
                            <img src="img/testimonial/1.jpg" alt="customer">
                            <p>i had the most memorable and enjoyable music concert.</p>
                            <h5>Mary Jane</h5>
                        </div>
                        <div class="single-testimonial">
                            <img src="img/testimonial/1.jpg" alt="customer">
                            <p>Exceptional delivery time and product quality.</p>
                            <h5>John Doe</h5>
                        </div>
                        <div class="single-testimonial">
                            <img src="img/testimonial/1.jpg" alt="customer">
                            <p>Nice user interface and a very responsive shopping page.</p>
                            <h5>Stefan Kelly</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end of testimonies -->

<!-- fooiter -->
<?php
include 'footer.php';
 ?>
    <!-- footer end -->

</div>
<!-- main boody div  end -->
<?php
include 'bottom.php';

?>
</body>

</html>
