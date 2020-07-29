<?php
  require_once './assets/crud/connection.php';
          
  session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E3lnly</title>
    <script src="https://kit.fontawesome.com/7d670817b2.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/style/style.css">

</head>
<body class="bg-light">

  <!-- calling navbar -->
    <?php 
      include "./assets/components/navbar.php";
      // echo createNavbar();
try {

  $bid= $_GET['id'];

  $query_sql = "SELECT 
   stat.*,{$billboard_tb}.map_location,{$billboard_tb}.city,{$billboard_tb}.district,{$billboard_tb}.street,{$television_tb}.tv_channel_name,{$website_tb}.site_url,{$channel_tb}.channeltype
  FROM 
    (select billboard_id id, status,width wid,height high,price_day,price_week,price_month,reach_per_day,end_of_contract_date from {$billboard_tb}
    union all
    select channel_id id, status,null wid,null high,price_day,price_week,price_month,reach_per_day,end_of_contract_date from {$television_tb}
    union all
    select websitead_id id,status,width wid,height high,price_day,price_week,price_month,reach_per_day,end_of_contract_date from {$website_tb}) as stat
left JOIN
  {$billboard_tb}
    ON stat.id = {$billboard_tb}.billboard_id
 left JOIN 
  {$television_tb}
     ON stat.id = {$television_tb}.channel_id
left JOIN
 {$website_tb}
     ON stat.id = {$website_tb}.websitead_id
left JOIN 
  {$channel_tb}
    on stat.id={$channel_tb}.channel_id
where id=:bid
";
  $select_stmt=$db->prepare($query_sql); //sql select query
  $select_stmt->execute(array(':bid'=>$bid));	//execute query with bind parameter
  $row=$select_stmt->fetch(PDO::FETCH_ASSOC);

  if(!empty($row['map_location'])){
    $channal_type = "Billboard";
    $bg_img = "./assets/imgs/header-billboard.jpg";
  }else if(!empty($row['tv_channel_name'])){
    $channal_type = "TV AD";
    $bg_img = "./assets/imgs/header-tv-ads.jpg";
  }else{
    $channal_type = "Website";
    $bg_img = "./assets/imgs/header-webmarketing.jpg";
  }

  
  // var_dump($row);
            
} catch (Exception $e) {
  echo '<p>', $e->getMessage(), '</p>';
}

if(isset($_REQUEST['btn_reserv']))	//button name is "btn_login" 
  {
    $sugg_price	= strip_tags($_REQUEST['txt_sugg_price']);	//textbox name "txt_password"
		
    //check no "$errorMsg" show then continue
    if(empty($sugg_price)){
      $errorMsg[]="No Valid Suggestions";	//check price textbox not empty   
    }
    else if(!isset($_SESSION['user_login']) or $_SESSION["user_type"] == "agency") //check unauthorize user not access
    {
      $errorMsg[]="you have to login to suggest new price";
    }
    else if(!isset($errorMsg))
    {
      
      $oRows = $db->query("SELECT count(*) from {$customer_request_tb}")->fetchColumn();
      $newORows = $oRows + 1;
        // global $newRows;

        $aid = $_SESSION['user_login'];
        // $channeldescription = "Billboard" . $newRows;
      
          $insert_stmt_channel=$db->prepare("INSERT INTO {$customer_request_tb} (request_id,customer_id,order_id,channel_id,suggested_price) VALUES 
                                            (:request_id,:customer_id,:order_id,:channel_id,:sugg_price)");
          $insert_stmt_channel->execute(array(
            ':request_id'       =>$newORows,
            ':customer_id'      =>$aid, 
            ':order_id'         =>1,
            ':channel_id'       =>$bid,
            ':sugg_price'       =>$sugg_price));{
													
            $loginMsg = "Successfully Sent Request..."; //execute query success message
				}
  }
    
  }
      ?>
   
	<!--================ Start portfolio Banner Area =================-->
	<section class="banner_area py-5 bg-white">
		<div class="banner_inner d-flex align-items-center">
			<div class="container">
				<div class="banner_content text-right">
					<h1>Channel Details</h1>
					<div class="page_link">
						<a href="index.php">Home</a>
						<a href="./search.php">Gallary</a>
						<a href="#">Details</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Portfolio Banner Area =================-->

<!-- Page Content -->

<!--================ Start Portfolio Details Area =================-->
<section class="portfolio_details_area section_gap my-5">
		<div class="container">
			<div class="portfolio_details_inner">
				<div class="row">
					<div class="col-md-6">
						<div class="left_img">
							<img class="img-fluid" src="<?php echo $bg_img?>" alt="">
            </div>
              <!--Google map-->
              <?php if($channal_type == "Billboard"){ ?>
              <div id="map-container-google-1" class="my-3 z-depth-1-half map-container" style="height: 200px">
                <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d3412.903670820588!2d29.898291715142594!3d31.195684181478235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x14f5c3ec758fd455%3A0xb02283ecb295c718!2sFouad%2C%20Al%20Attarin%20Sharq%2C%20Al%20Attarin%2C%20Alexandria%20Governorate%2C%20Egypt!3m2!1d31.1956842!2d29.9004804!5e0!3m2!1sen!2sus!4v1592257239192!5m2!1sen!2sus"
                  width="100%" hight="200" frameborder="0" style="border:0;"></iframe>
              </div>
              <?php } ?>
					</div>
					<div class="offset-md-1 col-md-5">
						<div class="portfolio_right_text mt-30">
							<h3 class="text-uppercase"><?php echo $channal_type ?> <small class="h6">(<?php echo $row['price_day']?> LE)</small></h3>
              
              <?php

              if(isset($errorMsg))
              {
                foreach($errorMsg as $error)
                {
                ?>
                  <div class="alert alert-danger my-3">
                    <strong>WRONG ! <?php echo $error; ?></strong>
                  </div>
                      <?php
                }
              }
              if(isset($loginMsg))
              {
              ?>
                <div class="alert alert-success my-3">
                  <strong><?php echo $loginMsg; ?></strong>
                </div>
                  <?php
              }
              ?>  
              
              <p><?php echo $row['tv_channel_name'].$row['city'].$row['site_url'] ?> Channal Available from <?php echo $row['end_of_contract_date'] ?>, At a price of <?php echo $row['price_day']?> per day,  with a reach of <?php echo $row['reach_per_day']?>
								with the finest quality in it's field. for farther information please contact us, we will deliver your message.</p>
							<ul class="list text-capitalize">
								<!-- <li><span>Rating</span>: <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
									 class="fa fa-star"></i></li> -->
								<!-- <li><span>Client</span>: colorlib</li>
								<li><span>Website</span>: colorlib.com</li>
                <li><span>Completed</span>: 17 Aug 2018</li> -->
                <?php if(!empty($row['tv_channel_name'])){ ?><li class="card-text"><span>Name</span>: <?php echo $row['tv_channel_name'] ?></li> <?php } ?>
                <?php if(!empty($row['map_location'])){ ?><li class="card-text"><span>Location</span>: <?php echo $row['map_location'] ?></li> <?php } ?>
                <?php if(!empty($row['site_url'])){ ?><li class="card-text"><span>URL</span>: <?php echo $row['site_url'] ?></li> <?php } ?>
                <li><span>Status</span>: <?php echo $row['status']?></li>
                <li><span>Price / Day</span>: <?php echo number_format($row['price_day'])?>LE</li>
                <li><span>Price / Week</span>: <?php echo number_format($row['price_week'])?>LE</li>
                <li><span>Price / Month</span>: <?php echo number_format($row['price_month'])?>LE</li>
                <li><span>Reach / Day</span>: <?php echo $row['reach_per_day']?></li>
                <?php if(!empty($row['map'])){ ?><li><span>location</span>: <?php echo $row['map_location']?></li><?php } ?>
                <!-- <li><strong>Avalable from : </strong><?php //echo $row['end_of_contract_date']?></li> -->
                <li class="card-text"><span>Available from</span>: <?php echo $row['end_of_contract_date'] ?></li>
                <?php if(!empty($row['high'])){ ?><li class="card-text"><span>height</span>: <?php echo $row['high'] ?></li> <?php } ?>
                <?php if(!empty($row['wid'])){ ?><li class="card-text"><span>width</span>: <?php echo $row['wid'] ?></li> <?php } ?>
                <?php if(!empty($row['city'])){ ?> <li href="#" class="card-link"><span>city</span>: <?php echo $row['city'] .' -> '.$row['district'] ?></li> <?php } ?>
              </ul>
              <div class="reserve-btn text-right mt-3">
                <a href="order.php?id=<?php echo $bid ?>" name="btn_reserv" class="btn btn-primary">Order Directily</a>
              </div>


              <form method="post" class="form my-3 px-1">
                <label class="px-0 control-label" for="validationDefault022"><b>Name your price</b></label>
                <div class="row">
                <input type="number" name="txt_sugg_price" class="col-10 form-control" placeholder="Name your price" id="validationDefault022" required/>
                <p class="col-2 my-auto"><strong>BID: 80$</strong></p>
              </div>

              <div class="reserve-btn text-right mt-0 mt-md-3 ">
                <button  name="btn_reserv" class="btn btn-primary">Reserve</button>
              </div>
              
              </form>




							<ul class="list social_details">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<!-- <li><a href="#"><i class="fa fa-linkedin"></i></a></li> -->
							</ul>
            </div>

          </div>
				</div>
        <hr>
				<!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
					magna
					aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat.
					Duis aute irure dolor in reprehenderit.</p>
				<p>Voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
					sunt
					in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit
					voluptatem
					accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
					architecto
					beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed
					quia
					consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum
					quia
					dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore
					magnam
					aliquam quaerat voluptatem.</p> -->
			</div>
		</div>
	</section>
	<!--================ Start Portfolio Details Area =================-->
  <!-- Related Projects Row -->
  <section class="section related-channels">
    <div class="container">

    <h3 class="my-4">Related Channels</h3>

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
    <div class="footer-area footer-padding bg-white pt-5">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                   <div class="single-footer-caption mb-50">
                     <div class="single-footer-caption mb-30">
                          <!-- logo -->
                         <div class="footer-logo">
                            <a href="index.php"><img src="./assets/imgs/logo.png" alt=""></a>                         
                           </div>
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

  <footer class="mt-0">
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