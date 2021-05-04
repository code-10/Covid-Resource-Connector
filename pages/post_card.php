<?php
include_once "../libraries/shield.php";
include_once "../header.php";
session_start();
date_default_timezone_set('Asia/Kolkata');
function getUserOptions($post_id){
    $html=<<<EOD
        <a href="delete_post.php?post_id=$post_id"><i class="fa fa-trash" aria-hidden="true" style="color:red;"></i></a>&nbsp
        <a href="modify_post.php?post_id=$post_id"><i class="fa fa-edit" aria-hidden="true" style="color:green;"></i></a>&nbsp
    EOD;
    return $html;
}
function renderComment($user_email,$email,$comment_id,$comment,$time){
    $deleteOption = "";
    if ($user_email === $email)
    {
        $deleteOption=<<<EOD
            <a onclick="deleteHandler(event)" data-comment-id="$comment_id"><i class="fa fa-trash" aria-hidden="true" style="color:red;"></i></a>&nbsp
        EOD;
    }
    return <<<EOD
        <div>
            <p class="text-monospace mb-1">
                $deleteOption
                $comment
            </p> 
            <p class="font-weight-light mb-0 responsive-md">$email</p>
            <p class="font-weight-light mb-4 responsive-md">$time</p>
        </div>
        EOD;
}
function renderUserPost($data, $type, $user_email=NULL){
    $con = getCon();
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $upvotes = $data['upvotes'];
    $downvotes = $data['downvotes'];
    $post_id = $data['post_id'];
    $tag_name = $data['tag_name'];
    $city = $data['city'];
    $state = $data['state'];
    $description = $data['description'];
    $phone_number = $data['ph_no'];
    $email = $data['email'];

    $time = $data['time'];
    
    //trying
    $post_id = $data['post_id'];
    
    $l10nDate = new DateTime($time, new DateTimeZone('UTC'));
    $l10nDate->setTimeZone(new DateTimeZone('Asia/Kolkata'));
    $time = $l10nDate->format('Y-m-d H:i:s');
    
    $postOptions = $type==='user' ? getUserOptions($post_id) : "";
    $commentList = "";
    $comment_res = $con->query("select * from comment where post_id='$post_id'");

    while($data = $comment_res->fetch_assoc())
    {
        $time = $data['time'];
        $email = $data['email'];
        $comment = $data['comment'];
        $comment_id = $data['comment_id'];
        $commentList .= renderComment($user_email,$email,$comment_id,$comment, $time);
    }
    
    
    
    $needs_display=Array();
    $needs_res = $con->query("select t.tag_name from tag as t, needs as n, post as p where n.tag_id=t.tag_id and p.post_id='$post_id'");
    while($needs_ele = $needs_res->fetch_assoc())
    {
        $needs_display[] = $needs_ele['tag_name']; 
    }   
    $nd = count($needs_display);
    
    

    $html=<<<START
    <div class="col-12 col-sm-4 m-2">
    <div class="card">
        <h5 class="card-header p-3">
        $first_name&nbsp<?=$last_name?>&nbsp
        $postOptions
        <span class="badge badge-pill badge-info">$needs_display</span>
        </h5>
        <div class="card-body p-3">
            <h5 class="card-title">$city, $state</h5>
                <p class="card-text">Description: $description</p>
            <p class="card-text mb-2">Mob: $phone_number</p>
            <p class="text-muted mb-0 responsive-md">$email</p>
            <p class="text-muted mb-2 responsive-md">$time</p>
            <p class="card-text">
                <a data-post-id="$post_id" data-vote-type="up" onclick="voteHandler(this)"><i class="fa fa-arrow-up" aria-hidden="true" style="color:green;font-size:24px;"></i>&nbsp<span class='upvote'>$upvotes</span>&nbsp&nbsp</a>
                <a data-post-id="$post_id" data-vote-type="down" onclick="voteHandler(this)"><i class="fa fa-arrow-down" aria-hidden="true" style="color:red;font-size:24px;"></i>&nbsp<span class='downvote'>$downvotes</span></a>
            </p>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter$post_id">
                Add a Comment
            </button>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalLong$post_id">
                View Comments
            </button>
            <p class="text-muted m-2 responsive-md float-right">post id: $post_id</p>
        </div>
        <div class="modal fade" id="exampleModalCenter$post_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content p-2">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add your Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    
                        <form  id="comment-form" method="POST" onsubmit="commentHandler(event)" style="display:block;">
                            <div class="form-group">
                                    <label for="exampleFormControlTextarea5">Comment</label>
                                    <textarea maxlength="100" class="form-control" id="exampleFormControlTextarea5" rows="4" name="comment"></textarea>
                            </div>
                            
                            <input type="hidden" name="post_id" value="$post_id" />
                    
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="add_comment" class="btn btn-success">Add</button>
                    </form>
                    
                    </div>
            </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalLong$post_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Comments</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                
                
                        <div class="modal-body">
                    
                            $commentList
                    
                        </div>
                
                        <div class="modal-footer p-1">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                </div>
            </div>
        </div>	
    </div>
    </div>
    START;
    return $html;
}
?>
<!-- <div class="row m-4 d-flex justify-content-center">
    <div class="d-flex flex-row">
        <?php 
        // $email = $_SESSION['email'];
        // $con = getCon();
        // $my_posts_res = $con->query("select p.upvotes,p.downvotes,p.ph_no,p.description,p.state,p.city,p.post_id,p.first_name,p.last_name,p.time,t.tag_name,p.email from post as p,tag as t where t.tag_id=p.tag_id and p.email='$email' and p.request_resource='$request_resource' ORDER BY time ASC, upvotes desc, downvotes asc");
        // $postComp = "";
        // while($data = $my_posts_res->fetch_assoc()) {
        //     $postComp = renderUserPost($data, 'user', $email); 
        //     echo $postComp;
        // }
        ?>
    </div>
</div>

<div class="row m-4 d-flex justify-content-center">
    <div class="d-flex flex-row">
        <?php 
        // $con = getCon();
        // $my_posts_res = $con->query("select p.upvotes,p.downvotes,p.ph_no,p.description,p.state,p.city,p.post_id,p.first_name,p.last_name,p.time,t.tag_name,p.email from post as p,tag as t where t.tag_id=p.tag_id and p.request_resource='$request_resource' and p.email!='$email' ORDER BY time ASC, upvotes desc, downvotes asc");
        // $postComp = "";
        // while($data = $my_posts_res->fetch_assoc()) {
        //     $postComp = renderUserPost($data, 'public', $email); 
        //     echo $postComp;
        // }
        ?>
    </div>
</div> -->
