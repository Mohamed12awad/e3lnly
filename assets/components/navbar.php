<?php

  if(isset($_SESSION['user_login']))	//check unauthorize user not access in "welcome.php" page
  {
    $id = $_SESSION['user_login'];
    
      if($_SESSION['user_type'] == "agency")
      {
        $select="SELECT agency_name FROM {$agency_tb} WHERE agency_id=:uid";
      }else{
        $select="SELECT customer_name FROM {$customer_tb} WHERE customer_id=:uid";
      }
    
// $q_v = strip_tags($_REQUEST['query2']);
    $select_stmt = $db->prepare($select);
    $select_stmt->execute(array(":uid"=>$id));
  
    $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
  }
?>
<div class="sticky-top" id="navbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-0" id="navbar-inner">
            <a class="navbar-brand mr-lg-5" href="index.php">
                <img class="logo" src="./assets/imgs/logo.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto w-100">
                <li class="nav-item active">
                  <a class="nav-link" href="search.php">Explore <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./about.php">About us</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Channals
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="./searcht.php">TV Ads</a>
                    <a class="dropdown-item" href="./searchb.php">Billboards Ads</a>
                    <a class="dropdown-item" href="./searchw.php">Web Ads</a>
                  </div>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> -->
                <li class="d-none d-xl-block header-right fix-card ml-lg-auto mb-xl-0 mb-4">
                    <form class="form-box f-right" method="GET">
                        <input type="text" name="q" placeholder="Search products">
                        <a href="./search.php" class="search-icon">
                            <!-- <a href="./../search.php"> -->
                              <i class="fas fa-search special-tag"></i>
                            <!-- </a> -->
                        </a>
                    </form>
                </li>
                <!-- //add the icon to navbar -->
                <?php
                  if(isset($_SESSION['user_login']))
                  {
                  ?>
                  <li class="dropdown nav-item">
                      <a class="d-none nav-link my-auto d-lg-flex dropdown-toggle" href="#"
                       style="align-items: center; justify-content: space-around; width: 140px;"
                       data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

                        <div style="border: 2px solid #007bff; border-radius: 50%; height: 28px; width: 28px; text-align: center;">
                          <i class="fas fa-user" aria-hidden="true"></i>
                        </div>
                        <span class="font-weight-bold text-uppercase">
                          <?php if($_SESSION["user_type"] == "agency")
                            {
                              echo $row["agency_name"];
                            }else{
                              echo $row["customer_name"];
                            }
                            ?>
                        </span>
                      </a>
                      <div class="dropdown-menu overflow-hidden" style="min-width: 9rem;" aria-labelledby="navbarDropdown">
                        <?php
                            if($_SESSION["user_type"] == "agency")
                              {
                                ?>
                                <a class="dropdown-item" href="./welcome.php">Dashboard</a>
                                <?php
                              }else{
                                ?>
                                <a class="dropdown-item" href="./welcome-client.php">Dashboard</a>
                                <?php 
                              }
                          ?>
                        <a class="dropdown-item" href="./assets/crud/logout.php">Logout</a>
                      </div>
                      </li>

                  <?php
                  }else{
                    ?>
                      <div class="d-none my-auto d-lg-block"><button type="button" class="btn header-btn" data-toggle="modal" data-target="#exampleModal">sign in</button></div>
                    <?php
                  }
                ?>
                <!-- //closing navbar -->
                </ul>

                 </div>
          </nav>
        </div>
        
        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign in as</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-auto">
        
        <a href="./login_client.php" class="ml-0 btn btn-primary">Client</a>
        <span class="mx-3">or</span>
        <a href="./login_agency.php"  class="btn btn-secondary">Agency</a>

				<div class="mt-3">
					<!-- You don't have a account register here?  -->
					<a href="register_client.php"><p class="text-info">Sign Up New Account</p></a>
					<a href="register_agency.php"><p class="text-info">Sign Up New Agency Account</p></a>
				</div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>