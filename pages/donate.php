<?php include_once '../header.php'; session_start(); ?>
<?php

   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

?>

<body>
   <?php include_once "../navBar.php"; ?>
  
    
    <div class="text-center">
      <h4 class="m-4">Donate if you want to support the developers and people in need of covid resources</h4>
      <img src="donate.jpg" class="res-img" alt="PHONE PE QR CODE">
    </div>
  
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
