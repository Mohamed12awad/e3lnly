<?php
  require_once './assets/crud/connection.php';
          
  session_start();

  if(!isset($_SESSION['user_login']) or $_SESSION["user_type"] == "agency") // || $_SESSION["user_type"] == "client"	//check unauthorize user not access in "welcome.php" page
  {
    header("location: ./index.php");
  }
  
  $nRows = $db->query("SELECT count(*) from {$channel_tb}")->fetchColumn();
  $newRows = $nRows + 1;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>welcome</title>
		
<script src="https://kit.fontawesome.com/7d670817b2.js"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="./assets/style/style.css">
	<link rel="stylesheet" href="./assets/style/paper-dashboard.css">
  <link rel="stylesheet" href="./assets/demo/demo.css">
  
</head>

	<body>
	
  <!-- calling navbar -->
  <?php 
      include "./assets/components/navbar.php";
    ?>
	
	<div class="wrapper">
	<div class="container">
			
  <div class="d-block text-center text-capitalize">
				<h2>

				<?php

				if(isset($_SESSION['user_login']))
				{
				?>
					Welcome,
				<?php
          if($_SESSION["user_type"] == "agency")
            {
              echo $row["agency_name"];
            }else{
              echo $row["customer_name"];
            } 
				}
				?>

			</div>




<section class="my-5">
<div class="container">
<h2 class="h4 text-bold">Price Requests</h2>
      <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">channal type</th>
          <th scope="col">channal description</th>
          <th scope="col">Suggested Price</th>
          <th scope="col">Channel Link</th>
        </tr>
      </thead>
      <tbody>



      <?php 
try {


  // Prepare the paged query
  $aid = $_SESSION['user_login'];
  $stmt = $db->prepare('SELECT * from customer_request
  inner join channel 
  on channel.channel_id = customer_request.channel_id
  where customer_id=:aid
  order by channeltype
  ');
  $stmt->execute(array(':aid'=>$aid));
  // Do we have any results?
  if ($stmt->rowCount() > 0) {
      // Define how we want to fetch the results
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $iterator = new IteratorIterator($stmt);
      $counter = 0;
      // Display the results
      foreach ($iterator as $row) {
        if(isset($_SESSION['user_login']))
        {
            
              ?>
                    <tr>
                      <th scope='row'><?php echo ++$counter?></th>
                      <td><?php echo $row['channeltype']?></td>
                      <td><?php echo $row['channeldescription']?></td>
                      <td><?php echo number_format($row['suggested_price'])?></td>
                      <td><a href="product.php?id=<?php echo $row['channel_id'] ?>">See Channel..</a></td>
                    </tr>
              <?php
            
        }
      }
      

  } else {
      echo '<tr><td colspan="5" class="text-center text-capitalize"><strong>No Requests in the meantime.</strong></td></tr>';
  }

} catch (Exception $e) {
  echo '<p>', $e->getMessage(), '</p>';
}
      ?>
      </tbody>
      </table>
    
  
  <h2 class="h4 text-bold">My Orders</h2>

  <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">channal type</th>
          <th scope="col">Description</th>
          <th scope="col">Start Date</th>
          <th scope="col">End Date</th>
          <th scope="col">Total Amount</th>
          <th scope="col">Channel Link</th>
        </tr>
      </thead>
      <tbody>



      <?php 
try {


  // Prepare the paged query
  $aid = $_SESSION['user_login'];
  $stmt = $db->prepare('SELECT * from orderdetails
  inner join channel
  on channel.channel_id = orderdetails.channel_id
  where customer_id=:aid
  order by channeltype
  ');
$stmt->execute(array(':aid'=>$aid));

  // Do we have any results?
  if ($stmt->rowCount() > 0) {
      // Define how we want to fetch the results
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $iterator = new IteratorIterator($stmt);
      $counter = 0;
      // Display the results
      foreach ($iterator as $row) {
        if(isset($_SESSION['user_login']))
        {
            
              ?>
                    <tr>
                      <th scope='row'><?php echo ++$counter?></th>
                      <td><?php echo $row['channeltype']?></td>
                      <td><?php echo $row['channeldescription']?></td>
                      <td><?php echo $row['start_date']?></td>
                      <td><?php echo $row['end_date']?></td>
                      <td><?php echo number_format($row['totalamount'])?>$</td>
                      <td><a href="product.php?id=<?php echo $row['channel_id'] ?>">See Channel..</a></td>
                    </tr>
              <?php
            
        }
      }
      

  } else {
      echo '<tr><td colspan="6" class="text-center text-capitalize"><strong>No Requests in the meantime.</strong></td></tr>';
  }

} catch (Exception $e) {
  echo '<p>', $e->getMessage(), '</p>';
}
      ?>
      </tbody>
      </table>
  </div>

</div>

</section>
  <!-- <h3 class="h2">Price requests</h3> -->
 <!-- Related Projects Row -->
 <section class="section related-channels mt-3">
    <div class="container">

    <h3 class="my-4">Other Channels You May Like</h3>

      <div class="row">

        <div class="col-md-3 col-sm-6 mb-4">
        <div class="card mt-3 border-0" style="width: 100%;">
          <a href="product.php?id=4">
                <img class="img-fluid card-img-top" src="https://i7.uihere.com/icons/874/1005/107/billboard-a2c03a1f93da1e5a8814ff11890017e7.png" alt="">
              </a>
              <div class="card-body">
                    <h5 class="card-title">Billboard</h5>
                    <p class="card-text text-capitalize">Abu-kair street, Alexandria</p>
              </div>
        </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
        <div class="card mt-3 border-0" style="width: 100%;">
          <a href="product.php?id=9">
                <img class="img-fluid" src="https://image.flaticon.com/icons/png/512/1101/1101202.png" alt="">
              </a>
              <div class="card-body">
                    <h5 class="card-title">Television</h5>
                    <p class="card-text text-capitalize">CBC Channel</p>
              </div>
        </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
        <div class="card mt-3 border-0" style="width: 100%;">
          <a href="product.php?id=5">
                <img class="img-fluid" src="https://image.freepik.com/free-vector/www-icon_23-2147934922.jpg" alt="">
              </a>
              <div class="card-body">
                    <h5 class="card-title">Web banner</h5>
                    <p class="card-text text-capitalize">www.pintrest.com</p>
              </div>
        </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
        <div class="card mt-3 border-0" style="width: 100%;">
          <a href="product.php?id=7">
                <img class="img-fluid" src="https://image.freepik.com/free-vector/www-icon_23-2147934922.jpg" alt="">
              </a>
              <div class="card-body">
                    <h5 class="card-title">Web banner</h5>
                    <p class="card-text text-capitalize">www.quora.com</p>
              </div>
        </div>
        </div>

      </div>
      <!-- /.row -->
    </div>
  </section>

  <footer>
    <!-- Footer Start-->
    <div class="footer-area footer-padding bg-light pt-5">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                   <div class="single-footer-caption mb-50">
                     <div class="single-footer-caption mb-30">
                          <!-- logo -->
                         <div class="footer-logo">
<a href="index.php"><img src="./assets/imgs/logo.png" alt=""></a>                         </div>
                         <div class="footer-tittle">
                             <div class="footer-pera">
                                 <p>Always in your help to Move your advertisment to the next level</p>
                            </div>
                         </div>
                     </div>
                   </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Quick Links</h4>
                            <ul>
                                <li><a href="#">About</a></li>
                                <li><a href="#"> Offers & Discounts</a></li>
                                <li><a href="#"> Special Order</a></li>
                                <li><a href="#">  Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Agency</h4>
                            <ul>
                                <li><a href="#">Social media</a></li>
                                <li><a href="#">Plans</a></li>
                                <li><a href="#"> Promotions</a></li>
                                <li><a href="#"> Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Support</h4>
                            <ul>
                             <li><a href="#">Frequently Asked Questions</a></li>
                             <li><a href="#">Terms & Conditions</a></li>
                             <li><a href="#">Privacy Policy</a></li>
                             <li><a href="#">Report a Payment Issue</a></li>
                         </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer bottom -->
            </div>
        </div>

        <div class="footer-copy-right bg-dark text-white text-right py-2">
            <div class="container">
                <p class="my-auto">
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved<i class="ti-heart" aria-hidden="true"></i> by <a href="#" target="_blank">Bug Squashers</a>
            </div>
        </div>
    </footer>


	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="./assets/script/custom.js"></script>

	</body>
</html>