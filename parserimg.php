<?php

include 'simple_html_dom.php';

$url = 'https://uvelirnii.ru//upload/images/catalog/25/akimow/114160.jpg';
$path = 'images/' . substr($url, strripos($url, '/') + 1, strlen($url));

echo substr($url, strripos($url, '/') + 1, strlen($url));

file_put_contents($path, file_get_contents($url));
