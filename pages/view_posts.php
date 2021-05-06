<?php include_once '../header.php'; session_start(); ?>
<?php include_once '../libraries/shield.php'; ?>
<?php include_once './post_card.php'; ?>

<?php
	$con = getCon();

   	$visit = $_SERVER['REQUEST_URI'];
  	$visit = substr($visit,1);

  	$_SESSION['visit'] = $visit;

	$user_email = $_SESSION['email'];

	$map_rr = [ 'request' => 0, 'resource' => 1];
	$request_resource = $map_rr[$_GET['type']];
	if(!$request_resource) #defaults to show only requests.
	  $request_resource = 0;


?>


<body style="font-family:'Poppins', sans-serif;">
	<?php include_once "../navBar.php"; ?>
	
	
	<?php
	
		$state_id = Array();
		$state_name = Array();
		$state_res = $con->query("select * from state");
		while($state_ele = $state_res->fetch_assoc())
		{
			$state_id[]=$state_ele['state_id'];
			$state_name[]=$state_ele['state_name'];	
		}
	
		$cc = count($state_id);
	
	
		$tag_name = Array();
		$tag_id = Array();
		$tag_res = $con->query("select * from tag");
		while($tag_ele = $tag_res->fetch_assoc())
		{
			$tag_id[]=$tag_ele['tag_id'];
			$tag_name[]=$tag_ele['tag_name'];	
		}
	
		$tt = count($tag_id);

		if(isset($_POST['need']))
		{
			$state = $_POST['state'];
			$city = $_POST['city'];
			$need = $_POST['need'];
			
		}
		else{
			$state = $city = $need = "All";
		}
		//var_dump($_POST);
		if($need!="All")
		{
			$needDisplay = $con->query("select * from tag where tag_id='$need'")->fetch_assoc()['tag_name'];	
		}
		else
		{
			$needDisplay="All";
		}
		
		$state_condition = "";
		$city_condition = "";
		$need_condition = "";
		$state_condition = ($state === "All" ? "1"  : "p.state='$state'");
		$city_condition = ($city === "All" ? "1"  : "p.city='$city'");
		$need_condition = ($need === "All" ? "1" : "'$need' in ( select tag_id from needs where post_id=p.post_id )");
	?>
	
	
	<h5 class="text-center m-2" style="font-size:16px;"><i class="fa fa-exclamation-triangle m-2 text-danger"></i>BEWARE OF FRAUDSTERS<i class="fa fa-exclamation-triangle m-2 text-danger"></i></h5>
	<p class="m-2 text-center">We cannot guarantee the availability nor the validity of the post. Please be advised, verify the post before taking action.</p>
	
	<div class="container">
	<form class="row d-flex justify-content-center p-4" method="POST" action="view_posts.php?type=<?=$_GET['type']?>">
  		<div class="col-6 col-sm-3 text-center">
			<label for="inputuser">State</label>
    			<select class="form-control" id="state" name="state" required>
				<!--<option value="All" selected>All</option>-->
				<?php for($i=0;$i<$cc;$i++) { ?>
					<option value="<?=$state_name[$i]?>" <?php echo strval($state_name[$i])===strval($state) ? "selected" : "" ; ?>><?=$state_name[$i]?></option>
				<?php } ?>
    			</select>
		</div>	

		<div class="col-6 col-sm-3 text-center">
			<label for="inputuser">City</label>
    			<select class="form-control" id="city" name="city" required>
					<option value="All" selected>All</option>
    			</select>
		</div>	
		
		<div class="col-12 col-sm-3 text-center">
			<label for="inputuser">Need</label>
    			<select class="form-control" id="need" name="need"> <!-- onchange='this.form.submit()'-->
				<!--<option selected disabled>select need</option>-->
				<option value="All">All</option>
				<?php for($i=0;$i<$tt;$i++) { ?>
					<option value="<?=$tag_id[$i]?>" <?php echo  (strval($tag_id[$i]) == strval($need)) ? "selected" :"" ;?>><?=$tag_name[$i]?></option>
				<?php } ?>
    			</select>
		</div>		
		
		<div class="col-12 col-sm-2 text-center p-4"><button class="btn btn-primary rounded-pill" name="filter" type="submit">filter</button></div>
		
	</form>
	</div>

	<?php
		if(isset($_POST['need']))
		{	
			echo '<h5 class="m-2 text-center">Displaying results for '.$city.' City, '.$state.' State and '.$needDisplay.'</h5>';
		}
	?>
	
    <?php
      if(isset($_SESSION['email'])){	
		  $email = $_SESSION['email'];
	?>
	
		<h4 class="m-4 text-center">My posts</h4>
		<div class="row m-4 d-flex justify-content-center">
			<?php 
				$con = getCon();


					$my_posts_res = $con->query("select p.post_id,p.upvotes,p.downvotes,p.ph_no,p.description,p.state,p.city,p.post_id,p.first_name,p.last_name,p.time,p.email from post as p where p.email='$email' and p.request_resource='$request_resource' and $state_condition and $city_condition and $need_condition order by time asc,upvotes asc,downvotes desc;");
					$postComp = "";
					while($data = $my_posts_res->fetch_assoc()) {
						$postComp = renderUserPost($data, 'user', $email); 
					echo $postComp;
				}
			?>
		</div>
	<?php } ?>

		<h4 class="m-4 text-center">People's posts</h4>
	
   <div class="row m-4 d-flex justify-content-center">
					<?php 
	   					$my_posts_res = $con->query("select p.post_id,p.upvotes,p.downvotes,p.ph_no,p.description,p.state,p.city,p.post_id,p.first_name,p.last_name,p.time,p.email from post as p where p.email!='$email' and p.request_resource='$request_resource' and $state_condition and $city_condition and $need_condition order by time asc,upvotes asc,downvotes desc;");
						$postComp = "";
						while($data = $my_posts_res->fetch_assoc()) {
							$postComp = renderUserPost($data, 'public',$email); 
							echo $postComp;
						}
        			?>
   </div>
</body>
<script>
const email="<?=$email?>"

function deleteHandler(e){
	const comment_id = $(e.target).parent().attr("data-comment-id");
	$(e.target).parent().parent().parent().remove()
	$.ajax({
		method:'GET',
		url:'delete_comment.php',
		data:{comment_id:comment_id}
	})
	.done(resp => {
		console.log(resp);
	})
}
function commentHandler(e){
	e.preventDefault();
	const form = e.target;
	const post_id = form.elements['post_id'].value
	const comment = form.elements['comment'].value
	const data = {post_id:post_id, comment:comment};
	$(`#exampleModalCenter${post_id}`).modal('hide')

	console.log(data);
	if(comment === "")
		return;
	$.ajax({
		url:'verify_comment.php',
		method:"POST",
		data:data,
	})
	.done( resp => {
		resp = JSON.parse(resp)
		if(resp.msg === 'good')
		{	
			const id = resp.id
			let [month, day, year]    = new Date().toLocaleDateString("en-US").split("/")
			let [hour, minute, second] = new Date().toLocaleTimeString("en-US").split(/:| /)
			$(`#exampleModalLong${post_id} .modal-body`).append(`
				<div>
					<p class='text-monospace mb-1'>
						<a onclick="deleteHandler(event)" data-comment-id="${id}"><i class="fa fa-trash" aria-hidden="true" style="color:red;"></i></a>&nbsp
						${comment}
					</p>
					<p class="font-weight-light mb-0 responsive-md"> ${email} </p>
					<p class="font-weight-light mb-4 responsive-md">${year}-${month}-${day} ${hour}:${minute}:${second} </p>
				</div>

			`)
		}
		else if(resp.msg ==='auth')
		{
			alert("Login First");
		}
	})
}

function voteHandler(tag){
	const post_id = $(tag).attr('data-post-id');
	const vote_type = $(tag).attr('data-vote-type');
	const parentTag = $(tag).parent()
	const upvoteTag = $(parentTag).find(".upvote");
	const downvoteTag = $(parentTag).find(".downvote");

	const upvotes = parseInt(upvoteTag.text());
	const downvotes = parseInt(downvoteTag.text());
	
	$.ajax({
		url:"verify_vote.php",
		method:"GET",
		data:{post_id:post_id, vote:vote_type},
	})
	.done( resp => {
		resp = resp.trim()
		if(resp === "good2")
		{
			if(vote_type==="up")
			{
				upvoteTag.text( upvotes + 1);
				downvoteTag.text(downvotes - 1);
			}
			else if(vote_type==="down")
			{
				upvoteTag.text(upvotes - 1)
				downvoteTag.text(downvotes + 1)
			}
		}
		else if(resp==="good1")
		{
			if(vote_type==="up")
				upvoteTag.text( upvotes + 1);
			else if(vote_type==="down")
				downvoteTag.text(downvotes + 1)
		}
		else if(resp === "bad")
		{
			alert("Already Did That.");
		}
		else if(resp === "auth")
		{
			alert("you need to login");
		}
	})
	.fail( (x,y,z) => {
		console.log(x,y,z)
	})
}

</script>

<script type="text/javascript">
	const current_city = "<?=$city?>"
	function stateChange(){
					var sname = $("#state").val();
					if(sname === "All")
						return;
					//var need = $("#need").val();
					$.ajax({
						url: 'filter_config.php',
						method: 'post',
						data: 'sname=' + sname,
						//data:{sname:sname,need:need}
					}).done(function(city){
						console.log(city);
						city = JSON.parse(city);
						$('#city').empty();
						$('#city').append(`<option ${'All' === current_city ? 'selected' : ''}>` + 'All' + '</option>');
						city.forEach(function(c){
							$('#city').append(`<option ${c === current_city ? 'selected' : ''}>` + c + '</option>')
						})
					})
				}

	$(document).ready(function(){
			$("#state").change(stateChange)
			stateChange()
		})

</script>

<style>
    /*Media Queries*/
	@media (min-width:320px)  { .responsive-md{font-size:8px;}  /* smartphones, iPhone, portrait 480x320 phones */ }
	@media (min-width:481px)  { .responsive-md{font-size:12px;}  /* portrait e-readers (Nook/Kindle), smaller tablets @ 600 or @ 640 wide. */ }
    	@media (min-width:641px)  { .responsive-md{font-size:12px;}  /* portrait tablets, portrait iPad, landscape e-readers, landscape 800x480 or 854x480 phones */ }
	@media (min-width:961px)  { .responsive-md{font-size:12px;}  /* tablet, landscape iPad, lo-res laptops ands desktops */ }
	@media (min-width:1025px) { .responsive-md{font-size:12px;}  /* big landscape tablets, laptops, and desktops */ }
	@media (min-width:1281px) { .responsive-md{font-size:12px;}  /* hi-res laptops and desktops */ }
	
</style>

