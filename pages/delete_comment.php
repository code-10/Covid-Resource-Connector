<?php session_start(); 
 include_once '../libraries/shield.php';
$con = getCon();

if(isset($_SESSION['email']))
{
    $comment_id = $_GET['comment_id'];
    $con->query("delete from comment where comment_id='$comment_id'");
}
?>
