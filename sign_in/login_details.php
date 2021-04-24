<?php

session_start();

include '../libraries/shield.php';

$visit=$_SESSION['visit'];

function check_passwordu($email, $password)
{
    
    $con = getCon();
    
    $email = $con->query("select * from user where email='$email';");
    $res  = $email->fetch_assoc();
    
    //echo var_dump($res) . "<br>";
    
    $password_hash = $res['password'];
    
    if (password_verify($password, $password_hash)) {
        echo "password verified<br>";
        return True;
    } else {
        echo "password not verified<br>";
        return False;
    }
}





if (isset($_POST['login_user'])) {
    
    $email = $_POST['email'];
    $password  = $_POST['password'];
    
    if (rowExists('user', 'email', $email)) {
        if (check_passwordu($email, $password)) {
            //echo "Yes";
            $_SESSION['user_name'] = $email;
            header("Location:../".$visit);
            die();
        } else {
            $wrongpassword = true;
            header("Location:sign_in.php?signinwhich=login&&wrongpassword=" . $wrongpassword);
            echo "no2 [password wrong]";
        }
    } else {
        //echo "no1 [user doesn't exist]";
        header("Location:sign_in.php?signinwhich=register");
        die();
    }
}



?>
