<?php

// session_start();
include ('connect.php');
?>

<!-- button -->
<style media="screen">
  .addToCart {
    background-color: #555555;
    width: 150px;
    border-radius: 12px;
    height: 44px;
    color: #c1c1c1;
    font-size: 30;
    text-align: center;
    font-weight: bold;
  }
  .addToCart a{
    margin-top: 4px;
    font-style: normal;
    font-weight: bold;
  }
  .topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}
.ItemVal{
  padding-bottom: 10px;
  /* height: 600px; */
}

/* .content{
  height: 120px;
} */
.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

#myInput {
  background-image: url('./search.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 10px 19px 10px 40px;
  border: 1px solid #ddd;
  margin-top: 12px;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;
  }
}
</style>
<div class="header-section section">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="header-top-wrapper">
                        <div class="row">
                            <div class="header-logo col-md-4 col-12">

                                <h1>Events</h1>
                            </div>
                            <div class="account-menu col-md-8 col-12">
                                <ul>
                                  <?php
                                  if (isset($_SESSION['username']) )  {
                                    ?>
                                    <li><a href="logout.php" class="text-danger" style="color:red; font-size:27px;">Logout</a></li>
                                    <li class="text-danger strong">
                                      <a href="account.php" style="color:red; font-size:27px;">My Account
                                        <?php
                                        $username = $_SESSION['username'];
                                        // echo $username;

                                    }
                                      ?>
                                    </a>


                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom section">
        <div class="container">
            <div class="row">
                <div class="header-bottom-wrapper text-center col">
                    <div class="header-bottom-logo">

                    </div>
                    <nav id="main-menu" class="main-menu">
                        <ul>
                            <li class="active"><a href="index.php">Home</a></li>

                            <!-- check against session if someone is logined -->
                            <?php
                            if (!isset($_SESSION['username'])) {
                              echo '<li><a href="login.php">Log In</a></li>';
                              echo '<li><a href="signup.php">Sign Up</a></li>';
                            }
                            ?>

                            <?php
                            if (isset($_SESSION['admin'])) {
                              echo '<li><a href="create_event.php">Create Event</a></li>';
                              // code...
                            }
                             ?>

                            <li><a href="contact.php">Contact</a></li>

                            <li>
                              <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
                            </li>

                            <?php
                            if(isset($_SESSION['admin'])){
                              echo '<li><a href="dashboard.php">Admin</a></li>';

                            }
                            ?>


                            <!-- <li><a href="" data-toggle="dropdown">  <i class="fa fa-shopping-cart"  id="MyCart"></i> <sup><span id="cartNum" class="num"></span></sup></a> -->
                              <!-- use javascript and some storage methods to store some values for cart -->

                                <div class="mini-cart-brief dropdown-menu text-left">

                                    <div class="all-cart-product clearfix" id="AllCarts" style="">
                                      <!-- <script type="text/javascript">
                                        const presentItems = JSON.parse(localStorage.getItem('carts'));

                                      </script> -->
                                    </div>
                                    <!-- end the div fot display cart -->
                                    <div class="cart-totals">
                                        <h5>Total £<span id="totalPrice"></span></h5>
                                    </div>
                                    <!-- end -->
                                    <div class="cart-bottom  clearfix">
                                      <?php
                                      if (!isset($_SESSION['username'])) {

                                        echo '<a href="login.php">Please Login To continue</a>';
                                      }
                                      else{
                                        echo '<a href="#" onclick="checkout()">Check out</a>';
                                      }
                                      ?>
                                    </div>
                                </div>

                                <!-- end the cart javascript -->
                            </li>

                        </ul>
                    </nav>

                    <div class="mobile-menu section d-md-none"></div>


                    <div>
                      <?php
              				if (isset($_SESSION['undone'])) {
              					$error = $_SESSION['undone'];
              					echo "
              					<div class='alert alert-danger' role='alert'>
              					<p>$error </p>
              					</div>
              					";
                        unset ($_SESSION["undone"]);
              				}




              			if (isset($_SESSION['done'])) {
              				$success = $_SESSION['done'];
              				echo "
              				<div class='alert alert-success' role='alert'>
              				<p>$success </p>
              				</div>
              				";
                      unset ($_SESSION["done"]);
              			}


              		?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

 ?>
