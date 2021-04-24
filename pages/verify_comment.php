<?php include_once '../header.php'; session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php

   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;		

?>

<?php

    $con = getCon();
        
    if(isset($_POST['add_comment'])){
     
        $comment = $_POST['comment'];
        $email = $_POST['email'];
        $post_id = $_POST['post_id'];
            
    }

?>
