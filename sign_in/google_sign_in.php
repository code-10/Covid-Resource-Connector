<?php include_once '../header.php'; session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php $visit = $_SESSION['visit']; ?>

<?php

session_start();
//index.php

//Include Configuration File
include('config.php');

$login_button = '';


if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }	
	 
  if(!empty($data['phonenumbers']))
  {
   $_SESSION['user_phonenumbers'] = $data['phonenumbers'];
  }
 }
}


if(!isset($_SESSION['access_token']))
{

 $login_button = '<a style="border:1px solid black;" class="btn btn-light shadow p-3 mb-2 bg-white rounded" href="'.$google_client->createAuthUrl().'" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
  <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
</svg>&nbsp&nbspSign in with Google</a>';
	//<a href="'.$google_client->createAuthUrl().'">Sign in with Google</a>
}

?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PLEASE LOG IN TO CONTINUE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 
 </head>
 <body>
  
  
  <!--navbar-->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark"> <a href="../index.php" class="navbar-brand">CRC</a>
		<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse"> <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<div class="navbar-nav">
				<a href="../index.php" class="nav-item nav-link">Home</a>
				<a href="../pages/about.php" class="nav-item nav-link">About</a>
			</div>
				<!--<div class="navbar-nav ml-auto"> <a href="#" class="nav-item nav-link">Sign in</a>-->
			</div>
		</div>
	</nav>
  <!--navbar end-->
  
  
  <div class="container">
   <br />
   <h2 align="center">SIGN IN</h2>
   <br />
   <div class="panel panel-default">
   <?php
   if($login_button == '')
   {
	   
	   
	   $user = $_SESSION['user_first_name'];
	   $_SESSION['user_first_name']= $user;
	   
	   $user_email = $_SESSION['user_email_address'];
	   $_SESSION['email'] = $user_email;
	   
	   $last_name = $_SESSION['user_last_name'];
	   $_SESSION['last_name'] = $last_name;
	   
	   if (rowExists('user', 'email', $user_email))
    	{
		header("Location:../".$visit);
	   	die();	   
    	}
    	else
    	{
		$con = getCon();
        	$con->query("insert into user(first_name,last_name,email) values('".mysqli_real_escape_string($con,$user)."','".mysqli_real_escape_string($con,$last_name)."','".mysqli_real_escape_string($con,$user_email)."')");
        	header("Location:../".$visit);
	   	die();
	
    	}
	 
	   
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?>
   </div>
  </div>
	
	
	
	
	<h4 class="text-center m-4">OR</h4>	
	
	<?php 
	
		$signin = $_GET['signinwhich'];
	
		$wrongpassword=$_GET[ 'wrongpassword']; 
		$loginnow=$_GET['loginnow'];
		$nouser=$_GET['user'];
		$emailexists=$_GET['emailexists'];
		$error=$_GET['error'];
	
	?>
	<div class="container">
		<div class="text-center">
			<?php 
				if($wrongpassword)
					echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-danger' role='danger'>Your user_name or password is wrong</div></h4>";
				else if($loginnow)
					echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-primary' role='danger'>Login to continue</div></h4>";
				else if($emailexists)
		                	echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-danger' role='danger'>Email is already registered</div></h4>";
		            	else if($nouser)
					echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-danger' role='danger'>You don't have a Shopquest Account, Kindly Register</div></h4>";
				else if($error)
		                	echo "<h4 class='animate__animated animate__fadeOut' style='--animate-duration: 40s;'><div class='alert alert-danger' role='danger'>Something happened try again</div></h4>";
					
			?>
		</div>
	</div>
	
	
	
<div class="container">
    	<div class="row d-flex justify-content-center">
			<div class="col-md-6 col-md-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row d-flex justify-content-center">
							<div class="col-xs-6 col-lg-5 col-md-5 col-sm-5 col-5 m-2 text-center">
								<a href="#" class="active" id="login-form-link" style="color:blue;">Login</a>
							</div>
							<div class="col-xs-6 col-lg-5 col-md-5 col-sm-5 col-5 m-2 text-center">
								<a href="#" id="register-form-link" style="color:black;">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row d-flex justify-content-center">
							<div class="col-lg-12">
								
								<form  id="login-form" method="POST" action="login_details.php" style="display: block;">
									<div class="form-group">
					            <label for="inputEmail">Email</label>
					            <input type="email" class="form-control" id="inputEmail" placeholder="email" name="email" value="<?=$emailfill?>" required>
				          </div>
		              <div class="form-group">
			                <label for="inputPassword">Password</label>
			                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required>
		              </div>
		                  <button type="submit" name="login_user" class="btn btn-dark">Sign in</button>
								</form>
								
								<form method="POST" action="register_details.php" id="register-form" style="display: none;">
									<div class="form-group">
					          <label for="inputuser">First Name</label>
					            <input type="text" class="form-control" id="inputfirst_name" placeholder="firstname" name="first_name" required>
				          </div>
								<div class="form-group">
									<label for="inputuser">Last Name</label>
					            <input type="text" class="form-control" id="inputfirst_name" placeholder="lastname" name="last_name" required>
				          </div>
				          <div class="form-group">
					            <label for="inputEmail">Email</label>
					            <input type="email" class="form-control" id="inputEmail" placeholder="email" name="email" value="<?=$emailfill?>" required>
				          </div>
				          <div class="form-group">
					            <label for="inputPassword">Password</label>
					            <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required>
				          </div>
					            <button type="submit" name="register_user" class="btn btn-dark">Register</button>
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  
  	<br><br>
  
  
  
  
  
  
	<script>
		
		var signin = <?php print($signinwhich); ?>
	
		
			
		
		
	$(function() {
    		$('#login-form-link').click(function(e) {
                $("#login-form-link").css("color", "blue");
                $("#register-form-link").css("color", "black");
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
		$('#register-form-link').click(function(e) {
                $("#register-form-link").css("color", "blue");
                $("#login-form-link").css("color", "black");
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});

	
	
	</script>
  	
	
	
	
	
	
	
 </body>
