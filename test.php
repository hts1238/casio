<?php

/*require("../disco-site-php/vendor/autoload.php");

//use Symfony\Component\HttpClient\HttpClient;

$httpClient = HttpClient::create();
$response = $httpClient->request('GET', 'http://www.oldtimeworld.host.ru/apps/minicat/showmini.asp?n=AWG-M100-1A');

$content = $response->getContent();
echo $content . "\n";*/

header("content-type: image/jpg");
echo file_get_contents("http://www.oldtimeworld.host.ru/images/casio/big/AWG-M100-1A.jpg");