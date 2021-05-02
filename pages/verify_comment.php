<?php include_once '../header.php'; session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php
    authentication_required();
   $visit = $_SERVER['HTTP_REFERER'];
  	$visit1 = substr($visit,1);

  	$_SESSION['visit'] = $visit1;		

?>

<?php

    $con = getCon();
        
    if(isset($_POST['add_comment'])){
     
        $comment = $_POST['comment'];
        $email = $_SESSION['email'];
        $post_id = $_POST['post_id'];
      
        $res = $con->query("insert into comment(post_id,comment,email) values('".mysqli_real_escape_string($con,$post_id)."','".mysqli_real_escape_string($con,$comment)."','".mysqli_real_escape_string($con,$email)."')"); 
       
        header("Location:$visit");
        die();
         
    }

?>
