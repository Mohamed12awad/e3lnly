<?php

require_once "./assets/crud/connection.php";

if(isset($_REQUEST['btn_register'])) //button name "btn_register"
{
	$username	= strip_tags($_REQUEST['txt_username']);	//textbox name "txt_email"
	$email		= strip_tags($_REQUEST['txt_email']);		//textbox name "txt_email"
	$password	= strip_tags($_REQUEST['txt_password']);	//textbox name "txt_password"
	$phone		= strip_tags($_REQUEST['txt_phone']);	//textbox name "txt_password"
	$cmp_name	= strip_tags($_REQUEST['txt_cmp_name']);	//textbox name "txt_password"
	$cmp_fld	= strip_tags($_REQUEST['txt_cmp_fld']);	//textbox name "txt_password"
	$pos		= strip_tags($_REQUEST['txt_pos']);	//textbox name "txt_password"
	$remail		= strip_tags($_REQUEST['txt_remail']);	//textbox name "txt_password"
		
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
	else if(empty($cmp_name)){
		$errorMsg[]="Please enter company name";	//check passowrd textbox not empty
	}
	else if(empty($cmp_fld)){
		$errorMsg[]="Please enter company field";	//check passowrd textbox not empty
	}
	else if(empty($pos)){
		$errorMsg[]="Please enter your position";	//check passowrd textbox not empty
	}
	else if(!filter_var($remail, FILTER_VALIDATE_EMAIL)){
		$errorMsg[]="Please enter a valid recovery email address";	//check proper email format 
	}
	else
	{	
		try
		{	
			$select_stmt=$db->prepare("SELECT customer_name,company_mail FROM {$customer_tb} 
										WHERE customer_name=:uname OR company_mail=:uemail"); // sql select query
			
			$select_stmt->execute(array(':uname'=>$username, ':uemail'=>$email)); //execute query 
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);	
			
			if($row["customer_name"]==$username){
				$errorMsg[]="Sorry username already exists";	//check condition username already exists 
			}
			else if($row["company_mail"]==$email){
				$errorMsg[]="Sorry email already exists";	//check condition email already exists 
			}
			else if(!isset($errorMsg)) //check no "$errorMsg" show then continue
			{
				//$new_password = password_hash($password, PASSWORD_DEFAULT); //encrypt password using password_hash()
				// $new_password = $password
				
				$insert_stmt=$db->prepare("INSERT INTO {$customer_tb}	(customer_id,customer_name,customer_phoneno,company_name,company_field,customer_position,company_mail,recovery_mail,customer_passowrd) VALUES
																(:userid,:uname,:uphone,:cmp_name,:cmp_field,:upos,:uemail,:ure_mail,:upassword)"); 		//sql insert query					
				
				$nRows = $db->query("select count(*) from {$customer_tb}")->fetchColumn();
				$newRows = $nRows + 1;
				
				if($insert_stmt->execute(array(	':userid'    =>$newRows,
												':uname'	=>$username, 
												':uphone'	=>$phone,
												':cmp_name'	=>$cmp_name,
												':cmp_field'=>$cmp_fld, 
												':upos'		=>$pos, 
												':uemail'	=>$email, 
												':ure_mail'	=>$remail, 
												':upassword'=>$password))){
													
					$registerMsg="Register Successfully..... Please Click On Login Account Link"; //execute query success message
					header("refresh:1; login_client.php");
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
			<div class="text-center"><h2>Register Page</h2></div>
			<form method="post" class="form-horizontal">
					
				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="col-md-3 control-label" for="validationDefault01">Username</label>
						<div class="col-md-6">
							<input type="text" name="txt_username" class="form-control" placeholder="enter username" id="validationDefault01" required/>
						</div>
					</div>
					
					<div class="form-group col-md-6">
						<label class="col-md-3 control-label" for="validationDefault02">Company Email</label>
						<div class="col-md-6">
							<input type="text" name="txt_email" class="form-control" placeholder="enter email" id="validationDefault02" required/>
						</div>
					</div>
				</div>
				
				<div class="form-row">
			
					<div class="form-group col-md-6">
					<label class="col-md-3 control-label" for="validationDefault03">Password</label>
					<div class="col-md-6">
					<input type="password" name="txt_password" class="form-control" placeholder="enter passowrd" id="validationDefault03" required/>
					</div>
					</div>
										
					<div class="form-group col-md-6">
					<label class="col-md-3 control-label" for="validationDefault04">Phone</label>
					<div class="col-md-6">
					<input type="text" name="txt_phone" class="form-control" placeholder="enter Phone" id="validationDefault04" required/>
					</div>
					</div>

				</div>
					
				<div class="form-row">
				
				<div class="form-group col-md-6">
				<label class="col-md-3 control-label" for="validationDefault05">Company Name</label>
				<div class="col-md-6">
				<input type="text" name="txt_cmp_name" class="form-control" placeholder="enter company name" id="validationDefault05" required/>
				</div>
				</div>
					
				<div class="form-group col-md-6">
				<label class="col-md-3 control-label" for="validationDefault06">Company Feild</label>
				<div class="col-md-6">
				<input type="text" name="txt_cmp_fld" class="form-control" placeholder="enter company field" id="validationDefault06" required/>
				</div>
				</div>
				
				</div>
					
				<div class="form-row">
				
				<div class="form-group col-md-6">
				<label class="col-md-3 control-label" for="validationDefault07">Position</label>
				<div class="col-md-6">
				<input type="text" name="txt_pos" class="form-control" placeholder="enter your position" id="validationDefault07" required/>
				</div>
				</div>


				<div class="form-group col-md-6">
				<label class="col-md-3 control-label" for="validationDefault08">Recovery Mail</label>
				<div class="col-md-6">
				<input type="text" name="txt_remail" class="form-control" placeholder="enter recovery email" id="validationDefault08" required/>
				</div>
				</div>

				</div>
				
					
				<div class="form-group">
				<div class="col-md-offset-3 col-md-9 m-t-15">
				<input type="submit"  name="btn_register" class="btn btn-primary " value="Register">
				</div>
				</div>
				
				<div class="form-group">
				<div class="col-md-offset-3 col-md-9 m-t-15">
				You have a account register here? <a href="login_client.php"><p class="text-info">Login Account</p></a>		
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