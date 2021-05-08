<?php include_once '../header.php'; session_start(); ?>
<?php

   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

?>

<body>
   <?php include_once "../navBar.php"; ?>
   
   
   <div class="container">
      <h4 class="mt-4">Welcome to Covid Resource Connector, A Non-profit Organization.
         <span class="responsive-itt">In association with ITT(In This Together)
	</span>
      </h4>
      	<p class="mt-2 mb-1">Our Website connects the communication gap between people who want to help and people who want help regarding covid related queries.</p>
      	<p class="mb-2">We try to add as many verified leads as possible, but We advise you to verify the Leads we provide before making any payments in advance.</p>
	   <br>
	   <h6 class="mt-1">Who are we?</h6>
	   <p class="mt-1 mb-2">We are a Group of Volunteers trying to save as many lives as possible.</p>
	   <br>
   </div>
	

<div class="text-center">
	<a href="donate.php?main=yes"><button type="button" class="btn btn-dark" style="background-color:purple;"><i class="fa fa-hand-holding-heart mr-2"></i>Donate</button></a>
</div>
</body>
  
<style>
    /*Media Queries*/
	@media (min-width:320px)  { .responsive-md{font-size:24px;} .responsive-lg{font-size:32px;} .responsive-tx{font-size:12px;} .res-pad{padding:10px;} .res-mar{margin:8px;} .responsive-itt{font-size:12px;} /* smartphones, iPhone, portrait 480x320 phones */ }
	@media (min-width:481px)  { .responsive-md{font-size:32px;} .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} .responsive-itt{font-size:20px;}/* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
    	@media (min-width:641px)  { .responsive-md{font-size:32px;} .responsive-lg{font-size:64px;}  .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} .responsive-itt{font-size:20px;}/* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
	@media (min-width:961px)  { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} .responsive-itt{font-size:20px;}/* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} .responsive-itt{font-size:20px;}/* big landscape tablets, laptops, and desktops */ }
	@media (min-width:1281px) { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} .responsive-itt{font-size:20px;}/* hi-res laptops and desktops */ }
	
</style>
