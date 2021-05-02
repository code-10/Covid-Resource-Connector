<?php
session_start();
include_once '../libraries/shield.php'; 
if(isset($_SESSION['email']))
{
        $con = getCon();
        $comment = $_POST['comment'];
        $email = $_SESSION['email'];
        $post_id = $_POST['post_id'];
        $res = $con->query("insert into comment(post_id,comment,email) values('".mysqli_real_escape_string($con,$post_id)."','".mysqli_real_escape_string($con,$comment)."','".mysqli_real_escape_string($con,$email)."')"); 
        $data = [ 'msg'=>'good','id'=>$con->insert_id];
        echo json_encode($data);
         
} else {
    $data = ['msg'=>'auth'];
    echo json_encode($data);
}
  

?>
