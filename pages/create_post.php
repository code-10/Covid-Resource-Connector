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
   
   
   <h4 class="m-4 text-center">Creating a post to request for resource</h4>
   
   <div class="container">
    	<div class="row d-flex justify-content-center">
			<div class="col-md-6 col-md-3">
   					<div class="row d-flex justify-content-center">
							<div class="col-lg-12">
								
								<form  id="login-form" method="POST" action="verify_post.php" style="display: block;">
								<div class="form-group">
					          <label for="inputuser">First Name</label>
					            <input type="text" class="form-control" id="inputfirst_name" placeholder="firstname" name="first_name" required>
				          </div>
								<div class="form-group">
									<label for="inputuser">Last Name</label>
					            <input type="text" class="form-control" id="inputfirst_name" placeholder="lastname" name="last_name" required>
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
                              				<?php for($j=0;$j<$state_count;$j++) { ?>
					      			<option value="<?=$state[$j]?>"><?=$state[$j]?></option>
							<?php } ?>
    					</select>
									</div>
									
							<div class="form-group">
								<label for="inputuser">city</label>
    					<select class="form-control" id="city" name="city">
                              				<?php for($j=0;$j<$city_count;$j++) { ?>
					      			<option value="<?=$city[$j]?>"><?=$city[$j]?></option>
							<?php } ?>
    					</select>
									</div>
                                
                                <div class="form-group">
					          <label for="inputdescription">Description</label>
					            <input type="text" class="form-control" id="inputdescription" placeholder="description" name="description" required>
				          </div>
                                
                                 <div class="form-group">
					          <label for="inputphonenumber">Phone Number</label>
					            <input type="number" class="form-control" id="inputphonenumber" placeholder="phonenumber" name="phonenumber" required>
				          </div>
                                <?php $email = $_SESSION['email']; ?>
                                <div class="form-group m-2 col-12">
									    <input type="hidden" name="email" value="<?=$email?>" />
  								</div>
                                
									</div>
					            <button type="submit" name="create_post" class="btn btn-success m-2">Create Post</button>
								<a class="btn btn-danger m-2" href="../index.php" role="button">cancel</a>
								</form>
								
							</div>
						</div>
   				</div>
		</div>
   </div>
   
<br><br><br><br>
   
   
   
   
   
   
</body>
  
