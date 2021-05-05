<?php include_once '../header.php'; session_start(); ?>
<?php

   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

?>

<body>
   <?php include_once "../navBar.php"; ?>
  
    
    <div class="text-center">
      <h4 class="m-4">Donate if you want to support the developers and people in need of covid resources</h4>
      <img src="donate.jpg" class="rounded mx-auto d-block" alt="PHONE PE QR CODE">
    </div>
  
</body>

