<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php'; // change path as needed


$fb = new \Facebook\Facebook([
    'app_id' => '1273744833358962',
    'app_secret' => '672b90de06079589c8ab05c4303e8cdb',
    'default_graph_version' => 'v2.10',
    //'default_access_token' => '{access-token}', // optional
  ]);
  
  // Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
  //   $helper = $fb->getRedirectLoginHelper();
  //   $helper = $fb->getJavaScriptHelper();
  //   $helper = $fb->getCanvasHelper();
  //   $helper = $fb->getPageTabHelper();
  
  /*try {
    // Get the \Facebook\GraphNodes\GraphUser object for the current user.
    // If you provided a 'default_access_token', the '{access-token}' is optional.
    $response = $fb->get('/me', '{access-token}');
  } catch(\Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(\Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  
  $me = $response->getGraphUser();
  echo 'Logged in as ' . $me->getName();*/


  $helper = $fb->getRedirectLoginHelper();
  $permissions=['email'];
  $redirectURL= "https://".$_SERVER['SERVER_NAME']."/crono/PaintArt.cl/controlador/fb-callback.php";
  $loginUrl= $helper->getLoginUrl($redirectURL, $permissions);
  echo '<a href="'.$loginUrl.'">Entrar con Facebook</a>';


?>