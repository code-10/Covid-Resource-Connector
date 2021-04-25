<?php include_once '../header.php'; session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php

   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;		

?>

<?php

    $con = getCon();
  
    if(isset($_SESSION['email']))
    {
        $post_id = $_GET['post_id'];
        $con->query("delete from post where post_id='$post_id'");
        header("Location:requests.php");
        die();
    }

?>
