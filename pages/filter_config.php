<?php

  include_once '../libraries/shield.php';
  session_start();

  $con = getCon();

  /*if(isset($_POST['sid'])) {

    $sid = $_POST['sid'];
	  
    $city = Array();
    $city_res = $con->query("select * from city where state_id='$sid'"); 
    while($city_ele = $city_res->fetch_assoc()){
        $city[] = $city_ele['city_name'];
    }
    
		echo json_encode($city);
	}*/

  if(isset($_POST['sname'])) {

    $sname = mysqli_real_escape_string($con,$_POST['sname']);
    //$need = mysqli_real_escape_string($con,$_POST['need']);  
	  
    $city = Array();
    $city_res = $con->query("select c.city_name from city as c, state as s where s.state_id=c.state_id and s.state_name='$sname'"); 
    while($city_ele = $city_res->fetch_assoc()){
        $city[] = $city_ele['city_name'];
    }
    
	  	//$_SESSION['needdisplay'] = $need;
	  
		echo json_encode($city);
	}
	

?>
