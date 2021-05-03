<?php session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php

   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;		

?>

<?php

    $con = getCon();

    //if(isset($_POST['create_post'])){

        $email =  mysqli_real_escape_string($con,$_POST['email']);
        $state = mysqli_real_escape_string($con,$_POST['state']);
        $city = mysqli_real_escape_string($con,$_POST['city']);
        $description = mysqli_real_escape_string($con,$_POST['description']);
        $phone_number = mysqli_real_escape_string($con,$_POST['phonenumber']);
        $request_resource = mysqli_real_escape_string($con,$_POST['request_resource']);
        $first_name =  mysqli_real_escape_string($con,$_POST['first_name']);
        $last_name = mysqli_real_escape_string($con,$_POST['last_name']);
        $post_id = $_POST['post_id'];
        $tag_id = $_POST['tag_id'];

        if(!isset($_POST['modify']))
            $res = $con->query("insert into post(email,state,city,description,ph_no,request_resource,tag_id,first_name,last_name) values('$email','$state','$city','$description','$phone_number','$request_resource','$tag_id','$first_name','$last_name')");    
        else
        {
            $res = $con->query("update post set state='$state',tag_id='$tag_id',city='$city',description='$description',ph_no='$phone_number',request_resource='$request_resource' where post_id='$post_id'"); 
        }
        header("Location:view_posts.php");
        die();
    //}
?>
