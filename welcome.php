<?php
  require_once './assets/crud/connection.php';
          
  session_start();

  if(!isset($_SESSION['user_login']) or $_SESSION["user_type"] == "client") // || $_SESSION["user_type"] == "client"	//check unauthorize user not access in "welcome.php" page
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



<div class="content">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-globe text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Capacity</p>
                      <p class="card-title">150GB<p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i>
                  Update Now
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Revenue</p>
                      <p class="card-title">$ 1,345<p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i>
                  Last day
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-vector text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Errors</p>
                      <p class="card-title">23<p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i>
                  In the last hour
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-favourite-28 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Followers</p>
                      <p class="card-title">+45K<p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i>
                  Update now
                </div>
              </div>
            </div>
          </div>
        </div>
</div>


<section class="my-5">
<div class="container">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#channels" role="tab" aria-controls="home" aria-selected="true">Channels</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#requests" role="tab" aria-controls="profile" aria-selected="false">Price Request</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="contact" aria-selected="false">Orders</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="channels" role="tabpanel" aria-labelledby="home-tab">
   <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">channal type</th>
          <th scope="col">channal description</th>
          <th scope="col">Channel Link</th>
        </tr>
      </thead>
      <tbody>


      <?php 
try {


  // Prepare the paged query
  $aid = $_SESSION['user_login'];
  $stmt = $db->prepare('SELECT * from channel where agency_id=:aid order by channeltype');
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
                      <td><a href="product.php?id=<?php echo $row['channel_id'] ?>">See Channel..</a></td>
                    </tr>
              <?php
            
        }
      }
      

  } else {
      echo '<tr><td colspan="5" class="text-center text-capitalize"><strong>No Channels in the meantime.</strong></td></tr>';
  }

} catch (Exception $e) {
  echo '<p>', $e->getMessage(), '</p>';
}
      ?>
      </tbody>
      </table>
    </div>
  
  <!-- price requests -->
  <div class="tab-pane fade" id="requests" role="tabpanel" aria-labelledby="profile-tab">
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
  where agency_id=:aid
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
    
    </div>
  <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="contact-tab">
  <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">channal type</th>
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
  where agency_id=:aid
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

  <!-- <h3 class="h2">Price requests</h3> -->

  </div>
      

  </section>

  

        <div class="new-ads my-5">
<h3 class="h3 font-weight-bold">ADD NEW CHANNEL</h3>
<div class="d-flex justify-content-between mt-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
    Add new Billboard
    </button>
    
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelIdTV">
    Add new TV Channel
    </button>

    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelIdWEB">
    Add new Web AD
    </button>
</div>
</div>

        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Users Behavior</h5>
                <p class="card-category">24 Hours performance</p>
              </div>
              <div class="card-body ">
                <canvas id=chartHours width="400" height="100"></canvas>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-history"></i> Updated 3 minutes ago
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Email Statistics</h5>
                <p class="card-category">Last Campaign Performance</p>
              </div>
              <div class="card-body ">
                <canvas id="chartEmail"></canvas>
              </div>
              <div class="card-footer ">
                <div class="legend">
                  <i class="fa fa-circle text-primary"></i> Opened
                  <i class="fa fa-circle text-warning"></i> Read
                  <i class="fa fa-circle text-danger"></i> Deleted
                  <i class="fa fa-circle text-gray"></i> Unopened
                </div>
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar"></i> Number of emails sent
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-title">Channels</h5>
                <p class="card-category">Line Chart with Points</p>
              </div>
              <div class="card-body">
                <canvas id="speedChart" width="400" height="100"></canvas>
              </div>
              <div class="card-footer">
                <div class="chart-legend">
                  <i class="fa fa-circle text-info"></i> Billboards
                  <i class="fa fa-circle text-warning"></i> TV Channels
                </div>
                <hr />
                <div class="card-stats">
                  <i class="fa fa-check"></i> Data information certified
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
  </div>
  












<?php
  if(isset($_REQUEST['btn_register'])) //button name "btn_register"
{
	$map	= strip_tags($_REQUEST['txt_location']);	//textbox name "txt_email"
	$city		= strip_tags($_REQUEST['txt_city']);		//textbox name "txt_email"
	$district	= strip_tags($_REQUEST['txt_district']);	//textbox name "txt_password"
	$street	= strip_tags($_REQUEST['txt_street']);	//textbox name "txt_password"
	$price_day		= strip_tags($_REQUEST['txt_price_day']);	//textbox name "txt_password"
	$price_week	= strip_tags($_REQUEST['txt_price_week']);	//textbox name "txt_password"
	$price_month	= strip_tags($_REQUEST['txt_price_month']);	//textbox name "txt_password"
	$reach_per_day		= strip_tags($_REQUEST['txt_reach_day']);	//textbox name "txt_password"
	$end_of_contract_date		= strip_tags($_REQUEST['txt_end_of_contract']);	//textbox name "txt_password"
  // $effect		= strip_tags($_REQUEST['txt_remail']);	//textbox name "txt_password"
	$status		= strip_tags($_REQUEST['txt_statue']);	//textbox name "txt_password"
	$width		= strip_tags($_REQUEST['txt_width']);	//textbox name "txt_password"
  $height		= strip_tags($_REQUEST['txt_hight']);	//textbox name "txt_password"

  $select_stmt=$db->prepare("SELECT map_location FROM {$billboard_tb} WHERE map_location=:map"); // sql select query
$select_stmt->execute(array(':map'=>$map)); //execute query 
$row=$select_stmt->fetch(PDO::FETCH_ASSOC);	

if($row["map_location"]==$map){
$errorMsg[]="Sorry location already exists";	//check condition username already exists 
}

else if(!isset($errorMsg)) //check no "$errorMsg" show then continue
{
  global $newRows;

  $aid = $_SESSION['user_login'];
  $channeldescription = "Billboard" . $newRows;

    $insert_stmt_channel=$db->prepare("INSERT INTO {$channel_tb} (channel_id,agency_id,channeltype,channeldescription) VALUES 
                                      (:channel_id,:agency_id,:channeltype,:channeldescription)");
    $insert_stmt_channel->execute(array(
      ':channel_id'              =>$newRows,
      ':agency_id'               =>$aid, 
      ':channeltype'             =>'B',
      ':channeldescription'      =>$channeldescription));

				$insert_stmt=$db->prepare("INSERT INTO {$billboard_tb} (billboard_id,status,width,height,map_location,city,district,street,price_day,price_week,price_month,reach_per_day,end_of_contract_date,effect) VALUES
																(:userid,:stat,:width,:height,:map_location,:city,:district,:street,:price_day,:price_week,:price_month,:reach_per_day,:end_of_contract_date,:effect)"); 		//sql insert query					
				

				if($insert_stmt->execute(array(
                        ':userid'               =>$newRows,
												':stat'	                =>$status, 
												':width'	              =>$width,
												':height'	              =>$height,
												':map_location'         =>$map, 
												':city'		              =>$city, 
                        ':district'	            =>$district,
                        ':street'	              =>$street,
                        ':price_day'            =>$price_day,
												':price_week'	          =>$price_week,
												':price_month'	        =>$price_month,
												':reach_per_day'	      =>$reach_per_day,
												':end_of_contract_date'	=>$end_of_contract_date,
												':effect'	              =>"Lighted"))){
													
					$registerMsg="Channel Added Successfully.."; //execute query success message
				}
  }
}
?>
    <!-- billboard Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add new Billboard</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
          <?php
		if(isset($errorMsg))
		{
			foreach($errorMsg as $error)
			{
			?>
				<div class="alert alert-danger">
					<strong>WRONG ! <?php echo $error; ?></strong>
				</div>
            <?php
			}
		}
		if(isset($registerMsg))
		{
		?>
			<div class="alert alert-success">
				<strong><?php echo $registerMsg; ?></strong>
			</div>
        <?php
		}
		?>   
			<div class="text-center"><h2>Register Page</h2></div>
			<form method="post" class="form">
					
					<div class="form-group col-12">
						<label class="col-6 control-label" for="validationDefault01">Map location</label>
						<div class="col-12">
							<input type="text" name="txt_location" class="form-control" placeholder="Map location" id="validationDefault01" required/>
						</div>
					</div>
					
					<div class="form-group col-12">
						<label class="col-6 control-label" for="validationDefault02">City</label>
						<div class="col-12">
							<input type="text" name="txt_city" class="form-control" placeholder="City" id="validationDefault02" required/>
						</div>
          </div>

          <div class="form-group col-12">
						<label class="col-6 control-label" for="validationDefault03">District</label>
						<div class="col-12">
							<input type="text" name="txt_district" class="form-control" placeholder="District" id="validationDefault03" required/>
						</div>
					</div>
				
					<div class="form-group col-12">
            <label class="col-6 control-label" for="validationDefault04">Street</label>
            <div class="col-12">
            <input type="text" name="txt_street" class="form-control" placeholder="street" id="validationDefault04" required/>
            </div>
					</div>
										
					<div class="form-group col-12">
            <label class="col-6 control-label" for="validationDefault05">Price Per Day</label>
            <div class="col-12">
            <input type="number" name="txt_price_day" class="form-control" placeholder="Price Per Day" id="validationDefault05" required/>
            </div>
          </div>

          <div class="form-group col-12">
            <label class="col-6 control-label" for="validationDefault06">Price Per Week</label>
            <div class="col-12">
            <input type="number" name="txt_price_week" class="form-control" placeholder="Price Per Week" id="validationDefault06" required/>
            </div>
          </div>

          <div class="form-group col-12">
            <label class="col-6 control-label" for="validationDefault07">Price Per Month</label>
            <div class="col-12">
            <input type="number" name="txt_price_month" class="form-control" placeholder="Price Per Month" id="validationDefault07" required/>
            </div>
					</div>
									
				<div class="form-group col-12">
          <label class="col-6 control-label" for="validationDefault08">Reach Per day</label>
          <div class="col-12">
          <input type="text" name="txt_reach_day" class="form-control" placeholder="Reach per day" id="validationDefault08" required/>
          </div>
				</div>
					
				<div class="form-group col-12">
				<label class="col-6 control-label" for="validationDefault09">End of Contract</label>
				<div class="col-12">
				<input type="date" name="txt_end_of_contract" class="form-control" placeholder="Date of ending" id="validationDefault09" required/>
				</div>
				</div>
        
        
				<div class="form-group col-12">
          <label class="col-6 control-label">Statu</label>
          <div class="col-12">
          <!-- <input type="text" name="txt_pos" class="" placeholder="enter your position" id="validationDefault07" required/> -->
          <select name="txt_statue" id="select1" class="form-control px-3" required>
              <option value="Idle">Idle</option>
              <option value="Rented">Rented</option>
          </select>
          </div>
				</div>


				<div class="form-group col-12">
        <label class="col-6 control-label">Dimensions</label>
        <div class="row mx-1">
          <div class="col-6">
          <input type="number" name="txt_width" class="form-control" placeholder="Width" required/>
          </div>

          <div class="col-6">
          <input type="number" name="txt_hight" class="form-control" placeholder="Hight" required/>
          </div>
        </div>
				</div>

				<div class="form-group col-12">
				<div class="mt-5 text-right">
				<input type="submit" name="btn_register" class="btn btn-primary" value="ADD Bill">
				</div>
        </div>
        
			</form>
          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save</button>
          </div> -->
        </div>
      </div>
    </div>

    <?php
  if(isset($_REQUEST['btn_register_tv'])) //button name "btn_register"
{
	$status		= strip_tags($_REQUEST['txt_statue_tv']);	//textbox name "txt_password"
	$channel_name	= strip_tags($_REQUEST['txt_channel_name_tv']);	//textbox name "txt_email"
	$price_day		= strip_tags($_REQUEST['txt_price_day_tv']);	//textbox name "txt_password"
	$price_week	= strip_tags($_REQUEST['txt_price_week_tv']);	//textbox name "txt_password"
	$price_month	= strip_tags($_REQUEST['txt_price_month_tv']);	//textbox name "txt_password"
	$reach_per_day		= strip_tags($_REQUEST['txt_reach_day_tv']);	//textbox name "txt_password"
	$end_of_contract_date		= strip_tags($_REQUEST['txt_end_of_contract_tv']);	//textbox name "txt_password"
 
$select_stmt=$db->prepare("SELECT tv_channel_name FROM {$television_tb} WHERE tv_channel_name=:tv_name"); // sql select query
$select_stmt->execute(array(':tv_name'=>$channel_name)); //execute query 
$row=$select_stmt->fetch(PDO::FETCH_ASSOC);	

  if($row["tv_channel_name"]==$channel_name){
    $errorMsg2[]="Sorry Channel already exists";	//check condition username already exists 
    }
    
    else if(!isset($errorMsg2)) //check no "$errorMsg" show then continue
    {
      global $newRows;

      $aid = $_SESSION['user_login'];
      $channeldescription = "Tvad" . $newRows;

        $insert_stmt_channel=$db->prepare("INSERT INTO {$channel_tb} (channel_id,agency_id,channeltype,channeldescription) VALUES 
                                          (:channel_id,:agency_id,:channeltype,:channeldescription)");
        $insert_stmt_channel->execute(array(
          ':channel_id'              =>$newRows,
          ':agency_id'               =>$aid, 
          ':channeltype'             =>'T',
          ':channeldescription'      =>$channeldescription));

				$insert_stmt_tv=$db->prepare("INSERT INTO {$television_tb} (channel_id,status,tv_channel_name,price_day,price_week,price_month,reach_per_day,end_of_contract_date) VALUES
																(:userid,:stat,:channel_name,:price_day,:price_week,:price_month,:reach_per_day,:end_of_contract_date)"); 		//sql insert query					
        
        
				if($insert_stmt_tv->execute(array(
                        ':userid'               =>$newRows,
												':stat'	                =>$status, 
												':channel_name'         =>$channel_name,
                        ':price_day'            =>$price_day,
												':price_week'	          =>$price_week,
												':price_month'	        =>$price_month,
												':reach_per_day'	      =>$reach_per_day,
												':end_of_contract_date'	=>$end_of_contract_date))){
													
					$registerMsg2="Channel Added Successfully.."; //execute query success message
        }
      }
  }
?>
    <!-- TV channel Modal -->
    <div class="modal fade" id="modelIdTV" tabindex="-2" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add new TV channel</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
          <?php
		if(isset($errorMsg2))
		{
			foreach($errorMsg2 as $error2)
			{
			?>
				<div class="alert alert-danger">
					<strong>WRONG ! <?php echo $error2; ?></strong>
				</div>
            <?php
			}
		}
		if(isset($registerMsg2))
		{
		?>
			<div class="alert alert-success">
				<strong><?php echo $registerMsg2; ?></strong>
			</div>
        <?php
		}
		?>   
			<div class="text-center"><h2>Register Page</h2></div>
			<form method="post" class="form">
				
					<div class="form-group col-12">
            <label class="col-6 control-label" for="validationDefault010">TV channel Name</label>
            <div class="col-12">
            <input type="text" name="txt_channel_name_tv" class="form-control" placeholder="channel Name" id="validationDefault010" required/>
            </div>
					</div>
										
					<div class="form-group col-12">
            <label class="col-6 control-label" for="validationDefault011">Price Per Day</label>
            <div class="col-12">
            <input type="number" name="txt_price_day_tv" class="form-control" placeholder="Price Per Day" id="validationDefault011" required/>
            </div>
          </div>

          <div class="form-group col-12">
            <label class="col-6 control-label" for="validationDefault012">Price Per Week</label>
            <div class="col-12">
            <input type="number" name="txt_price_week_tv" class="form-control" placeholder="Price Per Week" id="validationDefault012" required/>
            </div>
          </div>

          <div class="form-group col-12">
            <label class="col-6 control-label" for="validationDefault013">Price Per Month</label>
            <div class="col-12">
            <input type="number" name="txt_price_month_tv" class="form-control" placeholder="Price Per Month" id="validationDefault013" required/>
            </div>
					</div>
									
				<div class="form-group col-12">
          <label class="col-6 control-label" for="validationDefault014">Reach Per day</label>
          <div class="col-12">
          <input type="text" name="txt_reach_day_tv" class="form-control" placeholder="Reach per day" id="validationDefault014" required/>
          </div>
				</div>
					
				<div class="form-group col-12">
				<label class="col-6 control-label" for="validationDefault015">End of Contract</label>
				<div class="col-12">
				<input type="date" name="txt_end_of_contract_tv" class="form-control" placeholder="Date of Ending" id="validationDefault015" required/>
				</div>
				</div>
        
        
				<div class="form-group col-12">
          <label class="col-6 control-label">Statu</label>
          <div class="col-12">
          <!-- <input type="text" name="txt_pos" class="" placeholder="enter your position" id="validationDefault07" required/> -->
          <select name="txt_statue_tv" id="select1" class="form-control px-3" required>
              <option value="Idle">Idle</option>
              <option value="Rented">Rented</option>
          </select>
          </div>
				</div>

				<div class="form-group col-12">
				<div class="mt-5 text-right">
				<input type="submit"  name="btn_register_tv" class="btn btn-primary" value="ADD TV">
				</div>
        </div>
        
			</form>
          </div>

        </div>
      </div>
    </div>



    <?php
  if(isset($_REQUEST['btn_register_w'])) //button name "btn_register"
{
	$status		= strip_tags($_REQUEST['txt_statue_w']);	//textbox name "txt_password"
	$site_url	= strip_tags($_REQUEST['txt_site_url']);	//textbox name "txt_email"
	$price_day		= strip_tags($_REQUEST['txt_price_day_web']);	//textbox name "txt_password"
	$price_week	= strip_tags($_REQUEST['txt_price_week_web']);	//textbox name "txt_password"
	$price_month	= strip_tags($_REQUEST['txt_price_month_web']);	//textbox name "txt_password"
	$reach_per_day		= strip_tags($_REQUEST['txt_reach_day_web']);	//textbox name "txt_password"
  $end_of_contract_date		= strip_tags($_REQUEST['txt_end_of_contract_web']);	//textbox name "txt_password"
  $width		= strip_tags($_REQUEST['txt_width_w']);	//textbox name "txt_password"
  $height		= strip_tags($_REQUEST['txt_hight_w']);	//textbox name "txt_password"
  
 
  $select_stmt=$db->prepare("SELECT site_url FROM {$website_tb} WHERE site_url=:sitrl"); // sql select query
$select_stmt->execute(array(':sitrl'=>$site_url)); //execute query 
$row=$select_stmt->fetch(PDO::FETCH_ASSOC);	

  if($row["site_url"]==$site_url){
    $errorMsg3[]="Sorry Channel already exists";	//check condition username already exists 
    }
    
    else if(!isset($errorMsg3)) //check no "$errorMsg" show then continue
    {
      global $newRows;

      $aid = $_SESSION['user_login'];
      $channeldescription = "Website" . $newRows;
    
        $insert_stmt_channel=$db->prepare("INSERT INTO {$channel_tb} (channel_id,agency_id,channeltype,channeldescription) VALUES 
                                          (:channel_id,:agency_id,:channeltype,:channeldescription)");
        $insert_stmt_channel->execute(array(
          ':channel_id'              =>$newRows,
          ':agency_id'               =>$aid, 
          ':channeltype'             =>'W',
          ':channeldescription'      =>$channeldescription));
    
				$insert_stmt_web=$db->prepare("INSERT INTO {$website_tb} (websitead_id,status,site_url,width,height,price_day,price_week,price_month,reach_per_day,end_of_contract_date) VALUES
																(:userid,:stat,:site_url,:width,:height,:price_day,:price_week,:price_month,:reach_per_day,:end_of_contract_date)"); 		//sql insert query					
				

				if($insert_stmt_web->execute(array(
                        ':userid'               =>$newRows,
                        ':stat'	                =>$status, 
												':site_url'             =>$site_url,
                        ':width'	              =>$width,
												':height'	              =>$height,
                        ':price_day'            =>$price_day,
												':price_week'	          =>$price_week,
												':price_month'	        =>$price_month,
												':reach_per_day'	      =>$reach_per_day,
												':end_of_contract_date'	=>$end_of_contract_date))){
													
					$registerMsg3="Channel Added Successfully.."; //execute query success message
        }
      }
  }
?>
    <!-- WEB ADS Modal -->
    <div class="modal fade" id="modelIdWEB" tabindex="-3" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add new WEB ad</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
          <?php
		if(isset($errorMsg3))
		{
			foreach($errorMsg3 as $error3)
			{
			?>
				<div class="alert alert-danger">
					<strong>WRONG ! <?php echo $error3; ?></strong>
				</div>
            <?php
			}
		}
		if(isset($registerMsg3))
		{
		?>
			<div class="alert alert-success">
				<strong><?php echo $registerMsg3; ?></strong>
			</div>
        <?php
		}
		?>   
			<div class="text-center"><h2>Register Page</h2></div>
			<form method="post" class="form">
					
					<div class="form-group col-12">
						<label class="col-6 control-label" for="validationDefault016">Site URL</label>
						<div class="col-12">
							<input type="text" name="txt_site_url" class="form-control" placeholder="Site URL" id="validationDefault016" required/>
						</div>
					</div>
					
					<div class="form-group col-12">
            <label class="col-6 control-label" for="validationDefault017">Price Per Day</label>
            <div class="col-12">
            <input type="number" name="txt_price_day_web" class="form-control" placeholder="Price Per Day" id="validationDefault017" required/>
            </div>
          </div>

          <div class="form-group col-12">
            <label class="col-6 control-label" for="validationDefault018">Price Per Week</label>
            <div class="col-12">
            <input type="number" name="txt_price_week_web" class="form-control" placeholder="Price Per Week" id="validationDefault018" required/>
            </div>
          </div>

          <div class="form-group col-12">
            <label class="col-6 control-label" for="validationDefault019">Price Per Month</label>
            <div class="col-12">
            <input type="number" name="txt_price_month_web" class="form-control" placeholder="Price Per Month" id="validationDefault019" required/>
            </div>
					</div>
									
				<div class="form-group col-12">
          <label class="col-6 control-label" for="validationDefault020">Reach Per day</label>
          <div class="col-12">
          <input type="text" name="txt_reach_day_web" class="form-control" placeholder="Reach per day" id="validationDefault020" required/>
          </div>
				</div>
					
				<div class="form-group col-12">
				<label class="col-6 control-label" for="validationDefault021">End of Contract</label>
				<div class="col-12">
				<input type="date" name="txt_end_of_contract_web" class="form-control" placeholder="date Of Ending" id="validationDefault021" required/>
				</div>
				</div>
        
        
				<div class="form-group col-12">
          <label class="col-6 control-label">Statu</label>
          <div class="col-12">
          <!-- <input type="text" name="txt_pos" class="" placeholder="enter your position" id="validationDefault07" required/> -->
          <select name="txt_statue_w" id="select1" class="form-control px-3" required>
              <option value="Idle">Idle</option>
              <option value="Rented">Rented</option>
          </select>
          </div>
				</div>


				<div class="form-group col-12">
        <label class="col-6 control-label">Dimensions</label>
        <div class="row mx-1">
          <div class="col-6">
          <input type="number" name="txt_width_w" class="form-control" placeholder="Width" required/>
          </div>

          <div class="col-6">
          <input type="number" name="txt_hight_w" class="form-control" placeholder="Hight" required/>
          </div>
        </div>
				</div>

				<div class="form-group col-12">
				<div class="mt-5 text-right">
				<input type="submit"  name="btn_register_w" class="btn btn-primary" value="ADD Website">
				</div>
        </div>
        
			</form>
          </div>
        </div>
      </div>
    </div>


	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="./assets/script/plugins/chartjs.min.js"></script>
    <script src="./assets/script/plugins/bootstrap-notify.js"></script>
    <script src="./assets/script/paper-dashboard.min.js"></script>
    <script src="./assets/demo/demo.js"></script>
    <script src="./assets/script/custom.js"></script>
    <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
	</body>
</html>