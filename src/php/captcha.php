<?php

ini_set('display_errors', true);
error_reporting(E_ALL);

$config = require __DIR__ . '/config.php';

$width = 160;
$height = 60;

if($config['mode'] === 'development'){
    putenv('GDFONTPATH=/home/grzegorz/www/apps/projects/captcha-app/src/php/');
}else{
    putenv('GDFONTPATH=/home/grzegorz/www/apps/projects/captcha-app/src/php/');
}

$fontName = 'font.ttf';

$img = imagecreatetruecolor($width, $height);
$bgColor = imagecolorallocate($img, 255, 255, 255);
$fontColor = imagecolorallocate($img, 48, 48, 48);

imagefill($img, 0, 0, $bgColor);
$colors = [];
$color = [];
$j = 0;
for($i=140;$i>60;$i-=0.5){
    $color = imagecolorallocate($img, $i, $i, $i);
    $posX = rand(0,160);
    imagerectangle($img,$j,0, 159, 59, $color);
    $j++;
}

$text = null;
for($i=0; $i<5; $i++){
    $number = rand(65, 122);
    if($number >= 91 && $number <=96){
        $i--;
        continue;
    }
    $text .= chr($number);

}

imagettftext($img, 30, 0, 20,45, $fontColor, $fontName, $text);

imagefilter($img, IMG_FILTER_PIXELATE,2);
imagefilter($img, IMG_FILTER_GAUSSIAN_BLUR,1);
imagefilter($img, IMG_FILTER_SMOOTH, 9);
imagefilter($img, IMG_FILTER_COLORIZE, 10, 30, 60);

header('Content-Type: image/png');

echo imagejpeg($img,null, 25);

//echo json_encode(['status'=>'ok']);