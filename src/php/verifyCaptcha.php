<?php
declare(strict_types=1);

session_start([
    'name' => 'captchaSession',
    'cookie_lifetime' => '360',
    'cookie_httponly' => '1',
    'cookie_samesite' => '1',
    'use_cookies'=>'1',
]);

if(empty($_SESSION['captcha'])){
    echo json_encode(['status' => 400, 'msg' => 'captcha is expired - reload']);
    exit;
}
$captcha = $_POST['captcha'] ?? null;
if($captcha){
    if($captcha === $_SESSION['captcha']){
        echo json_encode(['status' => 200, 'msg' => 'captcha is matching']);
        $_SESSION['captchaVerified'] = true;
    }else{
        echo json_encode(['status' => 400, 'msg' => 'captcha is not matching']);
    }
    exit;
}
echo json_encode(['status' => 400, 'msg' => 'sth went wrong']);
//file_put_contents('req.txt', print_r($_REQUEST, true));

