<?php

if (isset($_GET['url']) && !empty($_GET['url'])) {
  //signed downoad link from amazon
  include_once '../pricing/limeLM.php';
  include_once '../pricing/libs/S3.php';
  include_once '../pricing/secure.php';
  $LM = new Maptiler\Limelm;

  $email = $_GET['email'];
  $key = $_GET['key'];

  if (isset($_GET['hash']) && $_GET['hash'] == md5($keys['awsAccessKey']) || $LM->verifyUser($email, $key)) {

    $url = $_GET['url'];

    //auth
    $s3 = @new S3($keys['awsAccessKey'], $keys['awsSecretKey']);
    $DownloadLink = @S3::getAuthenticatedURL('downloads.klokantech.com'
                    , 'maptiler/' . $url, 60 * 60 * 24 * 5, true);
    header('location: ' . $DownloadLink);
  } else {
    echo 'Verification failed!';
    die;
  }
} elseif (isset($_GET['email']) && isset($_GET['key'])) {
  //download for pro customers
  $os = detectOs();
  header('Location: /download/' . $os . '/?' . $_SERVER['QUERY_STRING']);
  
} else {
  //autodetect free download
  $os = detectOs();
  header('Location: /download/' . $os . '/');
}

/**
 * Detect os from $_SERVER['HTTP_USER_AGENT']
 * @return string
 */
function detectOs() {
  $userAgent = $_SERVER['HTTP_USER_AGENT'];
  if (preg_match('/MAC/', strtoupper($userAgent))) {
    $os = 'mac';
  } elseif (preg_match('/LINUX/', strtoupper($userAgent))) {
    $os = 'linux';
  } else {
    //other or win
    $os = 'win';
  }
  return $os;
}
