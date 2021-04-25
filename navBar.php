<nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="../index.php" class="navbar-brand">CRC</a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
         <div class="navbar-nav">
            <a href="/" class="nav-item nav-link active">Home</a>
            <a href="/pages/about.php" class="nav-item nav-link">About</a>
         </div>
         <div class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['email'])) {
               echo '<a href="/pages/profile.php" class="nav-item nav-link active"><i class="fa fa-user-o">  '.$_SESSION['email'].'</i></a>';
               echo '<a href="/sign_in/logout.php" class="nav-item nav-link">Logout</a>';
               }
               else{
               echo '<a href="/sign_in/google_sign_in.php" class="nav-item nav-link">Sign in</a>';
               }
               ?>
         </div>
      </div>
</nav>