<?php include_once '../header.php'; session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php include_once './post_card.php'; ?>

<?php
	$con = getCon();

   	$visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

	$user_email = $_SESSION['email'];

	$map_rr = [ 'request' => 0, 'resource' => 1];
	$request_resource = $map_rr[$_GET['type']];
	if(!$request_resource) #defaults to show only requests.
	  $request_resource = 0;

?>

<body>
	<?php include_once "../navBar.php"; ?>
	
	<?php
	
		$state = $con->query("select * from state")->fetch_assoc();
	
	?>
	
	
	<div class="container">
	<form class="row d-flex justify-content-center p-4" method="GET" action="filter.php">
  		<div class="col-12 col-sm-3 text-center">
			<label for="inputuser">State</label>
    			<select class="form-control" id="state" name="state">
				<option value="1" selected>All</option>
				<?php foreach($state as $s) { ?>
					<option value="<?=$s['state_id']?>" selected><?=$s['state_name']?></option>
				<?php } ?>
    			</select>
		</div>	

		<div class="col-12 col-sm-3 text-center">
			<label for="inputuser">City</label>
    			<select class="form-control" id="city" name="city">
				<option value="1" selected>All</option>
    			</select>
		</div>	

		<div class="col-12 col-sm-3 text-center">
			<label for="inputuser">Need</label>
    			<select class="form-control" id="need" name="need" onchange="this.form.submit()">
				<option value="1" selected>All</option>
    			</select>
		</div>	
	</form>
	</div>
	
	
	
	
	
	
    <?php
      if(isset($_SESSION['email'])){	
		  $email = $_SESSION['email'];
	?>


		<h4 class="m-4 text-center">My posts</h4>
		<div class="row m-4 d-flex justify-content-center">
			<?php 
				$con = getCon();
				$my_posts_res = $con->query("select p.upvotes,p.downvotes,p.ph_no,p.description,p.state,p.city,p.post_id,p.first_name,p.last_name,p.time,t.tag_name,p.email from post as p,tag as t where t.tag_id=p.tag_id and p.email='$email' and p.request_resource='$request_resource' ORDER BY time ASC, upvotes desc, downvotes asc");
				$postComp = "";
				while($data = $my_posts_res->fetch_assoc()) {
					$postComp = renderUserPost($data, 'user', $email); 
					echo $postComp;
				}
			?>
		</div>
	<?php } ?>

		<h4 class="m-4 text-center">People's posts</h4>
	
   <div class="row m-4 d-flex justify-content-center">
					<?php 
						$my_posts_res = $con->query("select p.upvotes,p.downvotes,p.ph_no,p.description,p.state,p.city,p.post_id,p.first_name,p.last_name,p.time,t.tag_name,p.email from post as p,tag as t where t.tag_id=p.tag_id and p.request_resource='$request_resource' and p.email!='$email' ORDER BY time ASC, upvotes desc, downvotes asc");
						$postComp = "";
						while($data = $my_posts_res->fetch_assoc()) {
							$postComp = renderUserPost($data, 'public',$email); 
							echo $postComp;
						}
        			?>
   </div>
</body>
  

<style>
    /*Media Queries*/
	@media (min-width:320px)  { .responsive-md{font-size:8px;}  /* smartphones, iPhone, portrait 480x320 phones */ }
	@media (min-width:481px)  { .responsive-md{font-size:12px;}  /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
    	@media (min-width:641px)  { .responsive-md{font-size:12px;}  /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
	@media (min-width:961px)  { .responsive-md{font-size:12px;}  /* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .responsive-md{font-size:12px;}  /* big landscape tablets, laptops, and desktops */ }
	@media (min-width:1281px) { .responsive-md{font-size:12px;}  /* hi-res laptops and desktops */ }
	
</style>

