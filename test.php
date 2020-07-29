<?php
  require_once './assets/crud/connection.php';
          
  session_start();

  $stmt = $db->prepare('
      SELECT 
          billboard.*,websitead.*,tvad.*, channel.channel_id
      FROM 
        billboard
      INNER JOIN 
          channel
      ON 
          billboard.billboard_id=channel.channel_id
      INNER JOIN 
          tvad
      ON 
          tvad.channel_id=channel.channel_id
      INNER JOIN 
          websitead
      ON 
          websitead.websitead_id=channel.channel_id
      ORDER BY
          channel_id
  ');
  
  var_dump($stmt->fetch(PDO::FETCH_ASSOC));
  while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    var_dump($row);
    ?>
      <div class="card bg-warning text-white" style="height: 300px; max-width:250px">
        <div class="card-body">
          <h5 class="card-title font-weight-bold">tv</h5>
          <p class="card-text">channel name: <?php echo $row['tv_channel_name'] ?></p>
          <h6 class="card-subtitle mb-2 text-muted">status: <?php echo$row['status']?></h6>
          <p class="card-text">end of contract: <?php echo $row['end_of_contract_date'] ?></p>
          <p class="card-text">reach: <?php echo $row['reach_per_day'] ?> / per day</p>
          <p class="card-text">price: $<?php echo $row['price_day']?> / per day</p>
        </div>
      </div>
      <?php
    
  }
  
    ?>
  		<div class="col-lg-12">
			<div class="d-block text-center">
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
        
				</h2>
					<a href="./crud/logout.php">Logout</a>
			</div>




      <div class="col-lg-12">
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
  ');

  // Bind the query params
  $stmt->bindParam(':aid', $aid, PDO::PARAM_INT);
  // $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
  $stmt->execute();

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
                      <td><?php echo $row['suggested_price']?></td>
                      <td><a href="product.php?id=<?php echo $row['channel_id'] ?>">Go To..</a></td>
                    </tr>
              <?php
            
        }
      }
      

  } else {
      echo '<p>No results could be displayed.</p>';
  }

} catch (Exception $e) {
  echo '<p>', $e->getMessage(), '</p>';
}
      ?>
      </tbody>
      </table>
      
      </div>