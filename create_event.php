<?php 
include 'top.php';
//include 'header.php';



?>


<body class="container">
	<h1>Create Event</h1>

	 <div class="container col-6">
        <!-- <div class="single-product-content col-lg-6 col-6 mb-30"?> -->
            <span class="product-price"></span>
            <!-- details -->
            <div class="order-details">

              <form  style="margin:25px;"class="" action="server.php" method="POST" enctype="multipart/form-data">
                <br>
                <br>
                <p><b>Add New Event</p></b>
                <br>
                <div class="form-group">
                  <label for="title">Title: </label><br />
                <input type="text" name="title" class="form-control" placeholder="" value=""><br />
                </div>
                <div class="form-group">
                <label for="description">Description: </label><br>
                <input type="text" name="description" class="form-control" placeholder="" value=""><br />
                 </div>
                 <div class="form-group">
                 <label for="organizer">Organizer: </label><br />
                <input type="text" name="organizer" class="form-control" placeholder="" value="">
                </div>
                <div class="form-group">
                <label for="location">Location: </label><br/>
                <input type="text" name="location" class="form-control" placeholder="" value="">
                <div class="form-group">
                 </div>
<!--                  <div class="form-group">
                 <label for="date">Date: </label><br />
                <input type="date" name="date" class="form-control" placeholder="" value="">
                </div> -->
                <div class="form-group">
                <label for="Time">Time: </label><br />
                <input type="datetime-local" name="time" class="form-control" placeholder="" value="">
                 </div>

                 <div class="form-group">
                <label for="Time">Tickets: </label><br />
                <input type="number" name="tickets" class="form-control" placeholder="" value="">
                 </div>
                 <div class="form-group">
                <label for="Image">Upload Image: </label><br />
                <input type="file" name="image" class="form-control" placeholder="" value="">
                 </div>

                <br>
                <button class="btn btn-success" name="additem" type="submit">Add Item</button>
              </form>

            </div>

        </div>
      <!-- </div> -->

      </div>


    </div>


</body>