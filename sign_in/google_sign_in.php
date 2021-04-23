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

 $login_button = '<a href="'.$google_client->createAuthUrl().'">Sign in with Google</a>';
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
	   echo '
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
	    </div>';
	   
	   $user = $_SESSION['user_first_name'];
	   $_SESSION['user_name']= $user;
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
