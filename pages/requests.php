<?php include_once '../header.php'; session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php

	$con = getCon();

   	$visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

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
            <a href="#" class="nav-item nav-link active">About</a>
         </div>
         <div class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['email'])) {
               echo '<a href="profile.php" class="nav-item nav-link active"><i class="fa fa-user-o">  '.$_SESSION['email'].'</i></a>';
               echo '<a href="../sign_in/logout.php" class="nav-item nav-link">Logout</a>';
               }
               else{
               echo '<a href="../sign_in/google_sign_in.php" class="nav-item nav-link">Sign in</a>';
               }
               ?>
         </div>
      </div>
   </nav>
  
  
  
  
   <?php
      
      if(isset($_SESSION['email'])){	
	
      $email = $_SESSION['email'];
      
      $phone_number = Array();
      $description = Array();
      $state = Array();
      $city = Array();
   
      $my_posts_res = $con->query("select * from post where email='$email' ORDER BY time ASC");
   
      while($my_posts_ele = $my_posts_res->fetch_assoc())
      {
            $phone_number[] = $my_posts_ele['ph_no'];
            $description[] = $my_posts_ele['description'];
            $state[] = $my_posts_ele['state'];
            $city[] = $my_posts_ele['city'];  
      }
   
      $c = count($state);
	      
      $first_name = Array();
      $last_name = Array();
	      
      $my_posts_res_fl = $con->query("select * from user where email='$email'");
      while($my_posts_ele_fl = $my_posts_res_fl->fetch_assoc())
      {
	      $first_name[] = $my_posts_ele_fl['first_name'];
	      $last_name[] = $my_posts_ele_fl['last_name'];
      }
	    
	      
   ?>
   
   
   <h4 class="m-4 text-center">My posts</h4>
   <div class="row m-4 d-flex justify-content-center">
			<?php for($i=0;$i<$c;$i++) { ?>
				<div class="col-12 col-sm-4 m-2">
					<div class="card">
  						<h5 class="card-header"><?=$first_name[0]?>&nbsp<?=$last_name[0]?>&nbsp<i class="fa fa-check-circle" aria-hidden="true" style="color:green;"></i></h5>
  						<div class="card-body">
							<h5 class="card-title"><?=$city[$i]?>, <?=$state[$i]?></h5>
    							<p class="card-text">Description: <?=$description[$i]?></p>
							<p class="card-text mb-2">Mob: <?=$phone_number[$i]?></p>
							<p class="card-text">Email: <?=$email?></p>
							<p class="card-text"><i class="fa fa-arrow-up" aria-hidden="true" style="color:green;font-size:24px;"></i>&nbsp&nbsp<i class="fa fa-arrow-down" aria-hidden="true" style="color:red;font-size:24px;"></i></p>
  						</div>
					</div>
				</div>
			<?php } ?>
		</div>
   
	
<?php } ?>	
	
	<?php
	
	
      $email = $_SESSION['email'];
      
      $phone_number_e = Array();
      $description_e = Array();
      $state_e = Array();
      $city_e = Array();
      $email_e = Array();
      $post_id_e = Array();
      $first_name_e = Array();
      $last_name_e = Array();
	
      $e_posts_res = $con->query("select p.post_id,p.description,p.state,p.city,p.time,p.ph_no,p.email,u.first_name,u.last_name from post as p,user as u where u.email=p.email order by time asc");
   
      while($e_posts_ele = $e_posts_res->fetch_assoc())
      {
            $phone_number_e[] = $e_posts_ele['ph_no'];
            $description_e[] = $e_posts_ele['description'];
            $state_e[] = $e_posts_ele['state'];
            $city_e[] = $e_posts_ele['city'];  
	    $email_e[] = $e_posts_ele['email'];
	    $post_id_e[] = $e_posts_ele['post_id'];
	    $first_name_e[] = $e_posts_ele['first_name'];
	    $last_name_e[] = $e_posts_ele['last_name'];
      }
   
      $ce = count($state_e);
	
	?>
	
	<h4 class="m-4 text-center">People's posts</h4>
   <div class="row m-4 d-flex justify-content-center">
			<?php for($i=0;$i<$ce;$i++) { ?>
				<div class="col-12 col-sm-4 m-2">
					<div class="card">
						
						
  						<h5 class="card-header"><?=$first_name_e[$i]?>&nbsp<?=$last_name_e[$i]?>&nbsp<i class="fa fa-check-circle" aria-hidden="true" style="color:green;"></i></h5>
  						<div class="card-body">
							<h5 class="card-title"><?=$city_e[$i]?>, <?=$state_e[$i]?></h5>
    							<p class="card-text">Description: <?=$description_e[$i]?></p>
							<p class="card-text mb-2">Mob: <?=$phone_number_e[$i]?></p>
							<p class="card-text">Email: <?=$email_e[$i]?></p>
							<p class="card-text"><i class="fa fa-arrow-up" aria-hidden="true" style="color:green;font-size:24px;"></i>&nbsp&nbsp<i class="fa fa-arrow-down" aria-hidden="true" style="color:red;font-size:24px;"></i></p>
						
						
							<?php if(isset($_SESSION['email'])) { ?>
							<button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#exampleModalCenter">
  								Add a Comment
							</button>
							<?php } ?>	
							
							
							<button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#exampleModalLong<?=$i?>">
  								View Comments
							</button>
							
							
							
							
						<!-- Modal -->
						<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  							<div class="modal-dialog modal-dialog-centered" role="document">
    							<div class="modal-content p-2">
      								<div class="modal-header">
        								<h5 class="modal-title" id="exampleModalLongTitle">Add your Comment</h5>
        								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          									<span aria-hidden="true">&times;</span>
        								</button>
      								</div>
      								<div class="modal-body">
										
       	 								<form  id="comment-form" method="POST" action="verify_comment.php" style="display:block;">
											<div class="form-group">
  												<label for="exampleFormControlTextarea5">Comment</label>
 				 								<textarea class="form-control" id="exampleFormControlTextarea5" rows="4" name="comment"></textarea>
											</div>
											
											<input type="hidden" name="post_id" value="<?=$post_id_e[$i]?>" />
										
											<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		                  					<button type="submit" name="add_comment" class="btn btn-success">Add</button>
										</form>
										
      								</div>
    							</div>
  							</div>
						</div>
						<!--add comment-->
							
							
							
							
							
						<?php
							
							$con = getCon();

							$comment = Array();
							$email = Array();
							$time = Array();
								
							$comment_res = $con->query("select * from comment where post_id='$post_id_e[$i]'");
							while($comment_ele = $comment_res->fetch_assoc())
							{
								$comment[] = $comment_ele['comment'];
								$email[] = $comment_ele['email'];
								$time[] = $comment_ele['time'];
							}
							
							$cc = count($comment);
							
						?>
							
						<!--view comments-->
						<div class="modal fade" id="exampleModalLong<?=$i?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  							<div class="modal-dialog" role="document">
    								<div class="modal-content">
      									<div class="modal-header">
        									<h5 class="modal-title" id="exampleModalLongTitle">Comments</h5>
        									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          										<span aria-hidden="true">&times;</span>
        									</button>
      									</div>
									
									
      									<div class="modal-body">
										
										<?php for($k=0;$k<$cc;$k++) { ?>
											<p class="text-monospace mb-1"><?=$comment[$k]?></p>
											<p class="font-weight-light mb-0 responsive-md"><?=$email[$k]?></p>
											<p class="font-weight-light mb-4 responsive-md"><?=$time[$k]?></p>
										<?php } ?>
										
      									</div>
									
									
      									<div class="modal-footer">
        									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      									</div>
    								</div>
  							</div>
						</div>			
				
						<!--view comments end-->
							
							
							
							
					
							
							
							
							
							
							
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
  
</body>
  

<style>
    /*Media Queries*/
	@media (min-width:320px)  { .responsive-md{font-size:8px;}  /* smartphones, iPhone, portrait 480x320 phones */ }
	@media (min-width:481px)  { .responsive-md{font-size:16px;}  /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
    	@media (min-width:641px)  { .responsive-md{font-size:16px;}  /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
	@media (min-width:961px)  { .responsive-md{font-size:16px;}  /* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .responsive-md{font-size:16px;}  /* big landscape tablets, laptops, and desktops */ }
	@media (min-width:1281px) { .responsive-md{font-size:16px;}  /* hi-res laptops and desktops */ }
	
</style>

