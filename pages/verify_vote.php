  
<?php include_once '../header.php'; session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php

   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;		

?>

<?php

    $con = getCon();
        
    if(isset($_SESSION['email'])){
        
        $email = $_SESSION['email'];
        $post_id = $_GET['post_id'];
        $vote = $_GET['vote'];
        
        if($vote=="up")
           $vote=1;
        else if($vote=="down")
           $vote=0;
      
        $con->query("insert into updownvote(email,post_id,upordown) values('".mysqli_real_escape_string($con,$email)."','".mysqli_real_escape_string($con,$post_id)."','".mysqli_real_escape_string($con,$vote)."')");
    }
?>
