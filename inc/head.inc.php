<?php
    /**
     * Head Include Page 
     * last_update: 2019-08-08
     * Author: Ravi Patel, patel-r89@webmail.uwinnipeg.ca
     */
?><!DOCTYPE html>
<html lang="en"> <!-- html starts -->
  <head> <!-- head starts -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Meta Viewport tag: Ensures the browser doesn’t report the full resolution of the device -->
    <meta name="description" content="Around the Globe is a travel company providing satisfactory touring experiences around the world." />
    <meta name="keywords" content="travel, tour, vacation, trip, travel tips" />
    <title><?=esc($title)?></title>
    
    <!--
    
    11111111111111111111111111111111111111111111111111
    11111111111111111111111111111111111111111111111111
    11111111111111111111111111111111111111111111111111
    1111        1111111  111111  111111  111      1111
    1111  11111  11111    11111  111111  11111  111111
    1111  11111  1111  11  1111  111111  11111  111111
    1111  11111  111  1111  111  111111  11111  111111
    1111  11   11111  1111  1111  1111  111111  111111
    1111  111  11111        11111  11  1111111  111111
    1111  1111  1111  1111  11111  11  1111111  111111
    1111  11111  111  1111  111111    111111      1111
    11111111111111111111111111111111111111111111111111
    11111111111111111111111111111111111111111111111111
    11111111111111111111111111111111111111111111111111
    11                                              11
    11        Name     : Ravi Patel                 11
    11        Program  : WDD - January 2019         11
    11                                              11
    11111111111111111111111111111111111111111111111111

    -->
    
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700%7cRoboto:400" rel="stylesheet"> <!-- including google fonts -->
    <link rel="stylesheet" href="../public/css/style.css" type="text/css" media="screen and (min-width: 769px)" /> <!-- desktop css -->
    <link rel="stylesheet" href="../public/css/mobile.css" type="text/css" media="screen and (max-width: 768px)" /> <!-- mobile css -->
    <link rel="stylesheet" href="../public/css/print.css" type="text/css" media="print" /> <!-- print css -->
    
    <link rel="icon" href="../public/images/favicon.ico" /> <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="../public/images/apple-icon-57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="../public/images/apple-icon-72.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="../public/images/apple-icon-114.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="../public/images/apple-icon-144.png" />
    
    <?php
        // including unique style block for specific pages
        if($title == 'ATG - About') {
            require 'about.inc.css';
        } elseif($title == 'ATG - Blog') {
            require 'blog.inc.css';
        } elseif($title == 'ATG - Contact') {
            require 'contact.inc.css';
        } elseif($title == 'ATG - Testimonials') {
            require 'testimonials.inc.css';
        } elseif($title == 'ATG - Tours') {
            require 'tours.inc.css';
        } elseif($title == 'ATG - Registration') {
            require 'registration.inc.css';
        }
        
    ?>

    <!-- conditional comment for IE 8 or lower: script and styles -->
    <!--[if LTE IE 8]>
      <script type="text/javascript">
        document.createElement('header');
        document.createElement('nav');
        document.createElement('footer');
        document.createElement('article');
        document.createElement('section');
        document.createElement('main');
        document.createElement('aside');
      </script>
      
      <link rel="stylesheet" href="../public/css/ie.css" type="text/css" />
    <![endif]-->
  </head> <!-- head ends -->

  <body> <!-- body starts -->
    
    <div id="wrapper"> <!-- wrapper div starts -->