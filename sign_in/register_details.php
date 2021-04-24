<?php include '../libraries/shield.php'; ?>

<?php

if (isset($_POST['register_user']))
{
    $con = getCon();

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $first_name = strtolower($first_name);
    $last_name = strtolower($last_name);
    
    $password = password_hash($password, PASSWORD_DEFAULT);


    if (rowExists('user', 'email', $email))
    {
        $emailexists = true;
        header("Location:google_sign_in.php?signinwhich=register&&emailexists=" . $emailexists);
        die();
    }
    else
    {
        $res = $con->query("insert into user(first_name,last_name,email,password) values('$first_name','$last_name','$email','$password')")
        print_r($res);
        
        if ($con->query("insert into user(first_name,last_name,email,password) values('$first_name','$last_name','$email','$password')"))
        {
            //header("Location:google_sign_in.php?singinwhich=login&&loginnow=yes");
            //die();
        }
        else
        {
            $error = true;
            //header("Location:google_sign_in.php?signinwhich=register&&emailexists=" . $error);
            //die();
        }
    }
}

?>
