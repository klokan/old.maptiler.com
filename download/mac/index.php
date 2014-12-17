<?php

/**
 * Redirect to Mac installation file 
 */
include_once '../config.php';

if (isset($_GET['email']) && isset($_GET['key'])) {
  //pro customers
  include_once '../../pricing/limeLM.php';
  include_once '../../pricing/libs/S3.php';
  include_once '../../pricing/secure.php';

  $email = $_GET['email'];
  $key = $_GET['key'];

  //check if customer have pro
  $LM = new Maptiler\Limelm;
  if ($LM->verifyUser($email, $key)) {
    //signed download link to amazon
    $s3 = @new S3($keys['awsAccessKey'], $keys['awsSecretKey']);
    $DownloadLink = @S3::getAuthenticatedURL('downloads.klokantech.com'
                    , 'maptiler/' . $distMac['pro'], 60 * 60 * 24 * 5, true);
    header('location: ' . $DownloadLink);

  } else {
    echo 'Verification failed!';
  }
} else {
  //free customers
  header('Location:' . $downlodUrl . $distMac['free']);
}