<?php

require_once '../Classes/PHPExcel.php';
require_once '../Classes/PHPExcel/Writer/Excel2007.php';
require_once '../Classes/PHPExcel/IOFactory.php';

//Подключаемся к БД Хост, Имя пользователя MySQL, его пароль, имя нашей базы
$connect = new mysqli("localhost", "root", "", "vecheria_laravel");

//Кодировка данных получаемых из базы
$connect->query("SET NAMES 'utf8' ");


$excel = PHPExcel_IOFactory::load('items.xlsx');

$maxCell = $excel->getActiveSheet()->getHighestRowAndColumn();
$data = $excel->getActiveSheet()->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);

$array_image = [];

foreach ($data as $key => $row) {
  if ($key != 0) {

    $excel_image_path = $row['16'];
    $isset = strpos($excel_image_path, ';');

    if ($isset) {
      $arr = (explode(';', $excel_image_path));
      $array_image = array_merge($array_image, $arr);
    } else {
      array_push($array_image, $excel_image_path);
    }
  }
}

echo '<pre>';
print_r($array_image);

/*foreach ($array_image as $path) {
  if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/items/' . $path)) {
    $file = $_SERVER['DOCUMENT_ROOT'] . '/items/' . $path;
    $newfile = $_SERVER['DOCUMENT_ROOT'] . '/items_new/' . $path;

    if (!copy($file, $newfile)) {
      echo "не удалось скопировать $file...\n";
    }
  }
}*/



//$query = preg_replace('/, $/', '', $query);
//echo $query;

//$result = $connect->query($query);







