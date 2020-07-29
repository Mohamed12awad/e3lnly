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
						<a href="./">Details</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Portfolio Banner Area =================-->

<!-- Page Content -->


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
    <script src="./script/custom.js"></script>

</body>
</html>
</body>
</html>