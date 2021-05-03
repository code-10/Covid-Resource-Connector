<?php include_once '../header.php'; session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php
	authentication_required();

   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;


 	if(!(isset($_SESSION['email'])))
      	{
            header("Location:../sign_in/google_sign_in.php");
            die(); 
      	} 		

?>

<body>

   
	<?php include_once "../navBar.php"; ?>
	<?php
	
		$con = getCon();
	
		$state=Array();
		$state_res = $con->query("select * from state");
		while($state_ele = $state_res->fetch_assoc())
			$state[]=$state_ele['state_name'];
		$state_count = count($state);
	
	
		$city=Array();
		$city_res = $con->query("select * from city");
		while($city_ele = $city_res->fetch_assoc())
			$city[]=$city_ele['city_name'];
		$city_count = count($city);
	

		
	
	?>
   
   
	<?php
	
		//for tag
		$tag_id = Array();
		$tag_name = Array();
	
		$tag_res = $con->query("select * from tag");
		while($tag_ele = $tag_res->fetch_assoc())
		{
			$tag_id[] = $tag_ele['tag_id'];
			$tag_name[] = $tag_ele['tag_name'];	
		}
	
		$tag_count = count($tag_id);
	
	
	?>
	
	
   <h4 class="m-4 text-center">Creating a post to request for resource</h4>
   
   <div class="container">
    	<div class="row d-flex justify-content-center">
			<div class="col-md-6 col-md-3">
   					<div class="row d-flex justify-content-center">
							<div class="col-lg-12">
								
								<form id="createPost" method="POST" action="verify_post.php" style="display:block;" onsubmit="document.getElementById('createdisable').disabled=true;document.getElementById('createdisable').innerText = 'Saving....';">
								<div class="form-group">
					          <label for="inputuser">First Name</label>
					            <input type="text" class="form-control" id="inputfirst_name" placeholder="FIRST NAME" name="first_name" required>
				          </div>
								<div class="form-group">
									<label for="inputuser">Last Name</label>
					            <input type="text" class="form-control" id="inputfirst_name" placeholder="LAST NAME" name="last_name" required>
				          </div>
						  <div class='form-group'>
			   					<label for="request_resource">
			   						What Kind of Post is This?
								</label>
			   					<select class="form-control" name="request_resource" id="request_resource">
			   						<option value="0" <?= $_GET['request']?> > I Need Help	</option>
			   						<option value="1" <?= $_GET['resource']?> > I Want to Help	</option>
								</select>
						  </div>
									
						<div class="form-group">
							<label for="inputuser">State</label>
    					<select class="form-control" id="state" name="state">
							<option selected disabled>select state</option>
                              				<?php for($j=0;$j<$state_count;$j++) { ?>
					      			<option value="<?=$state[$j]?>"><?=$state[$j]?></option>
							<?php } ?>
    					</select>
									</div>
									
									
									
							<div class="form-group">
								<label for="inputuser">city</label>
    					<select class="form-control" id="city" name="city">
							<option selected disabled>select city</option>
                              				<?php for($j=0;$j<$city_count;$j++) { ?>
					      			<option value="<?=$city[$j]?>"><?=$city[$j]?></option>
							<?php } ?>
    					</select>
									</div>
								
									
						<div class="form-group">
								<label for="inputuser">Need</label>
    					<select class="form-control" id="tag" name="tag_id">
                              				<?php for($k=0;$k<$tag_count;$k++) { ?>
					      			<option value="<?=$tag_id[$k]?>"><?=$tag_name[$k]?></option>
							<?php } ?>
    					</select>
									</div>		
									
									
								
									
									
						<div class="form-group">
							<?php for($k=0;$k<$tag_count;$k++) { ?>
								<input type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off">
								<label class="btn btn-outline-success btn-sm" for="btn-check-outlined"></label><br>	
							<?php } ?>
						</div>		
									
									
									
									
									
									
                                
                                <div class="form-group">
					          <label for="inputdescription">Description</label>
								<textarea maxlength="256" class="form-control" id="exampleFormControlTextarea" rows="4" name="description"></textarea>
					            <!--<input type="text" class="form-control" id="inputdescription" placeholder="description" name="description" required>-->
				          </div>
                                
                                 <div class="form-group">
					          <label for="inputphonenumber">Phone Number</label>
					            <input type="number" class="form-control" id="inputphonenumber" placeholder="PHONE NUMBER" name="phonenumber" required>
				          </div>
                                <?php $email = $_SESSION['email']; ?>
                                <div class="form-group m-2 col-12">
									    <input type="hidden" name="email" value="<?=$email?>" />
  								</div>
                                
									</div>
					            <button type="submit" id="createdisable" name="create_post" class="btn btn-success m-2">Create Post</button>
								<a class="btn btn-danger m-2" href="../index.php" role="button">cancel</a>
								</form>
								
							</div>
						</div>
   				</div>
		</div>
   </div>
   
<br><br><br><br>
   



  


   
<script type="text/javascript">
	$(document).ready(function(){
			$("#state").change(function(){
				var sname = $("#state").val();
				$.ajax({
					url: 'filter_config.php',
					method: 'post',
					data: 'sname=' + sname
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
	
	
	
	
	$(document).ready(function () {
    		document.getElementById('createPost').reset();
	});
</script>

   
   
   
</body>
  
