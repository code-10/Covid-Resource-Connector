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
						<img src="donate.jpg" class="res-img" alt="PHONE PE QR CODE">
					</div>
				 </div>
			</div>

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
	@media (min-width:481px)  { .res-img{width:50%;height:100%;} /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
   @media (min-width:641px)  { .res-img{width:50%;height:100%;} /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
	@media (min-width:961px)  { .res-img{width:50%;height:100%;} /* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .res-img{width:50%;height:100%;} /* big landscape tablets, laptops, and desktops */ }
	@media (min-width:1281px) { .res-img{width:50%;height:100%;} /* hi-res laptops and desktops */ }
	
</style>
