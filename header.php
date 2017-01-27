<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv=content-type content="text/html; charset=utf-8">
	<meta name="keywords" content="files, avatars, wallpapers, pictures, host, image, upload-fast" />
	<meta name="description" content="Upload an unlimited amount of images - avatars, wallpapers, or pictures for free! Upload-fast.com offers free reliable image hosting with strong file protection.">
	<title>Upload-Fast.com - Fast Image Upload</title>
	<link type="text/css" rel="stylesheet" href="css/main.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
	<script type="text/javascript" src="inc/javascript.js"></script>
</head>

<body>
<div id="wrapper">
	<b class="rnd_top"><b class="rnd_b1"></b><b class="rnd_b2"></b><b class="rnd_b3"></b><b class="rnd_b4"></b></b>
	<div class="content">
        <div class="logo"><a class="a_logo" href="index.php"><img src="img/logo.png" alt="Fast Image Uploads" border="0" /></a></div>

            <ul>
                <li><a href="index.php">Upload</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="tos.php">Terms of Service</a></li>
                <li><?php
                    if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
                        echo "<a href=\"account.php\">Account</a>";
                    }
                    else {
                        echo "<a href=\"register.php\">Register</a>";
                    } ?></li>
                <li><?php
                    if (isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
                        echo "<a href=\"account.php?action=logout\">Logout</a>";
                    }
                    else {
                        echo "<a href=\"login.php\">Login</a>";
                    } ?></li>
            </ul>
