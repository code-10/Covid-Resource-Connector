<?php session_start(); ?>
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
        $vote_map = [ 'up' => 1, 'down' => -1];
        $upordown = $vote_map[$vote];
        $upvotes=0;
        $downvotes=0;
        $vote === "up" ? $upvotes=1 : $downvotes=1;



        
        if($con->query("select count(*) as 'c' from updownvote where email='$email' and post_id='$post_id' ")->fetch_assoc()['c']) {
          $con->query("update post as p,updownvote as v v.upordown=$upordown, p.upvotes=p.upvotes+$upvotes, p.downvotes=p.downvotes+$downvotes where v.email='$email' and v.post_id='$post_id' and v.post_id=p.post_id;");
        }
        else {
          $con->query("insert into updownvote values('$email','$post_id','$upordowm'");
          if( $vote === "up")
            $con->query("update post set upvotes=upvotes+1 where post_id='$post_id'");
          else if($vote === "down")
            $con->query("update post set downvotes=downvotes+1 where post_id='$post_id'");
          else
            die("Invalid value for vote parameter");
        }
        
        var_dump($con->error);
        
      
    }
?>
