<?php include_once '../header.php'; session_start(); ?>
<?php

   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

?>

<body>
   <?php include_once "../navBar.php"; ?>
   
   
   <div class="text-center">
      <h4 class="m-2">Welcome to Covid Resource Connector, A Non-profit Website.</h4>
      <p class="m-2">Our Website connects the communication gap between people who want to help and people who want help regarding covid related queries.</p>
      <p class="m-2">We cannot guarantee the availability nor the validity of the post. Please be advised, verify before taking action.</p>
   </div>
</body>
  
