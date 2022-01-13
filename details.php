<?php

session_start();
include 'top.php';
include 'header.php';

// query data if that id
if(isset($_GET['id'])){

  // get database
  $id = $_GET['id'];
  $sql_query = "SELECT * FROM Events WHERE eventId='$id' LIMIT 1";

  $res = mysqli_query($conn , $sql_query);

  $data = mysqli_fetch_array($res);
  $image =  $data["image"];
  $id = $data['eventId'];
  $desc = $data["description"];
  $org = $data['organizer_name'];
  $title = $data['title'];
  $time = $data['eventAt'];
  $loc = $data['location'];
  $tic = $data['tickets'];
?>
<!-- details start -->
    <div class="product-section section pt-110 pb-90">
        <div class="container">
          <div></div>
            <div class="row">
                <div class="col-lg-7 col-12 mb-30">

                    <!-- img -->
                    <div class="single-product-image product-image-slider fix">
                      <?php
                      if ($org == "EVENT BRITE") {
                        ?>
                        <div class="single-image">
                          <img style="" src=<?php echo $image; ?>  >
                        </div>

                        <?php
                      }
                      else{
                        ?>
                        <div class="single-image">
                          <img style="" src=<?php echo './uploads/'.$image; ?>  />
                        </div>
                        <?php
                      }
                       ?>

                        <!-- <div class="single-image"><img src=<?php echo 'uploads/'.$image; ?> alt=""></div> -->
                    </div>


                </div>
                <div class="single-product-content col-lg-5 col-12 mb-30">
                  <br>
                  <br>
                  <br>
                    <h1 class="title">events</h1>
                    <span class="product-rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </span>

                    <span class="product-price">Title  :  <?php echo $title; ?></span>
                    <!-- details -->
                    <div class="order-details">
                      <ul>
                        <li><p>Title </p><p><?php echo $title; ?></p></li>
                        <li><p>Location </p><p><?php echo $loc; ?></p></li>
                        <li><p>Time </p><p><?php echo $time; ?></p></li>
                        <li><p>Organizer</p><p><?php echo $org; ?></p></li>
                      </ul>
                    </div>
                    <div class="description">
                        <p class="text text-success">
                          <?php echo $desc; ?>
                        </p>
                    </div>

                    <!-- Qty selection -->
                    <div class="product-quantity-cart fix">
                        <div class="product-quantity">
                            <input type="text" disabled=true value="1" name="qty">
                        </div>




                        <?php
                        if (!isset($_SESSION['username'])) {
                          echo '<a href="login.php" style="margin-right:40px">SignIn</a>';
                        }
                        else{

                           echo "<a class='action-button fix addToCart' href='index.php?ticket=$id'   onclick='addCartItem('$id')'>Book</a>";

                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- Product Section End-->

<?php

}
else{
  echo "No Item Found";
}


?>



<?php
include 'footer.php';
include 'bottom.php';

?>
