<?php include_once '../header.php'; ?>
<?php include_once '../libraries/shield.php'; ?>
<?php session_start(); ?>
<?php $email = $_SESSION['email']; ?>
<?php $con = getCon(); ?>
<?php include_once './post_card.php'; ?>

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
            <?php if(isset($_SESSION['email'])){
                    echo '<a href="#" class="nav-item nav-link active"><i class="fa fa-user-o"> '.$_SESSION['email'].'</i></a>';
                    echo '<a href="../sign_in/logout.php" class="nav-item nav-link">Logout</a>';
                }
                else{
                    echo '<a href="../sign_in/sign_in.php" class="nav-item nav-link">Sign in</a>';
                }
            ?>
        </div>
    </div>
</nav>
    
    
  <!--profile-->
    <div class="p-4">
		<div class="row m-4 d-flex justify-content-center">
            <?php 
		     if(isset($_SESSION['email'])&&($email=="groot@gmail.com")){
                      
                        $my_posts_res = $con->query("select p.post_id,p.upvotes,p.downvotes,p.ph_no,p.description,p.state,p.city,p.post_id,p.first_name,p.last_name,p.time,p.email from post as p where p.email!='$email' order by time asc,upvotes asc,downvotes desc;");
                        $postComp = "";
			while($data = $my_posts_res->fetch_assoc()) {
				$postComp = renderUserPost($data, 'admin',$email); 
		                echo $postComp;
	                }
                    }
                    else if(isset($_SESSION['email'])&&(!(isset($_SESSION['simple'])))){ 
                      
                        $user=$_SESSION['user_first_name'];
                        $user[0]=strtoupper($user[0]);
                      
                        $last_name=$_SESSION['last_name'];
                        $last_name[0]=strtoupper($last_name[0]);
                        
                        echo '<h1 class="display-6 mb-2"> <i class="fa fa-user-circle-o" style="color:white;"></i>  '.$user.' '.$last_name.' </h1>';
                        echo '<a href="#" class="nav-item nav-link active" style="color:black;"><i class="fa fa-envelope"> '.$_SESSION['email'].'</i></a>';
                    }
                    else if(isset($_SESSION['email'])&&(isset($_SESSION['simple']))){ 
                        
                        $email = $_SESSION['email'];
                      
                        $con = getCon();
                        $first_name = Array();
                        $last_name = Array();
                        
                        $profile_res = $con->query("select * from user where email='$email'");
                        while($profile_ele = $profile_res->fetch_assoc())
                        {
                            $first_name[]=$profile_ele['first_name'];
                            $last_name[]=$profile_ele['last_name'];
                        }
                      
                        $d_first_name = $first_name[0];
                        $d_first_name[0]=strtoupper($d_first_name[0]);
                        $d_last_name = $last_name[0];
                        $d_last_name[0]=strtoupper($d_last_name[0]);
                      
                        echo '<h1 class="display-6 mb-2"> <i class="fa fa-user-circle-o" style="color:white;"></i>  '.$d_first_name.' '.$d_last_name.' </h1>';
                        echo '<a href="#" class="nav-item nav-link active" style="color:black;"><i class="fa fa-envelope"> '.$_SESSION['email'].'</i></a>';
                    }
                    else
                    {
                        header("Location:../index.php");
                        die();
                    }
            ?>
		</div>	
        </div>
