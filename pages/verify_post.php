<?php session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php
authentication_required();
   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;		

?>

<?php

    $con = getCon();

         

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

      

        if(!isset($_POST['modify'])){
            
            $res = $con->query("insert into post(email,state,city,description,ph_no,request_resource,tag_id,first_name,last_name) values('$email','$state','$city','$description','$phone_number','$request_resource','$tag_id','$first_name','$last_name')");    
        
        }
        else
        {
            $res = $con->query("update post set state='$state',tag_id='$tag_id',city='$city',description='$description',ph_no='$phone_number',request_resource='$request_resource' where post_id='$post_id'"); 
           
            $con->query("delete from needs where post_id='$post_id'");
           
        }
      
        //needs
        $needs = Array();      
        if(!empty($_POST['needs'])){
         foreach($_POST['needs'] as $n){
           $needs[] = $n;
         }
        }
           
        $nc = count($needs);
        for($i=0;$i<$nc;$i++)
        {
            if(!isset($_POST['modify'])){
                $con->query("insert into needs(post_id,tag_id) values('$latest_id','$needs[$i]')");
            }
            else
            {
                $con->query("insert into needs(post_id,tag_id) values('$post_id','$needs[$i]')");
            }
        }


        $type = $request_resource === "0" ? "type=request" : "type=resource";
        header("Location:view_posts.php?".$type);
        die();
?>
