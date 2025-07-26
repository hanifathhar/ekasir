<?php
session_start();
/* Create a random string */
$char = strtoupper(substr(str_shuffle('abcdefghjkmnpqrstuvwxyz'), 0, 4));
$str = rand(1, 7) . rand(1, 7) . $char;

/* Set the session contents*/
$_SESSION['captcha_id'] = $str;


/* If the session is not present, set the variable to an error message*/
if(!isset($_SESSION['captcha_id']))
	$str = 'ERROR!';
else
	$str = $_SESSION['captcha_id'];

/* Set the content type*/
header('Content-Type: image/png');
header('Cache-Control: no-cache');

/* Create an image from button.png*/
$image = imagecreatefrompng('button.png');
$colour = imagecolorallocate($image, 256, 256, 256);
$font = '../fonts/Anorexia.ttf';
$rotate = rand(-10, 10);
imagettftext($image, 20, $rotate, 18, 30, $colour, $font, $str);

/* Output the image as a png*/
imagepng($image);
