<?php

/*
 * Redirect to binary file for download
 * @author Dalibor Janák
 */

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