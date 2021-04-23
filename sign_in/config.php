<?php

  //223027778296-b5spuu6oj577dudfbg66fvhinrlct797.apps.googleusercontent.com
  //Tee2-nx0-YfsVMiOw6XmzMPa

  //Include Google Client Library for PHP autoload file
  require_once 'GoogleOAuth/vendor/autoload.php';

  //Make object of Google API Client for call Google API
  $google_client = new Google_Client();

  //Set the OAuth 2.0 Client ID
  $google_client->setClientId('223027778296-b5spuu6oj577dudfbg66fvhinrlct797.apps.googleusercontent.com');

  //Set the OAuth 2.0 Client Secret key
  $google_client->setClientSecret('Tee2-nx0-YfsVMiOw6XmzMPa');

  //Set the OAuth 2.0 Redirect URI
  $google_client->setRedirectUri('https://covid-resource-connector.herokuapp.com/sign_in/google_sign_in.php');

  // to get the email and profile 
  $google_client->addScope('email');

  $google_client->addScope('profile');

  $google_client->addScope('https://www.googleapis.com/auth/user.phonenumbers.read');


  
?>
