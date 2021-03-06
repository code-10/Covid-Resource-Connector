<?php include_once '../header.php';
session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php
authentication_required();

$visit = $_SERVER['REQUEST_URI'];
$visit = substr($visit, 1);

$_SESSION['visit'] = $visit;
$email = $_SESSION['email'];

$post_id = $_GET['post_id'];
if(!$post_id)
    die("No post id given");

$con = getCon();

	if($email === 'groot@gmail.com')
            $post_details = $con->query("select * from post where post_id='$post_id'")->fetch_assoc(); // if admin, ignore email
        else
            $post_details = $con->query("select * from post where post_id='$post_id' and email='$email'")->fetch_assoc(); // if not admin, check if owner of post is modifying


//$post_details = $con->query("select * from post where post_id='$post_id' and email='$email'")->fetch_assoc();

if($post_details === NULL)
    die("Problem With Post Id")

?>

<body style="font-family:'Poppins', sans-serif;">


    <?php include_once "../navBar.php"; ?>
    <?php

    $con = getCon();

    $state = array();
    $state_res = $con->query("select * from state");
    while ($state_ele = $state_res->fetch_assoc())
        $state[] = $state_ele['state_name'];
    $state_count = count($state);


    $city = array();
    $city_res = $con->query("select * from city");
    while ($city_ele = $city_res->fetch_assoc())
        $city[] = $city_ele['city_name'];
    $city_count = count($city);
    
    
    
    $tag_id = Array();
		$tag_name = Array();
	
		$tag_res = $con->query("select * from tag");
		while($tag_ele = $tag_res->fetch_assoc())
		{
			$tag_id[] = $tag_ele['tag_id'];
			$tag_name[] = $tag_ele['tag_name'];	
		}
	
		$tag_count = count($tag_id);

	
	$needs_mod=Array();
	$needs_res = $con->query("select * from needs where post_id='$post_id'");	
	while($needs_ele = $needs_res->fetch_assoc())
	{
		$needs_mod[] = $needs_ele['tag_id'];
	}
	
	
    ?>


    <h4 class="m-4 text-center">Modifying a post</h4>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 col-md-3">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-12">

                        <form id="login-form" method="POST" action="verify_post.php" style="display: block;" onsubmit="document.getElementById('modifydisable').disabled=true;document.getElementById('modifydisable').innerText = 'Saving....';">
                            <!-- <div class="form-group">
                                <label for="inputuser">First Name</label>
                                <input type="text" class="form-control" id="inputfirst_name" placeholder="firstname" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="inputuser">Last Name</label>
                                <input type="text" class="form-control" id="inputfirst_name" placeholder="lastname" name="last_name" required>
                            </div> -->
                            <div class='form-group'>
                                <label for="request_resource">
                                    What Kind of Post is This?
                                </label>
                                <select class="form-control" name="request_resource" id="request_resource">
                                    <option value="0" <?= $post_details['request_resource'] === 0 ? "selected" : "" ?> > I Need Help </option>
                                    <option value="1" <?= $post_details['request_resource'] === 1 ? "selected" : "" ?>> I Want to Help </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputuser">State</label>
                                <select class="form-control" id="state" name="state">
                                    <?php for ($j = 0; $j < $state_count; $j++) { ?>
                                        <option value="<?= $state[$j] ?>" <?= $post_details['state'] === $state[$j] ? "selected" : "" ?>> 
                                            <?= $state[$j] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputuser">city</label>
                                <select class="form-control" id="city" name="city">
                                    <?php for ($j = 0; $j < $city_count; $j++) { ?>
                                        <option value="<?= $city[$j] ?>" <?= $post_details['city'] === $city[$j] ? "selected" : "" ?>>
                                            <?= $city[$j] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
								<label for="inputuser">Need</label>
    					        <!--<select class="form-control" id="tag" name="tag_id">
                              	    <?php for($k=0;$k<$tag_count;$k++) { ?>
					      			    <option value="<?=$tag_id[$k]?>"><?=$tag_name[$k]?></option>
							        <?php } ?>
    					        </select>-->
							</div>
				
				
				
				
				
				
						<div class="form-group">
							<?php for($k=0;$k<$tag_count;$k++) { ?>
								<label class="p-2"><input type="checkbox" class="m-2" name="needs[]" value="<?=$tag_id[$k]?>" <?php if(in_array($tag_id[$k], $needs_mod)) { ?> checked <?php } ?>><?=$tag_name[$k]?></label>
							<?php } ?>
						</div>		
				
				
				
				
				
				

                            <div class="form-group">
                                <label for="inputdescription">Description</label>
				<textarea maxlength="3000" class="form-control" id="exampleFormControlTextarea" rows="4" name="description" required><?= $post_details['description'] ?></textarea>
                                <!--<input type="text" class="form-control" id="inputdescription" placeholder="description" name="description" value="<?= $post_details['description'] ?>" required>-->
                            </div>

                            <div class="form-group">
                                <label for="inputphonenumber">Phone Number</label>
                                <input type="number" class="form-control" id="inputphonenumber" placeholder="phonenumber" name="phonenumber" value="<?= $post_details['ph_no'] ?>"  required>
                            </div>
                            
                            <input type="hidden" name="modify">
                            <input type="hidden" name="post_id" value="<?= $post_id ?>">

                    </div>
                    <button type="submit" name="create_post" id="modifydisable" class="btn btn-success m-2">Modify</button>
                        <a class="btn btn-danger m-2" href="/" role="button">cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>

    <br><br><br><br>






</body>
