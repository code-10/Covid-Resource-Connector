<?php include_once '../header.php'; session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
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
      
      if(isset($_SESSION['email'])){	
	
      $email = $_SESSION['email'];

      $phone_number = Array();
      $description = Array();
      $state = Array();
      $city = Array();
      $post_id = Array();
      $first_name = Array();
      $last_name = Array();
      $time = Array();	
      $tag_name = Array();	      
      $upvotes = Array();
	      
      //$my_posts_res = $con->query("select * from post where email='$email' and request_resource='$request_resource' ORDER BY time ASC, upvotes desc, downvotes asc");
      $my_posts_res = $con->query("select p.upvotes,p.ph_no,p.description,p.state,p.city,p.post_id,p.first_name,p.last_name,p.time,t.tag_name from post as p,tag as t where t.tag_id=p.tag_id and email='$email' and request_resource='$request_resource' ORDER BY time ASC, upvotes desc, downvotes asc");
   
	      
	      
      while($my_posts_ele = $my_posts_res->fetch_assoc())
      {
            $phone_number[] = $my_posts_ele['ph_no'];
            $description[] = $my_posts_ele['description'];
            $state[] = $my_posts_ele['state'];
            $city[] = $my_posts_ele['city'];  
	    $post_id[] = $my_posts_ele['post_id'];
	    $first_name[] = $my_posts_ele['first_name'];
	    $last_name[] = $my_posts_ele['last_name'];
	    $time[] = $my_posts_ele['time'];
	    $tag_name[] = $my_posts_ele['tag_name'];
	    $upvotes[] = $my_posts_ele['upvotes'];
      }
   
      $c = count($state);
	    
	      
   ?>
   
   
   <h4 class="m-4 text-center">My posts</h4>

   <div class="row m-4 d-flex justify-content-center">
			<?php for($i=0;$i<$c;$i++) { ?>
				<div class="col-12 col-sm-4 m-2">
					<div class="card">
  						<h5 class="card-header p-3">
						  <?=$first_name[$i]?>&nbsp<?=$last_name[$i]?>&nbsp
							<?php if($upvotes[$i]>100) { ?>
								<span class="badge badge-pill badge-success">Verified <i class="fa fa-check-circle" aria-hidden="true" style="color:white;"></i></span>
							<?php } ?>
						  <a href="delete_post.php?post_id=<?=$post_id[$i]?>"><i class="fa fa-trash" aria-hidden="true" style="color:red;"></i></a>&nbsp
						  <a href="modify_post.php?post_id=<?=$post_id[$i]?>"><i class="fa fa-edit" aria-hidden="true" style="color:green;"></i></a>&nbsp
						  <span class="badge badge-pill badge-info"><?=$tag_name[$i]?></span>
						</h5>
  						<div class="card-body p-3">
							<h5 class="card-title"><?=$city[$i]?>, <?=$state[$i]?></h5>
    							<p class="card-text">Description: <?=$description[$i]?></p>
							<p class="card-text mb-2">Mob: <?=$phone_number[$i]?></p>
							<p class="text-muted mb-0 responsive-md"><?=$email?></p>
							<p class="text-muted mb-2 responsive-md"><?=$time[$i]?></p>
							<!--<p class="card-text"><i class="fa fa-arrow-up" aria-hidden="true" style="color:green;font-size:24px;"></i>&nbsp&nbsp<i class="fa fa-arrow-down" aria-hidden="true" style="color:red;font-size:24px;"></i></p>-->
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
      $upvotes_e = Array();
      $downvotes_e = Array();
      $time_e = Array();
      $tag_name_e = Array();
	
      $e_posts_res = $con->query("select t.tag_name,p.time,p.upvotes,p.downvotes,p.post_id,p.description,p.state,p.city,p.time,p.ph_no,p.email,p.first_name,p.last_name from post as p,tag as t,user as u where u.email=p.email and p.tag_id=t.tag_id and p.email!='$email' and p.request_resource='$request_resource' order by time asc, upvotes desc, downvotes asc");
   
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
	    $upvotes_e[] = $e_posts_ele['upvotes'];
     	    $downvotes_e[] = $e_posts_ele['downvotes'];
	    $time_e[] = $e_posts_ele['time'];
	    $tag_name_e[] = $e_posts_ele['tag_name'];;
      }
   
      $ce = count($state_e);
	
?>
	
	<h4 class="m-4 text-center">People's posts</h4>
   <div class="row m-4 d-flex justify-content-center">
			<?php for($i=0;$i<$ce;$i++) { ?>
				<div class="col-12 col-sm-4 m-2">
					<div class="card">
						
						
  						<h5 class="card-header p-3"><?=$first_name_e[$i]?>&nbsp<?=$last_name_e[$i]?>&nbsp
							<?php if($upvotes_e[$i]>100) { ?>
								<span class="badge badge-pill badge-success">Verified <i class="fa fa-check-circle" aria-hidden="true" style="color:white;"></i></span>
							<?php } ?>
							<span class="badge badge-pill badge-info"><?=$tag_name_e[$i]?></span>
						</h5>
  						<div class="card-body p-3">
							<h5 class="card-title"><?=$city_e[$i]?>, <?=$state_e[$i]?></h5>
    							<p class="card-text">Description: <?=$description_e[$i]?></p>
							<p class="card-text mb-2">Mob: <?=$phone_number_e[$i]?></p>
							<p class="text-muted mb-0 responsive-md"><?=$email_e[$i]?></p>
							<p class="text-muted mb-2 responsive-md"><?=$time_e[$i]?></p>
							
							<?php if($_SESSION['email']) { ?>
								<p class="card-text"><a href="verify_vote.php?post_id=<?=$post_id_e[$i]?>&&vote=up"><i class="fa fa-arrow-up" aria-hidden="true" style="color:green;font-size:24px;"></i></a>&nbsp<?=$upvotes_e[$i]?>&nbsp&nbsp<a href="verify_vote.php?post_id=<?=$post_id_e[$i]?>&&vote=down"><i class="fa fa-arrow-down" aria-hidden="true" style="color:red;font-size:24px;"></i></a>&nbsp<?=$downvotes_e[$i]?></p>
							<?php } else { ?>
								<p class="card-text"><a href="../sign_in/google_sign_in.php"><i class="fa fa-arrow-up" aria-hidden="true" style="color:green;font-size:24px;"></i></a>&nbsp<?=$upvotes_e[$i]?>&nbsp&nbsp<a href="../sign_in/google_sign_in.php"><i class="fa fa-arrow-down" aria-hidden="true" style="color:red;font-size:24px;"></i></a>&nbsp<?=$downvotes_e[$i]?></p>
							<?php } ?>
							
							
						
							<?php if(isset($_SESSION['email'])) { ?>
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter<?=$post_id_e[$i];?>">
  								Add a Comment
							</button>
							<?php } ?>	
							
							
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalLong<?=$post_id_e[$i];?>">
  								View Comments
							</button>
							
							
							
							
						<!-- Modal -->
						<div class="modal fade" id="exampleModalCenter<?=$post_id_e[$i];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
 				 								<textarea maxlength="100" class="form-control" id="exampleFormControlTextarea5" rows="4" name="comment"></textarea>
											</div>
											
											<input type="hidden" name="post_id" value="<?php echo $post_id_e[$i];?>" />
										
											<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		                  					<button type="submit" name="add_comment" class="btn btn-success">Add</button>
										</form>
										
      								</div>
    							</div>
  							</div>
						</div>
						<!--add comment-->
							
							
							
							
							
						<?php
							
							$comment = Array();
							$email = Array();
							$time = Array();
						    $comment_id =Array();
							$comment_res = $con->query("select * from comment where post_id='$post_id_e[$i]'");
							while($comment_ele = $comment_res->fetch_assoc())
							{
								$comment_id[]=$comment_ele['comment_id'];
								$comment[] = $comment_ele['comment'];
								$email[] = $comment_ele['email'];
								$time[] = $comment_ele['time'];
							}
							
							$cc = count($comment);
							
						?>
							
						<!--view comments-->
						<div class="modal fade" id="exampleModalLong<?=$post_id_e[$i]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
											<p class="text-monospace mb-1">
												<?php if($user_email==$email[$k]) { ?>
													<a href="delete_comment.php?comment_id=<?=$comment_id[$k]?>"><i class="fa fa-trash" aria-hidden="true" style="color:red;"></i></a>&nbsp
												<?php } ?><?=$comment[$k]?>
											</p> 
											<p class="font-weight-light mb-0 responsive-md"><?=$email[$k]?></p>
											<p class="font-weight-light mb-4 responsive-md"><?=$time[$k]?></p>
										<?php } ?>
										
      									</div>
									
									
      									<div class="modal-footer p-1">
        									<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
	@media (min-width:481px)  { .responsive-md{font-size:12px;}  /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
    	@media (min-width:641px)  { .responsive-md{font-size:12px;}  /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
	@media (min-width:961px)  { .responsive-md{font-size:12px;}  /* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .responsive-md{font-size:12px;}  /* big landscape tablets, laptops, and desktops */ }
	@media (min-width:1281px) { .responsive-md{font-size:12px;}  /* hi-res laptops and desktops */ }
	
</style>

