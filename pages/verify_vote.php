  
<?php include_once '../header.php'; session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php

   $visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;		

?>

<?php

    $con = getCon();
        
    if(isset($_SESSION['email'])){
        
        $email = $_SESSION['email'];
        $post_id = $_GET['post_id'];
        $vote = $_GET['vote'];   
      
   
        if($vote=="up"){
          $vote=1;
          
          $current_upvotes = Array();
          
          $current_upvotes_res = $con->query("select * from post where post_id='$post_id'");
          while($current_upvotes_ele = $current_upvotes_res->fetch_assoc())
            $current_upvotes[] = $current_upvotes_ele['upvotes'];
          
          $new_upvotes = $current_upvotes[0]+1;
          
          /*echo $current_upvotes[0];
          echo "<br>";
          echo $new_upvotes;
          echo "<br>";*/
                
          
        }
        else if($vote=="down"){
          $vote=0;
          
          $current_downvotes = Array();
          
          $current_downvotes_res = $con->query("select * from post where post_id='$post_id'");
          while($current_downvotes_ele = $current_downvotes_res->fetch_assoc())
            $current_downvotes[] = $current_downvotes_ele['downvotes'];
          
          $new_downvotes = $current_downvotes[0]+1;
          
          /*echo $current_downvotes[0];
          echo "<br>";
          echo $new_downvotes;
          echo "<br>";*/
          
        }
      
        if(rowExists('updownvote','email',$email))
        {
            if(rowExists('updownvote','post_id',$post_id))
            {
                header("Location:requests.php?valid=no");
                die();
            }
            else
            {
                  $con->query("insert into updownvote(email,post_id,upordown) values('".mysqli_real_escape_string($con,$email)."','".mysqli_real_escape_string($con,$post_id)."','".mysqli_real_escape_string($con,$vote)."')");
              
                  $check = $con->query("update post set upvotes='$new_upvotes' where post_id='$post_id'");    
                  var_dump($check->error);
                  //header("Location:requests.php?valid=yes");
                  //die();
            }
        }
        else
        {
            $con->query("insert into updownvote(email,post_id,upordown) values('".mysqli_real_escape_string($con,$email)."','".mysqli_real_escape_string($con,$post_id)."','".mysqli_real_escape_string($con,$vote)."')");
          
            $check = $con->query("update post set downvotes='$new_downvotes' where post_id='$post_id'");   
            var_dump($check->error);
            //header("Location:requests.php?valid=yes");
            //die();
            
        }
      
      
    }
?>
