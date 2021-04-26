<?php session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php

   $visit = $_SERVER['HTTP_REFERER'];

  	$_SESSION['visit'] = $visit;		

?>

<?php

    $con = getCon();
        
    if(isset($_SESSION['email'])){
        
        $email = $_SESSION['email'];
        $post_id = $_GET['post_id'];
        $vote = $_GET['vote'];   
        $vote_map = [ 'up' => 1, 'down' => -1];
        $upordown = $vote_map[$vote];
        $upvotes=0;
        $downvotes=0;
        if($vote==='up')
        {
          $upvotes = 1;
          $downvotes = -1;
        }
        if($vote === "down")
        {
          $upvotes = -1;
          $downvotes = +1;
        }


        $previousVote=$con->query("select upordown from updownvote where email='$email' and post_id='$post_id' ")->fetch_assoc()['upordown'];

        if($previousVote) {
          if((int)$previousVote === $upordown)
            echo "";
          else{
            var_dump($con->error);
            $con->query("update post as p,updownvote as v set v.upordown='$upordown',p.upvotes=p.upvotes+$upvotes,p.downvotes=p.downvotes+$downvotes where v.email='$email' and v.post_id='$post_id' and v.post_id=p.post_id;");
            var_dump($con->error);
          }          

        }
        else {
          echo var_dump($x);
          $con->query("insert into updownvote(email,post_id,upordown) values('$email','$post_id','$upordown')");
          var_dump($con->error);
          if( $vote === "up")
            $con->query("update post set upvotes=upvotes+1 where post_id='$post_id'");
          else if($vote === "down")
            $con->query("update post set downvotes=downvotes+1 where post_id='$post_id'");
          else
            die("Invalid value for vote parameter");
          var_dump($con->error);

        }
        
        
        header("location:$visit");
        die();
      }
?>