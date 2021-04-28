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
	
		$state_id = Array();
		$state_name = Array();
		$state_res = $con->query("select * from state");
		while($state_ele = $state_res->fetch_assoc())
		{
			$state_id[]=$state_ele['state_id'];
			$state_name[]=$state_ele['state_name'];	
		}
	
		$cc = count($state_id);
	
	
		$tag_name = Array();
		$tag_id = Array();
		$tag_res = $con->query("select * from tag");
		while($tag_ele = $tag_res->fetch_assoc())
		{
			$tag_id[]=$tag_ele['tag_id'];
			$tag_name[]=$tag_ele['tag_name'];	
		}
	
		$tt = count($tag_id);
	
	?>
	
	
	<div class="container">
	<form class="row d-flex justify-content-center p-4" method="POST" action="filter.php">
  		<div class="col-12 col-sm-3 text-center">
			<label for="inputuser">State</label>
    			<select class="form-control" id="state" name="state" required>
				<option value="0" selected>All</option>
				<?php for($i=0;$i<$cc;$i++) { ?>
					<option value="<?=$state_id[$i]?>"><?=$state_name[$i]?></option>
				<?php } ?>
    			</select>
		</div>	

		<div class="col-12 col-sm-3 text-center">
			<label for="inputuser">City</label>
    			<select class="form-control" id="city" name="city" required>
				<option value="0" selected>All</option>
    			</select>
		</div>	

		<div class="col-12 col-sm-3 text-center">
			<label for="inputuser">Need</label>
    			<select class="form-control" id="need" name="need" onchange='this.form.submit()'>
				<option value="1" selected>All</option>
				<?php for($i=0;$i<$tt;$i++) { ?>
					<option value="<?=$tag_id[$i]?>"><?=$tag_name[$i]?></option>
				<?php } ?>
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
  

<script type="text/javascript">
	$(document).ready(function(){
			$("#state").change(function(){
				var sid = $("#state").val();
				$.ajax({
					url: 'filter_config.php',
					method: 'post',
					data: 'sid=' + sid
				}).done(function(city){
					console.log(city);
					city = JSON.parse(city);
					$('#city').empty();
					city.forEach(function(c){
						$('#city').append('<option>' + c + '</option>')
					})
				})
			})
		})
</script>

<style>
    /*Media Queries*/
	@media (min-width:320px)  { .responsive-md{font-size:8px;}  /* smartphones, iPhone, portrait 480x320 phones */ }
	@media (min-width:481px)  { .responsive-md{font-size:12px;}  /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
    	@media (min-width:641px)  { .responsive-md{font-size:12px;}  /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
	@media (min-width:961px)  { .responsive-md{font-size:12px;}  /* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .responsive-md{font-size:12px;}  /* big landscape tablets, laptops, and desktops */ }
	@media (min-width:1281px) { .responsive-md{font-size:12px;}  /* hi-res laptops and desktops */ }
	
</style>

