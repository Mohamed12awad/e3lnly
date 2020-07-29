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
    ?>
<!-- search -->
    <div class="container">
      <div style="height:200px; position:relative">
        <div class="searchbar">
            <!-- <h1 class="text-uppercase font-weight-bold text-center text-white mb-4">Move your advertisment to<br>the next level</h1> -->
            <form class="search-oo d-flex">
                <select name="taskOption" id="select1" class="px-3">
                    <option value="tvad">Television</option>
                    <option value="billboards">Billboards</option>
                    <option value="webads">Web</option>
                </select>
                <input class="px-3" type="text" id="myInput" name="Search" placeholder="Search products" >
                <button name="btn_search" id="form-btn" href="./search.php" style="width:110px;" class="ml-3 btn btn-primary form-btn">Search</button>
            </form>
        </div>
      </div>
  </div>


  
  <div class="container-fluid">
    <div class="row">

      <div class="col-12 col-lg-2">
  <!-- filter sec -->
  <aside class="fil-aside text-uppercase mb-5">
      <h3 class="font-weight-bold">filter</h3>
      <form>
        <div class="row">

        <div class="col-6 col-lg-12 my-2 form group">
          <small class="font-weight-bold">price range</small>
            <div class="d-flex justify-content-between">
                <input type="text" class="form-control" placeholder="Min">
                <span class="my-auto mx-3">:</span>
                <input type="text" class="form-control" placeholder="Max">
            </div>
          </div>
          
          <div class="col-6 col-lg-12 my-2 form group">
          <small class="font-weight-bold">Reach range</small>
              <div class="d-flex justify-content-between">
                    <input type="text" class="form-control" placeholder="Min">
                    <span class="my-auto mx-3">:</span>
                    <input type="text" class="form-control" placeholder="Max">
              </div>
            </div>


          <div class="form group col-12 my-3">
          <!-- <label>duration</label> -->
            <div class="duration d-flex d-md-block justify-content-between">
              <div class="w1">
                <small class="font-weight-bold">from</small>
                <input type="date" class="form-control">
              </div>

              <div class="w2">
                <small class="font-weight-bold">to</small>
                <input type="date" class="form-control">
              </div>
            </div>
          </div>

          <div class="form group col-6 col-lg-12 mt-3">
            <small class="font-weight-bold">Channel :</small>
            <select name="taskOption" id="select2" class="p-2 ml-2">
                <option value="tvad">Television</option>
                <option value="billboards">Billboards</option>
                <option value="webads">Web</option>
            </select>
          </div> 

          <div class="form group col-6 col-lg-12 d-flex mt-3">
            <small class="font-weight-bold my-auto">Location :</small>
            <input type="text" class="w-50 form-control ml-2" placeholder="Location">
          </div>
  </form>
      
  </aside>
  </div>
<!-- products -->
<div class="col-lg-10 bg-white">
<!-- <h3 class="font-weight-bold">Billboards</h3> -->
  <div class="mt-4">
    <?php 
      // agency detailes select query
      // $selectOption = $_POST['taskOption'];
      /* SELECT * FROM Customers
        WHERE CustomerName LIKE '%al' OR CustomerName LIKE 'al%' OR CustomerName LIKE '%al%';

         */
         // Find out how many items are in the table
  $total = $db->query("SELECT count(*) from websitead")->fetchColumn();

// How many items to list per page
$limit = 12;

// How many pages will there be
$pages = ceil($total / $limit);

// What page are we currently on?
$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
  'options' => array(
      'default'   => 1,
      'min_range' => 1,
  ),
)));

// Calculate the offset for the query
$offset = ($page - 1)  * $limit;

// Some information to display to the user
$start = $offset + 1;
$end = min(($offset + $limit), $total);

// The "back" link
$prevlink = ($page > 1) ? '<a href="?page=1" title="First page" aria-label="Previous" class="page-link0">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="page-item disabled">&laquo;</span> <span class="page-item disabled">&lsaquo;</span>';

// The "forward" link
$nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';


      $select= "SELECT 
      stat.*,{$billboard_tb}.map_location,{$billboard_tb}.city,{$billboard_tb}.district,{$billboard_tb}.street,{$television_tb}.tv_channel_name,{$website_tb}.site_url,{$channel_tb}.channeltype
     FROM 
       (select billboard_id id, status,width wid,height high,price_day,price_week,price_month,reach_per_day,end_of_contract_date from {$billboard_tb}
       union all
       select channel_id id, status,null wid,null high,price_day,price_week,price_month,reach_per_day,end_of_contract_date from {$television_tb}
       union all
       select websitead_id id, status,width wid,height high,price_day,price_week,price_month,reach_per_day,end_of_contract_date from {$website_tb}) as stat
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
    where channeltype = 'W'
   order by channeltype
   LIMIT
          :limit
    OFFSET
          :offset
   ";
      $select_stmt_web = $db->prepare($select);
      $select_stmt_web->execute(array(':limit'=>$limit,':offset'=>$offset)); //execute query 
      if($select_stmt_web->rowCount() > 0)	//check condition database record greater zero after continue
			{
        ?>
      <div class="row">
      <h2 class="col-12 my-3">Website ADs</h2>
      <?php

      while($row=$select_stmt_web->fetch(PDO::FETCH_ASSOC))
      {

          $Channel_type = "Website";
          $bg_img = "https://cdn1.iconfinder.com/data/icons/seo-search-engine-optimize-1/512/Advertising-ads-online-web-website-banner-512.png";
        
        if(!empty($row['site_url'])){
        ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card bg-light mx-auto" style="max-width:250px">
              <img src=<?php echo $bg_img ?> class="img-fluid card-img-top" alt="...">
              
              <div class="card-body text-capitalize">
                <h5 class="card-title font-weight-bold"><?php echo $Channel_type?></h5>
                <h6 class="card-subtitle mb-2 text-muted">status: <?php echo $row['status']?> </h6>
                  <?php if(!empty($row['site_url'])){ ?><p class="card-text">url: <?php echo $row['site_url'] ?></p> <?php } ?>
                <p class="card-text">end of contract: <?php echo $row['end_of_contract_date'] ?></p>
                
                <div class="d-flex justify-content-between align-items-center">
                <div>
                  <p class="my-0"><b>( <?php echo $row['price_day'] ?>LE )</b></p>
                </div>
                <div>
                  <a href="product.php?id=<?php echo $row['id']; ?>" class="py-3 btn btn-primary">Details</a>
                </div>
                </div>

     
              </div>
            </div>
            </div>
            <?php
        }
      }

      ?>
  </div>
  <?php
      }
      ?>


        <!-- pagination -->
<nav aria-label="Page navigation">

  <ul class="pagination justify-content-center mt-4">
  <?php   
        // Display the paging information
        echo '<div id="paging"><p><b class="h3">', $prevlink, '</b> Page ', $page, ' of ', $pages, ' pages <b class="h3">', $nextlink, '</b></p></div>';
      ?>

</nav>
</div>
  </div>
</div>
  </div>

<footer class="mt-0">
    <!-- Footer Start-->
    <div class="footer-area footer-padding bg-light pt-5">
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