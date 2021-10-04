<?php
declare(strict_types=1);

//ini_set('display_errors', 'true');
//error_reporting(E_ALL);

session_start([
    'name' => 'captchaSession',
    'cookie_lifetime' => '360',
    'cookie_httponly' => '1',
    'cookie_samesite' => '1',
    'use_cookies'=>'1',
]);

$config = include __DIR__ . '/config.php' ?? null;

$width = 160;
$height = 60;

if($config === null || $config['mode'] === 'development'){
    putenv('GDFONTPATH=/home/grzegorz/www/apps/projects/captcha-app/src/php/');
}else{
    putenv('GDFONTPATH=...');
}

$fontName = 'font.ttf';

$img = imagecreatetruecolor($width, $height);
$bgColor = imagecolorallocate($img, 255, 255, 255);
$fontColor = imagecolorallocate($img, 48, 48, 48);

imagefill($img, 0, 0, $bgColor);
$colors = [];
$color = [];
$j = 0;

for($i=140;$i>100;$i-=0.25){
    $col = (int) $i;
    $color = imagecolorallocate($img, $col, $col, $col);
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
$_SESSION['captcha'] = $text;
imagettftext($img, 30, 0, 20,45, $fontColor, $fontName, $text);

//imagefilter($img, IMG_FILTER_PIXELATE,2);
imagefilter($img, IMG_FILTER_GAUSSIAN_BLUR,1);
imagefilter($img, IMG_FILTER_SMOOTH, 9);
imagefilter($img, IMG_FILTER_COLORIZE, 40, 40, 40);

header('Content-Type: image/png');

echo imagejpeg($img,null, 10);
