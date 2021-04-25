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
        $comment_id = $_GET['comment_id'];
        $con->query("delete from comment where comment_id='$comment_id'");
        header("Location:requests.php");
    }

?>
