<?php

/*
 * Redirect to binary file for download
 * @author Dalibor Janák
 */

$urlDemoWin = 'http://downloads.klokantech.com/maptiler/maptiler-0.5.3-free-x64-x86-setup.exe';
$urlDemoLinux = 'http://downloads.klokantech.com/maptiler/maptiler-0.5.3-free-x64-x86-setup.exe';
$urlDemoMac = 'http://downloads.klokantech.com/maptiler/maptiler-0.5.3-free-mac.dmg';

$userAgent = $_SERVER['HTTP_USER_AGENT'];

if (preg_match('/MAC/', strtoupper($userAgent))) {
  header('Location:' . $urlDemoMac);
} elseif (preg_match('/LINUX/', strtoupper($userAgent))) {
  header('Location:' . $urlDemoLinux);
} else {
  //other or win
  header('Location:' . $urlDemoWin);
}