<?php include_once '../header.php'; session_start(); include_once '../libraries/shield.php'; ?>
<?php

   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

	$anonymous = $_GET['anonymous'];

?>

<body>
   <?php include_once "../navBar.php"; ?>
  
	<?php
	
		$con = getCon();
		
		$donate_res = $con->query("select * from donations");
		while($donate_ele = $donate_res->fetch_assoc())
		{
			$donation_name[] = $donate_ele['name'];
			$donation_amount[] = $donate_ele['donation_amount'];
		}
	
	?>
	
	<?php if($anonymous=="yes") { ?>
		<div class="text-center">
			<img src="donate.jpg" class="res-img" alt="PHONE PE QR CODE">
		</div>	
	<?php } else if($anonymous=="no") { ?>
		<div class="text-center">
			<img src="donate.jpg" class="res-img" alt="PHONE PE QR CODE">
		</div>	
	<?php } else { ?>
		<div class="text-center">
      		<h4 class="m-4">Donate if you want to support people in need of covid resource and to improve the website.</h4>
      		<!--<img src="donate.jpg" class="res-img" alt="PHONE PE QR CODE">-->
	
		<a class="btn btn-primary m-2" href="donate.php?anonymous=no" role="button">Donate</a>     
     		<a class="btn btn-primary m-2" href="donate.php?anonymous=yes" role="button">Donate Anonymously</a>    
		    
    		</div>
	<?php } ?>	
    
    
  
</body>

<style>
    /*Media Queries*/
   @media (min-width:320px)  { .res-img{width:100%;height:100%;} /* smartphones, iPhone, portrait 480x320 phones */ }
	@media (min-width:481px)  { .res-img{width:32%;height:32%;} /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
   @media (min-width:641px)  { .res-img{width:32%;height:32%;} /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
	@media (min-width:961px)  { .res-img{width:32%;height:32%;} /* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .res-img{width:32%;height:32%;} /* big landscape tablets, laptops, and desktops */ }
	@media (min-width:1281px) { .res-img{width:32%;height:32%;} /* hi-res laptops and desktops */ }
	
</style>
