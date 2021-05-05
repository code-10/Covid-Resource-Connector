<?php session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php
    authentication_required();
   $visit = $_SERVER['HTTP_REFERER'];
  	$visit1 = substr($visit,1);

  	$_SESSION['visit'] = $visit1;		
    $email = $_SESSION['email'];

?>

<?php

    $con = getCon();
  
    if(isset($_SESSION['email']))
    {
        $post_id = $_GET['post_id'];
        $con->query("delete from post where post_id='$post_id' and email='$email'");
        header("Location:$visit");
        die();
    }

?>
