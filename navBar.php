<nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a href="../index.php" class="navbar-brand">
            <svg xmlns="http://www.w3.org/2000/svg" width="46" height="46" viewBox="0 0 46 46">
                  <g id="Group_1" data-name="Group 1" transform="translate(-1858 -1187)">
                  <circle id="Ellipse_3" data-name="Ellipse 3" cx="23" cy="23" r="23" transform="translate(1858 1187)" fill="#006e5f"/>
                  <text id="CRC" transform="translate(1881 1216)" fill="#fff" font-size="16" font-family="Poppins-Bold, Poppins" font-weight="700"><tspan x="-17.2" y="0">CRC</tspan></text>
                  </g>
            </svg>
      </a>
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
