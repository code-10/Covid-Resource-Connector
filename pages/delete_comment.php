<?php session_start(); 
 include_once '../libraries/shield.php';
$con = getCon();

$email = $_SESSION['email'];

if(isset($_SESSION['email']))
{
    $comment_id = $_GET['comment_id'];
    //$con->query("delete from comment where comment_id='$comment_id'");
 
    if($email === 'groot@gmail.com')
            $con->query("delete from comment where comment_id='$comment_id'"); // if admin, ignore email
        else
            $con->query("delete from comment where comment_id='$comment_id' and email='$email'"); // if not admin, check if owner of post is deleting
    }
?>
