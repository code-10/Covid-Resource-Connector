<?php include_once 'header.php'; ?>
<?php include_once 'libraries/shield.php'; session_start(); ?>

<?php

	$visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

?>

<body>
		
		<!--Navigation Bar-->
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="../index.php" class="navbar-brand">CRC</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
         <div class="navbar-nav">
            <a href="#" class="nav-item nav-link active">Home</a>
            <a href="pages/about.php" class="nav-item nav-link">About</a>
         </div>
         <div class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['email'])) {
               echo '<a href="pages/profile.php" class="nav-item nav-link active"><i class="fa fa-user-o">  '.$_SESSION['email'].'</i></a>';
               echo '<a href="../sign_in/logout.php" class="nav-item nav-link">Logout</a>';
               }
               else{
               echo '<a href="../sign_in/google_sign_in.php" class="nav-item nav-link">Sign in</a>';
               }
               ?>
         </div>
      </div>
   </nav>
	
	
		<?php $c=10; ?>
	
		<div class="text-center m-2">
			<h1 class="mb-5 responsive-lg">Find Resources to Fight Covid</h1>
			<?php if(isset($_SESSION['email'])) {
					echo '<h2 class="responsive-md mb-4">Want Help? <a class="btn btn-success btn-sm" href="pages/create_post.php" role="button">Create a Request</a></h2>';
				}
				else{
					echo '<h2 class="responsive-md mb-4">Want Help? <a class="btn btn-success btn-sm" href="sign_in/google_sign_in.php" role="button">Create a Request</a></h2>';	
				}
			?>
			<h2 class="responsive-md mb-4">Want to Help? <a class="btn btn-success btn-sm" href="pages/requests.php" role="button">View Requests & Respond</a></h2>
			<h2 class="responsive-md mb-4">Find more <a class="btn btn-info btn-sm" href="#" role="button">View All Available Resources</a></h2>
		</div>
	
		<!--<div class="row m-4 d-flex justify-content-center">
			<?php for($i=0;$i<$c;$i++) { ?>
				<div class="col12 col-sm-3 m-2">
					<div class="card">
  						<h5 class="card-header">Manoj&nbsp&nbsp<i class="fa fa-check-circle" aria-hidden="true" style="color:green;"></i></h5>
  						<div class="card-body">
    							<h5 class="card-title">Karnataka</h5>
    							<p class="card-text">Oxygen Cylinder</p>
							<p class="card-text">Area: Yelahanka</p>
							<p class="card-text">Request Description: Blood Plasma O+ve</p>
							<p class="card-text">Ph no: 9980712884</p>
							<p class="card-text"><i class="fa fa-arrow-up" aria-hidden="true" style="color:green;font-size:24px;"></i>&nbsp&nbsp<i class="fa fa-arrow-down" aria-hidden="true" style="color:red;font-size:24px;"></i></p>
  						</div>
					</div>
				</div>
			<?php } ?>
		</div>-->
  
</body>


<style>
    /*Media Queries*/
	@media (min-width:320px)  { .responsive-md{font-size:24px;} .responsive-lg{font-size:32px;} /* smartphones, iPhone, portrait 480x320 phones */ }
	@media (min-width:481px)  { .responsive-md{font-size:32px;} .responsive-lg{font-size:64px;} /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
    	@media (min-width:641px)  { .responsive-md{font-size:32px;} .responsive-lg{font-size:64px;}/* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
	@media (min-width:961px)  { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;}/* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;}/* big landscape tablets, laptops, and desktops */ }
	@media (min-width:1281px) { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;}/* hi-res laptops and desktops */ }
	
</style>
