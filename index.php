<?php include_once 'header.php'; ?>
<?php include_once 'libraries/shield.php'; ?>

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
            <?php if(isset($_SESSION['user_name'])) {
               echo '<a href="profile.php" class="nav-item nav-link active"><i class="fa fa-user-o">  '.$_SESSION['user_name'].'</i></a>';
               echo '<a href="../sign_in/logout.php" class="nav-item nav-link">Logout</a>';
               }
               else{
               echo '<a href="../sign_in/sign_in.php" class="nav-item nav-link">Sign in</a>';
               }
               ?>
         </div>
      </div>
   </nav>
	
		<?php $c=10; ?>
	
		<div class="row m-4">
			<?php for($i=0;$i<$c;$i++) { ?>
				<div class="col-12 col-sm-3 m-2">
					<div class="card">
  						<h5 class="card-header">Manoj</h5>
  						<div class="card-body">
    							<h5 class="card-title">Karnataka</h5>
    							<p class="card-text">Oxygen Cylinder</p>
							<p class="card-text">Area: Yelahanka</p>
							<p class="card-text">Request Description: Blood Plasma O+ve</p>
							<p class="card-text">Ph no: 9980712884</p>
  						</div>
					</div>
				</div>
			<?php } ?>
		</div>
  
</body>
