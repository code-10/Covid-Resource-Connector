<?php

  include_once '../libraries/shield.php';
  
  $con = getCon();

  if(isset($_POST['sid'])) {

    $sid = $_POST['sid'];
	  
    $city = Array();
    $city_res = $con->query("select * from city where state_id='$sid'"); 
    while($city_ele = $city_res->fetch_assoc()){
        $city[] = $city_ele['city_name'];
    }
    
		echo json_encode($city);
	}

?>
