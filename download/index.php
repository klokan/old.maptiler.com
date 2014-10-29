<?php

if (isset($_GET['url']) && !empty($_GET['url']) && isset($_GET['email']) && isset($_GET['key'])) {
  $product = 'pro';
  $url = $_GET['url'];
  $email = $_GET['email'];
  $key = $_GET['key'];

  //libs form pricing
  include_once '../pricing/limeLM.php';
  include_once '../pricing/libs/S3.php';
  include_once '../pricing/secure.php';

  //auth
  $LM = new Maptiler\Limelm;
  if ($LM->verifyUser($email, $key)) {
    $s3 = @new S3($keys['awsAccessKey'], $keys['awsSecretKey']);
    $DownloadLink = @S3::getAuthenticatedURL('downloads.klokantech.com'
                    , 'maptiler/' . $url, 60 * 60 * 24 * 5, true);
    header('location: ' . $DownloadLink);
  } else {
    echo 'Verification failed.';
  }
} else {

  include 'config.php';

  $userAgent = $_SERVER['HTTP_USER_AGENT'];

  if (preg_match('/MAC/', strtoupper($userAgent))) {
    header('Location:' . $urlDemoMac);
  } elseif (preg_match('/LINUX/', strtoupper($userAgent))) {
    header('Location: /download/linux/');
  } else {
    //other or win
    header('Location:' . $urlDemoWin);
  }
}