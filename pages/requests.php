<?php include_once '../header.php'; session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php

   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

?>

<body>
   <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="../index.php" class="navbar-brand">CRC</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
         <div class="navbar-nav">
            <a href="../index.php" class="nav-item nav-link">Home</a>
            <a href="#" class="nav-item nav-link active">About</a>
         </div>
         <div class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['email'])) {
               echo '<a href="profile.php" class="nav-item nav-link active"><i class="fa fa-user-o">  '.$_SESSION['email'].'</i></a>';
               echo '<a href="../sign_in/logout.php" class="nav-item nav-link">Logout</a>';
               }
               else{
               echo '<a href="../sign_in/google_sign_in.php" class="nav-item nav-link">Sign in</a>';
               }
               ?>
         </div>
      </div>
   </nav>
  
  
  
  
   <?php
      
      if(isset($_SESSION['email'])){	
	
      $con = getCon();	
	
      $email = $_SESSION['email'];
      
      $phone_number = Array();
      $description = Array();
      $state = Array();
      $city = Array();
   
      $my_posts_res = $con->query("select * from post where email='$email'");
   
      while($my_posts_ele = $my_posts_res->fetch_assoc())
      {
            $phone_number[] = $my_posts_ele['ph_no'];
            $description[] = $my_posts_ele['description'];
            $state[] = $my_posts_ele['state'];
            $city[] = $my_posts_ele['city'];  
      }
   
      $c = count($state);
   ?>
   
   
   <h4 class="m-4 text-center">My posts</h4>
   <div class="row m-4 d-flex justify-content-center">
			<?php for($i=0;$i<$c;$i++) { ?>
				<div class="col12 col-sm-3 m-2">
					<div class="card">
  						<h5 class="card-header"><?=$email?>&nbsp&nbsp<i class="fa fa-check-circle" aria-hidden="true" style="color:green;"></i></h5>
  						<div class="card-body">
							<h5 class="card-title"><?=$city[$i]?>, <?=$state[$i]?></h5>
    							<p class="card-text"><?=$description[$i]?></p>
							<p class="card-text">Ph no: <?=$phone_number[$i]?></p>
							<p class="card-text"><i class="fa fa-arrow-up" aria-hidden="true" style="color:green;font-size:24px;"></i>&nbsp&nbsp<i class="fa fa-arrow-down" aria-hidden="true" style="color:red;font-size:24px;"></i></p>
  						</div>
					</div>
				</div>
			<?php } ?>
		</div>
   
	
<?php } ?>	
  
</body>
  
