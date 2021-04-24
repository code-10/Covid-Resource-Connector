<?php include_once '../header.php'; session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php

   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;		

?>

<?php

    $con = getCon();

    if(isset($_POST['create_post'])){

    $email = $_POST['email'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $description = $_POST['description'];
    $phone_number = $_POST['phonenumber'];
    $request_resource = $_POST['request_resource'];

    $res = $con->query("insert into post(email,state,city,description,ph_no,request_resource) values('".mysqli_real_escape_string($con,$email)."','".mysqli_real_escape_string($con,$state)."','".mysqli_real_escape_string($con,$city)."','".mysqli_real_escape_string($con,$description)."','$phone_number','$request_resource')"); 
       
    header("Location:requests.php");
    die();

    }
?>
