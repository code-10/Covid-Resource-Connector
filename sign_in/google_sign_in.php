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

 $login_button = '<a class="btn btn-light shadow p-3 mb-5 bg-white rounded" href="'.$google_client->createAuthUrl().'" role="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
  <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
</svg>  Sign in with Google</a>';
	//<a href="'.$google_client->createAuthUrl().'">Sign in with Google</a>
}

?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>SIGN IN</title>
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
	   /*echo '
	   <div class="row m-4 d-flex justify-content-center">
	   	<div class="card" style="width: 18rem;">
  		<img src="'.$_SESSION["user_image"].'" class="card-img-top" alt="...">
  			<div class="card-body">
    				<h5 class="card-title">'.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h5>
    				<p class="card-text">'.$_SESSION['user_email_address'].'</p>
				<p class="card-text">'.$_SESSION['user_phonenumbers'].'</p>
    				<a href="logout.php" class="btn btn-primary">Logout</a>
  			</div>
		</div>
	    </div>';*/
	   
	   $user = $_SESSION['user_first_name'];
	   $_SESSION['user_name']= $user;
	   
	   $user_email = $_SESSION['user_email_address'];
	   $_SESSION['user_email'] = $user_email;
	   
	   header("Location:../pages/profile.php");
	   die();
	   
    //echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
    //echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    //echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    //echo '<h3><a href="logout.php">Logout</h3></div>';
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?>
   </div>
  </div>
 </body>
