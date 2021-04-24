<?php include_once '../header.php'; session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php

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
   <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="../index.php" class="navbar-brand">CRC</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
         <div class="navbar-nav">
            <a href="../index.php" class="nav-item nav-link">Home</a>
            <a href="about.php" class="nav-item nav-link">About</a>
         </div>
         <div class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['email'])) {
               echo '<a href="profile.php" class="nav-item nav-link active"><i class="fa fa-user-o">  '.$_SESSION['email'].'</i></a>';
               echo '<a href="../sign_in/logout.php" class="nav-item nav-link">Logout</a>';
               }
               ?>
         </div>
      </div>
   </nav>
   
	
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
								
								<form  id="login-form" method="POST" action="verify_create_request.php" style="display: block;">
								<div class="form-group">
					          <label for="inputuser">First Name</label>
					            <input type="text" class="form-control" id="inputfirst_name" placeholder="firstname" name="first_name" required>
				          </div>
								<div class="form-group">
									<label for="inputuser">Last Name</label>
					            <input type="text" class="form-control" id="inputfirst_name" placeholder="lastname" name="last_name" required>
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
					            <input type="number" min="100000000" max="9999999999" class="form-control" id="inputphonenumber" placeholder="phonenumber" name="phonenumber" required>
				          </div>
                                <?php $email = $_SESSION['email']; ?>
                                <div class="form-group m-2 col-12">
									    <input type="hidden" name="email" value="<?=$email?>" />
  								</div>
                                
									</div>
					            <button type="submit" name="create_request" class="btn btn-success m-2">Create Request</button>
								<a class="btn btn-danger m-2" href="../index.php" role="button">cancel</a>
								</form>
								
							</div>
						</div>
   				</div>
		</div>
   </div>
   
<br><br><br><br>
   
   
   
   
   
   
</body>
  
