<?php include_once 'header.php'; ?>
<?php include_once 'libraries/shield.php'; session_start(); ?>

<?php

	$visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

?>

<body style="font-family:'Poppins', sans-serif;">
		
	
		<?php include_once "navBar.php"; ?>
	
		<?php $c=10; ?>
	
		<div class="container">
			<!--<h1 class="mb-5 responsive-lg">Find Resources to Fight Covid</h1>-->
			<h4 class="mt-4 responsive-md font-weight-bold">Welcome to Covid Resource Connector, 
				<span class="responsive-itt">In association with ITT(In This Together)
					<a href="https://www.instagram.com/inthistogethercovid/?hl=en"><?xml version="1.0" ?>
						<svg style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
						.st0{fill:url(#SVGID_1_);}
						.st1{fill:url(#SVGID_2_);}
						.st2{fill:#654C9F;}
						</style><g id="Edges"/><g id="Symbol"><g><radialGradient cx="56.3501" cy="19.2179" gradientTransform="matrix(0.9986 -5.233596e-02 4.448556e-02 0.8488 -36.9742 443.8014)" gradientUnits="userSpaceOnUse" id="SVGID_1_" r="711.335"><stop offset="0" style="stop-color:#FED576"/><stop offset="0.2634" style="stop-color:#F47133"/><stop offset="0.6091" style="stop-color:#BC3081"/><stop offset="1" style="stop-color:#4C63D2"/></radialGradient><path class="st0" d="M96.1,23.2c-16.2,6.3-29.9,14.7-43.6,28.4C38.8,65.2,30.4,79,24.1,95.1c-6.1,15.6-10.2,33.5-11.4,59.7    c-1.2,26.2-1.5,34.6-1.5,101.4s0.3,75.2,1.5,101.4c1.2,26.2,5.4,44.1,11.4,59.7c6.3,16.2,14.7,29.9,28.4,43.6    c13.7,13.7,27.4,22.1,43.6,28.4c15.6,6.1,33.5,10.2,59.7,11.4c26.2,1.2,34.6,1.5,101.4,1.5c66.8,0,75.2-0.3,101.4-1.5    c26.2-1.2,44.1-5.4,59.7-11.4c16.2-6.3,29.9-14.7,43.6-28.4c13.7-13.7,22.1-27.4,28.4-43.6c6.1-15.6,10.2-33.5,11.4-59.7    c1.2-26.2,1.5-34.6,1.5-101.4s-0.3-75.2-1.5-101.4c-1.2-26.2-5.4-44.1-11.4-59.7C484,79,475.6,65.2,462,51.6    c-13.7-13.7-27.4-22.1-43.6-28.4c-15.6-6.1-33.5-10.2-59.7-11.4c-26.2-1.2-34.6-1.5-101.4-1.5s-75.2,0.3-101.4,1.5    C129.6,12.9,111.7,17.1,96.1,23.2z M356.6,56c24,1.1,37,5.1,45.7,8.5c11.5,4.5,19.7,9.8,28.3,18.4c8.6,8.6,13.9,16.8,18.4,28.3    c3.4,8.7,7.4,21.7,8.5,45.7c1.2,25.9,1.4,33.7,1.4,99.4s-0.3,73.5-1.4,99.4c-1.1,24-5.1,37-8.5,45.7c-4.5,11.5-9.8,19.7-18.4,28.3    c-8.6,8.6-16.8,13.9-28.3,18.4c-8.7,3.4-21.7,7.4-45.7,8.5c-25.9,1.2-33.7,1.4-99.4,1.4s-73.5-0.3-99.4-1.4    c-24-1.1-37-5.1-45.7-8.5c-11.5-4.5-19.7-9.8-28.3-18.4c-8.6-8.6-13.9-16.8-18.4-28.3c-3.4-8.7-7.4-21.7-8.5-45.7    c-1.2-25.9-1.4-33.7-1.4-99.4s0.3-73.5,1.4-99.4c1.1-24,5.1-37,8.5-45.7c4.5-11.5,9.8-19.7,18.4-28.3c8.6-8.6,16.8-13.9,28.3-18.4    c8.7-3.4,21.7-7.4,45.7-8.5c25.9-1.2,33.7-1.4,99.4-1.4S330.7,54.8,356.6,56z"/><radialGradient cx="154.0732" cy="134.5501" gradientTransform="matrix(0.9986 -5.233596e-02 4.448556e-02 0.8488 -24.3617 253.2946)" gradientUnits="userSpaceOnUse" id="SVGID_2_" r="365.2801"><stop offset="0" style="stop-color:#FED576"/><stop offset="0.2634" style="stop-color:#F47133"/><stop offset="0.6091" style="stop-color:#BC3081"/><stop offset="1" style="stop-color:#4C63D2"/></radialGradient><path class="st1" d="M130.9,256.3c0,69.8,56.6,126.3,126.3,126.3s126.3-56.6,126.3-126.3S327,130,257.2,130    S130.9,186.5,130.9,256.3z M339.2,256.3c0,45.3-36.7,82-82,82s-82-36.7-82-82c0-45.3,36.7-82,82-82S339.2,211,339.2,256.3z"/><circle class="st2" cx="388.6" cy="125" r="29.5"/></g></g>
						</svg></a>
				</span> 
			</h4>
			<h6 class="text-muted">A Non-profit Organization.</h6>
      			<p class="mt-2 responsive-tx">Our Website bridges the communication gap between people who want to help and people who want help regarding covid related queries.</p>
			<br>
			<div class="row">
				<div class="col col-sm-6 text-center">
					<a class="btn btn-success rounded-pill res-mar res-pad" href="pages/view_posts.php?type=resource" role="button" style="background-color:#006E5F;">View All Resources</a>
				</div>
				<div class="col col-sm-6 text-center">
					<a class="btn btn-success rounded-pill res-mar res-pad" href="pages/view_posts.php?type=request" role="button" style="background-color:#006E5F;">View Requests & Respond</a>
				</div>
			</div>
			
			<div class="row">
				<div class="col col-sm-6 text-center">
					<a class="btn btn-success rounded-pill res-mar res-pad" href="pages/create_post.php?resource=selected" role="button" style="background-color:#006E5F;">Create a Resource</a>
				</div>
				<div class="col col-sm-6 text-center">
					<a class="btn btn-success rounded-pill res-mar res-pad" href="pages/create_post.php?request=selected" role="button" style="background-color:#006E5F;">Create a Request</a>
				</div>
			</div>

			<div class='row'>
				<div class='col text-center'>
						<a class="btn btn-success rounded-pill res-mar res-pad" href="pages/backup_display.php" role="button" style="border:3px solid #006E5F;color:#006E5F;background:white">See Backup of Posts</a>
				</div>
			</div>
			
			<!--<h2 class="responsive-md mb-4">Find resources <a class="btn btn-info btn-sm" href="pages/view_posts.php?type=resource" role="button">View All Available Resources</a></h2>
			<h2 class="responsive-md mb-4">Want to Help? <a class="btn btn-success btn-sm" href="pages/view_posts.php?type=request" role="button">View Requests & Respond</a></h2>
			<h2 class="responsive-md mb-4">You Want to  Help? <a class="btn btn-success btn-sm" href="pages/create_post.php?resource=selected" role="button">Create a Resource</a></h2>
			<h2 class="responsive-md mb-4">Want Help? <a class="btn btn-success btn-sm" href="pages/create_post.php?request=selected" role="button">Create a Request</a></h2>-->
		</div>
  
<br><br>	
	
</body>

<div class="text-center">
	<a href="pages/donate.php?main=yes"><button type="button" class="btn btn-dark" style="background-color:purple;"><i class="fa fa-hand-holding-heart mr-2"></i>Donate</button></a>
</div>

<br><br>

<style>
    /*Media Queries*/
	@media (min-width:320px)  { .responsive-md{font-size:24px;} .responsive-lg{font-size:32px;} .responsive-tx{font-size:12px;} .res-pad{padding:10px;} .res-mar{margin:8px;} .responsive-itt{font-size:12px;} /* smartphones, iPhone, portrait 480x320 phones */ }
	@media (min-width:481px)  { .responsive-md{font-size:32px;} .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} .responsive-itt{font-size:20px;}/* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
    	@media (min-width:641px)  { .responsive-md{font-size:32px;} .responsive-lg{font-size:64px;}  .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} .responsive-itt{font-size:20px;}/* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
	@media (min-width:961px)  { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} .responsive-itt{font-size:20px;}/* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} .responsive-itt{font-size:20px;}/* big landscape tablets, laptops, and desktops */ }
	@media (min-width:1281px) { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} .responsive-itt{font-size:20px;}/* hi-res laptops and desktops */ }
	
</style>
