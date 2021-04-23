<?php include '../libraries/shield.php'; ?>

<?php

if (isset($_POST['register_user']))
{
    $con = getCon();

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user_name = strtolower($user_name);
    $email = strtolower($email);
    
    $p = password_hash($p, PASSWORD_DEFAULT);

    if (rowExists('user', 'user_name', $u))
    {
        $userexists = true;
        header("Location:sign_in.php?signinwhich=register&&userexists=" . $userexists);
        die();

    }
    else if (rowExists('user', 'email', $e))
    {
        $emailexists = true;
        header("Location:sign_in.php?signinwhich=register&&emailexists=" . $emailexists);
        die();

    }
    else
    {
        if (($con->query("insert into user(user_name,email,password) values('$u','$e','$p');")) === True)
        {
            //echo "YES";
            header("Location:sign_in.php?singinwhich=login&&loginnow=yes");
            die();
        }
        else
        {
            $error = true;
            header("Location:sign_in.php?signinwhich=register&&emailexists=" . $error);
            die();
        }
    }
}

?>
