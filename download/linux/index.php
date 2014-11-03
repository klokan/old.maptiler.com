<?php
include '../config.php';
include_once '../../pricing/secure.php';

if (isset($_GET['hash']) && $_GET['hash'] == md5($keys['awsAccessKey'])) {
  $hash = $_GET['hash'];
  $pro = true;
} else {
  $pro = false;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Pricing - MapTiler</title>
    <meta name="description" content="MapTiler transforms raster maps into a format suitable for web applications, mobile devices and 3D visualisation. It is the fastest and simplest tool to prepare raster geodata for web mashups, mobile apps and for Google Earth. It produces either a a folder with tiles and simple HTML viewer or the MBTiles archive.">
    <meta name="author" content="Klokan Technologies GmbH">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="robots" content="noindex, nofolow">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/skins/colors/blue.css">
    <link rel="stylesheet" href="../../css/layout/wide.css">
    <link rel="shortcut icon" href="../../images/favicon.ico">
    <style type="text/css"></style>
    <script>
      (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

      ga('create', 'UA-241776-12', 'auto');
      ga('send', 'pageview');

    </script>
  </head>
  <body class="one-page">
    <div id="wrap" class="boxed">
      <header class="fixed" id="home">
        <div class="top-bar">
          <!-- Start Container -->
          <div class="container clearfix">
            <div class="slidedown">
              <div class="eight columns">
                <div class="phone-mail" style="padding-top: 8px;">
                  <a href="http://www.klokantech.com/">Klokan Technologies GmbH</a>
                </div>
              </div>
              <div class="eight columns">
                <div class="social">
                  MapTiler News:
                  <a href="https://plus.google.com/112524594087395104243" rel="publisher"><i class="social_icon-gplus s-18"></i></a>
                  <a href="https://twitter.com/klokantech"><i class="social_icon-twitter s-14"></i></a>
                  <a href="https://www.facebook.com/maptiler"><i class="social_icon-facebook s-18"></i></a>
                </div>
              </div>
            </div>
          </div>
          <!-- End Container -->
        </div>
        <!-- End top-bar -->
        <div class="main-header">
          <div class="container clearfix">
            <a href="#" class="down-button"><i class="icon-angle-down"></i></a>
            <!-- this appear on small devices -->
            <div class="one-third column">
              <div class="logo">
                <a href="/">
                  <img src="../../images/logo.png" alt="MapTiler" />
                </a>
              </div>
            </div>
            <!-- End Logo -->
            <div class="two-thirds column">
              <nav id="menu" class="navigation" role="navigation">
                <a href="#">Show navigation</a><!-- this appear on small devices -->
                <ul id="nav">
                  <li><a href="http://maptiler.com/#features">Features</a></li>
                  <li><a href="http://maptiler.com/pricing/">Pricing</a></li>
                  <li><a href="http://maptiler.com/#video_tutorials">Video tutorials</a></li>
                  <li><a href="http://maptiler.com/#developers">Developers</a></li>
                </ul>
              </nav>
            </div>
            <!-- End Menu -->
          </div>
          <!-- End Container -->
        </div>
        <!-- End main-header -->
      </header>
      <!-- End Header -->
      <!-- Content -->
      <!-- Pricing table -->
      <div class="one-page bottom-3" id="pricing">
        <br><br><br><br>
        <div class="container clearfix">
          <?php
          if ($pro) {
            echo '<h2>MapTiler Pro for Linux</h2>';
            printTable($distLinux['pro'], $hash);
            ?> 
            <p>
              <small>* requires the installation of <a href="//fedoraproject.org/wiki/EPEL#How_can_I_use_these_extra_packages.3F">EPEL7 repository</a></small>
            </p>
            <?php
            echo '<br><br><br><br>';
            echo '<h3>Headless (command line tools only)</h3>';
            printTable($distLinux['headless'], $hash);
          } else {
            echo '<h2>MapTiler Free/Start/Plus for Linux</h2>';
            printTable($distLinux['free'], false);
          }
          ?>
          <p>
            <small>* requires the installation of <a href="//fedoraproject.org/wiki/EPEL#How_can_I_use_these_extra_packages.3F">EPEL7 repository</a></small>
          </p>
          <br><br><br><br>
        </div>
      </div>
      <!-- End Pricing table -->
    </div>
    <footer>
      <div class="footer-down" style="position: fixed; bottom: 0; left: 0; right: 0;">
        <div class="container clearfix">
          <div class="eight columns">
            <span class="copyright">© Copyright 2014 <a href="http://www.klokantech.com/">Klokan Technologies GmbH</a>. All Rights Reserved. <a href="http://www.klokantech.com/contact/">Contact.</a></span>
          </div>
          <!-- End copyright -->
          <div class="eight columns">
            <div class="social">
              MapTiler News: <a href="https://plus.google.com/112524594087395104243" rel="publisher"><i class="social_icon-gplus s-18"></i></a><a href="https://twitter.com/klokantech"><i class="social_icon-twitter s-14"></i></a><a href="https://www.facebook.com/maptiler"><i class="social_icon-facebook s-18"></i></a>
            </div>
          </div>
          <!-- End social icons -->
        </div>
        <!-- End container -->
      </div>
      <!-- End footer-top -->
    </footer><!-- <<< End Footer >>> -->
    <!-- Start JavaScript -->
    <script src="../js/jquery-1.9.1.min.js"></script>
    <!--jQuery library-->
  </body>
</html>

<?php

function printTable($distLinux, $hash = false) {
  echo '<table class="style"><tbody><tr>';
  $rowCounter = 0;
  foreach ($distLinux as $dist => $ver) {
    echo '<td style="width: 25%;"><img src="../../images/dist/' . strtolower($dist) . '-logo.png"></td>';
    if (count($ver) > $rowCounter) {
      $rowCounter = count($ver);
    }
  }
  ?>
  </tr>
  <tr>
    <?php
    foreach ($distLinux as $dist => $ver) {
      echo '<td><strong>' . $dist . '</strong></td>';
    }
    ?>
  </tr>
  <?php
  for ($i = 0; $i < $rowCounter; $i++) {
    echo '<tr>';
    foreach ($distLinux as $dist) {
      if (isset($dist[$i])) {
        if ($hash) {
          $link = '/download/?url=' . str_replace('free', 'pro', $dist[$i]['link']) . '&hash=' . $hash;
          echo '<td><a href="' . $link
          . '" target="_blank"><img src="../../images/download-icon.png"> ' . $dist[$i]['title'] . '</td>';
        } else {
          echo '<td><a href="//downloads.klokantech.com/maptiler/' . $dist[$i]['link'] . '" target="_blank">'
          . '<img src="../../images/download-icon.png"> ' . $dist[$i]['title'] . '</td>';
        }
      } else {
        echo '<td></td>';
      }
    }
    echo '</tr>';
  }
  echo '</tbody></table>';
}
?>