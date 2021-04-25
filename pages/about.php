<?php include_once '../header.php'; session_start(); ?>
<?php

   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

?>

<body>
   <?php include_once "../navBar.php"; ?>
</body>
  
