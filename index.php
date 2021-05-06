<?php include_once 'header.php'; ?>
<?php include_once 'libraries/shield.php'; session_start(); ?>

<?php

	$visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

?>

<body>
		
	
		<?php include_once "navBar.php"; ?>
	
		<?php $c=10; ?>
	
		<div class="text-center m-2">
			<!--<h1 class="mb-5 responsive-lg">Find Resources to Fight Covid</h1>-->
			<h4 class="m-4 responsive-md">Welcome to Covid Resource Connector.</h4>
			<h6 class="text-muted">A Non-profit Organization.</h6>
      			<p class="m-2 responsive-tx">Our Website bridges the communication gap between people who want to help and people who want help regarding covid related queries.</p>
			<br><br>
			
			<div class="row d-flex justify-content-center">
				<div class="col-6">
					<a class="btn btn-success rounded-pill p-2" href="pages/view_posts.php?type=resource" role="button">View All Resources</a>
				</div>
				<div class="col-6">
					<a class="btn btn-success rounded-pill p-2" href="pages/view_posts.php?type=request" role="button">View Requests & Respond</a>
				</div>
			</div>
			
			<div class="row d-flex justify-content-center">
				<div class="col-6">
					<a class="btn btn-success rounded-pill p-2" href="pages/create_post.php?resource=selected" role="button">Create a Resource</a>
				</div>
				<div class="col-6">
					<a class="btn btn-success rounded-pill p-2" href="pages/create_post.php?request=selected" role="button">Create a Request</a>
				</div>
			</div>
			
			<!--<h2 class="responsive-md mb-4">Find resources <a class="btn btn-info btn-sm" href="pages/view_posts.php?type=resource" role="button">View All Available Resources</a></h2>
			<h2 class="responsive-md mb-4">Want to Help? <a class="btn btn-success btn-sm" href="pages/view_posts.php?type=request" role="button">View Requests & Respond</a></h2>
			<h2 class="responsive-md mb-4">You Want to  Help? <a class="btn btn-success btn-sm" href="pages/create_post.php?resource=selected" role="button">Create a Resource</a></h2>
			<h2 class="responsive-md mb-4">Want Help? <a class="btn btn-success btn-sm" href="pages/create_post.php?request=selected" role="button">Create a Request</a></h2>-->
		</div>
  
<br>	
	
</body>

<div class="text-center">
	<a href="pages/donate.php?main=yes"><button type="button" class="btn btn-dark" style="background-color:purple;"><i class="fa fa-hand-holding-heart mr-2"></i>Donate</button></a>
</div>

<br><br>

<style>
    /*Media Queries*/
	@media (min-width:320px)  { .responsive-md{font-size:24px;} .responsive-lg{font-size:32px;} .responsive-tx{font-size:12px;} /* smartphones, iPhone, portrait 480x320 phones */ }
	@media (min-width:481px)  { .responsive-md{font-size:32px;} .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;} /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
    	@media (min-width:641px)  { .responsive-md{font-size:32px;} .responsive-lg{font-size:64px;}  .responsive-tx{font-size:16px;} /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
	@media (min-width:961px)  { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;}/* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;}/* big landscape tablets, laptops, and desktops */ }
	@media (min-width:1281px) { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;}/* hi-res laptops and desktops */ }
	
</style>
