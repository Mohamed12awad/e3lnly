<?php

require_once "./assets/crud/connection.php";

if(isset($_REQUEST['btn_register'])) //button name "btn_register"
{
	$username	= strip_tags($_REQUEST['txt_username']);	//textbox name "txt_email"
	$email		= strip_tags($_REQUEST['txt_email']);		//textbox name "txt_email"
	$password	= strip_tags($_REQUEST['txt_password']);	//textbox name "txt_password"
	$phone	= strip_tags($_REQUEST['txt_phone']);	//textbox name "txt_password"
	$city	= strip_tags($_REQUEST['txt_city']);	//textbox name "txt_password"
	$district	= strip_tags($_REQUEST['txt_district']);	//textbox name "txt_password"
	$street	= strip_tags($_REQUEST['txt_street']);	//textbox name "txt_password"
		
	if(empty($username)){
		$errorMsg[]="Please enter username";	//check username textbox not empty 
	}
	else if(empty($email)){
		$errorMsg[]="Please enter email";	//check email textbox not empty 
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$errorMsg[]="Please enter a valid email address";	//check proper email format 
	}
	else if(empty($password)){
		$errorMsg[]="Please enter password";	//check passowrd textbox not empty
	}
	else if(strlen($password) < 6){
		$errorMsg[] = "Password must be atleast 6 characters";	//check passowrd must be 6 characters
	}
	else if(empty($phone)){
		$errorMsg[]="Please enter phone number";	//check passowrd textbox not empty
	}
	else if(empty($city)){
		$errorMsg[]="Please enter your city";	//check passowrd textbox not empty
	}
	else if(empty($district)){
		$errorMsg[]="Please enter which district";	//check passowrd textbox not empty
	}
	else if(empty($street)){
		$errorMsg[]="Please enter the street";	//check passowrd textbox not empty
	}
	else
	{	
		try
		{	
			$select_stmt=$db->prepare("SELECT agency_name,agency_mail FROM {$agency_tb} 
										WHERE agency_name=:uname OR agency_mail=:uemail"); // sql select query
			
			$select_stmt->execute(array(':uname'=>$username, ':uemail'=>$email)); //execute query 
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);	
			
			if($row["agency_name"]==$username){
				$errorMsg[]="Sorry username already exists";	//check condition username already exists 
			}
			else if($row["agency_mail"]==$email){
				$errorMsg[]="Sorry email already exists";	//check condition email already exists 
			}
			else if(!isset($errorMsg)) //check no "$errorMsg" show then continue
			{
				//$new_password = password_hash($password, PASSWORD_DEFAULT); //encrypt password using password_hash()
				// $new_password = $password
				
				$insert_stmt=$db->prepare("INSERT INTO {$agency_tb}	(agency_id,agency_name,agency_phoneno,agency_city,agency_district,agency_street,agency_mail,agency_password) VALUES
																(:userid,:uname,:uphone,:ucity,:udist,:ust,:uemail,:upassword)"); 		//sql insert query					
				
				$nRows = $db->query("select count(*) from {$agency_tb} ")->fetchColumn();
				$newRows = $nRows + 1;
				
				if($insert_stmt->execute(array(	'userid'    =>$newRows,
												':uname'	=>$username, 
												':uphone'	=>$phone,
												':ucity'	=>$city, 
												':udist'	=>$district, 
												':ust'		=>$street, 
												':uemail'	=>$email, 
												':upassword'=>$password))){
													
					$registerMsg="Register Successfully..... Please Click On Login Account Link"; //execute query success message
					header("refresh:1; login_agency.php");
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">	
	<title>Login</title>
		
	<script src="https://kit.fontawesome.com/7d670817b2.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="./assets/style/style.css">
</head>

	<body>
  <!-- calling navbar -->
  <?php 
      include "./assets/components/navbar.php";

    ?>

	
	<div class="wrapper">
	
	<div class="container">
			
		<div class="col-lg-12">
		
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
			<center><h2>Register Page</h2></center>
			<form method="post" class="form-horizontal">
					
				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="col-sm-3 control-label" for="validationDefault01">Username</label>
						<div class="col-sm-6">
							<input type="text" name="txt_username" class="form-control" placeholder="enter username" id="validationDefault01" required/>
						</div>
					</div>
					
					<div class="form-group col-md-6">
						<label class="col-sm-3 control-label" for="validationDefault02">Email</label>
						<div class="col-sm-6">
							<input type="text" name="txt_email" class="form-control" placeholder="enter email" id="validationDefault02" required/>
						</div>
					</div>
				</div>
				
				<div class="form-row">
			
					<div class="form-group col-md-6">
					<label class="col-sm-3 control-label" for="validationDefault03">Password</label>
					<div class="col-sm-6">
					<input type="password" name="txt_password" class="form-control" placeholder="enter passowrd" id="validationDefault03" required/>
					</div>
					</div>
										
					<div class="form-group col-md-6">
					<label class="col-sm-3 control-label" for="validationDefault04">Phone</label>
					<div class="col-sm-6">
					<input type="text" name="txt_phone" class="form-control" placeholder="enter Phone" id="validationDefault04" required/>
					</div>
					</div>

				</div>
					
				<div class="form-row">
				
				<div class="form-group col-md-6">
				<label class="col-sm-3 control-label" for="validationDefault05">City</label>
				<div class="col-sm-6">
				<input type="text" name="txt_city" class="form-control" placeholder="enter city" id="validationDefault05" required/>
				</div>
				</div>
					
				<div class="form-group col-md-6">
				<label class="col-sm-3 control-label" for="validationDefault06">District</label>
				<div class="col-sm-6">
				<input type="text" name="txt_district" class="form-control" placeholder="enter district" id="validationDefault06" required/>
				</div>
				</div>
				
				</div>
					
				<div class="form-row">
				
				<div class="form-group col-md-6">
				<label class="col-sm-3 control-label" for="validationDefault07">Street</label>
				<div class="col-sm-6">
				<input type="text" name="txt_street" class="form-control" placeholder="enter street" id="validationDefault07" required/>
				</div>
				</div>

				</div>
				
					
				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-12 mt-3">
				<input type="submit"  name="btn_register" class="btn btn-primary " value="Register">
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-12 mt-3">
				You have a account register here? <a href="login_agency.php"><p class="text-info">Login Account</p></a>		
				</div>
				</div>
					
			</form>
			
		</div>
		
	</div>
			
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="./assets/script/custom.js"></script>						
	</body>
</html>