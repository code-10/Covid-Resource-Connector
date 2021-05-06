<?php include_once '../header.php'; session_start(); include_once '../libraries/shield.php'; ?>
<?php

   	$visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

	$anonymous = $_GET['anonymous'];

	$main = $_GET['main'];
	$dev = $_GET['dev'];
?>

<body style="font-family:'Poppins', sans-serif;">
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
		<!--<div class="text-center">
			<img src="donate.jpg" class="res-img" alt="PHONE PE QR CODE">
		</div>	-->
	<?php } else if($anonymous=="no") { ?>
		<!--<div class="text-center">
			<h4 class="m-4">Include the same name and code in the donation message for us to identify you.</h4>
			
			 <div class="container">
    				<div class="row d-flex justify-content-center">
					<div class="col-md-6 col-md-3">
   						<div class="row d-flex justify-content-center">
							<form id="createPost" method="POST" action="verify_post.php" style="display:block;" onsubmit="document.getElementById('donatedisable').disabled=true;document.getElementById('donatedisable').innerText = 'Saving....';">
								<div class="form-group">
					          			<label for="inputuser">Name</label>
					            			<input type="text" class="form-control" id="inputname" placeholder="Enter your Name" name="name" required>
				          			</div>
								<div class="form-group">
					          			<label for="inputcode">Code</label>
					            			<input type="text" class="form-control" id="inputcode" placeholder="Enter any Random text, for us to identify you" name="code" required>
				          			</div>
								<button type="submit" id="donatedisable" name="donate" class="btn btn-success m-2">Save</button>
								<a class="btn btn-danger m-2" href="../index.php" role="button">cancel</a>
							</form>
						</div>
					</div>
					<div class="col-md-6 col-md-3">
						<!--<img src="donate.jpg" class="res-img" alt="PHONE PE QR CODE">-->
					</div>
				 </div>
			</div>

		</div>-->
	<?php } else if($main=="yes") { ?>
	
		<div class="container">
			<h4 class="mt-4 responsive-md text-center">Lend a Helping Hand.</h4>
			<h6 class="text-muted text-center">A Non-profit Organization.</h6>
      			<br>
			<div class="row">
				<div class="col-12 col-sm-6 text-center mb-4">
					<a class="btn btn-dark res-mar res-pad rounded-pill" href="#" role="button" style="background-color:purple;"><i class="fa fa-hand-holding-heart mr-2"></i>Donate to NGOs helping on the ground</a>  
					<p><i class="fa fa-grip-lines-vertical mt-1 mb-1"></i></p>
					<p class="mt-2">All proceeds go towards helping anyone in need of financial help to fund thier covid medical expenses.</p>
				</div>
				<div class="col-12 col-sm-6 text-center mb-4">
					<a class="btn btn-dark res-mar res-pad rounded-pill" href="donate.php?dev=yes" role="button" style="background-color:purple;"><i class="fa fa-hand-holding-heart mr-2"></i>Donate to the Developers</a>	
					<p><i class="fa fa-grip-lines-vertical mt-1 mb-1"></i></p>
					<p class="mt-2">So we can continue improving this platform, in its reach, performance and usability.</p>
				</div>
			</div>
			
		</div>
	<?php } else if($dev=="yes") { ?>
		<div class="text-center">
      			<p class="mt-2">So we can continue improving this platform, in its reach, performance and usability.</p>
			<h6 class="text-center">UPI ID</h6>
			<h5><span class="font-weight-bold">manoja279@upi</span></h5>
			<!--<a class="btn btn-primary m-2" href="donate.php?anonymous=no" role="button">Donate</a>     
     			<a class="btn btn-primary m-2" href="donate.php?anonymous=yes" role="button">Donate Anonymously</a>--> 
    		</div>
	<?php } ?>	
    
    
  
</body>

<style>
    /*Media Queries*/
	@media (min-width:320px)  { .responsive-md{font-size:24px;} .responsive-lg{font-size:32px;} .responsive-tx{font-size:12px;} .res-pad{padding:10px;} .res-mar{margin:8px;}  /* smartphones, iPhone, portrait 480x320 phones */ }
	@media (min-width:481px)  { .responsive-md{font-size:32px;} .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
    	@media (min-width:641px)  { .responsive-md{font-size:32px;} .responsive-lg{font-size:64px;}  .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
	@media (min-width:961px)  { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} /* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} /* big landscape tablets, laptops, and desktops */ }
	@media (min-width:1281px) { .responsive-md{font-size:32px;}  .responsive-lg{font-size:64px;} .responsive-tx{font-size:16px;} .res-pad{padding:20px;} .res-mar{margin:16px;} /* hi-res laptops and desktops */ }
	
</style>
