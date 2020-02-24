<?php

require_once '../Classes/PHPExcel.php';
require_once '../Classes/PHPExcel/Writer/Excel2007.php';
require_once '../Classes/PHPExcel/IOFactory.php';

//Подключаемся к БД Хост, Имя пользователя MySQL, его пароль, имя нашей базы
$connect = new mysqli("localhost", "root", "", "srv67580_vech_lar");

//Кодировка данных получаемых из базы
$connect->query("SET NAMES 'utf8' ");


$excel = PHPExcel_IOFactory::load('product_to_category.xlsx');

$maxCell = $excel->getActiveSheet()->getHighestRowAndColumn();
$data = $excel->getActiveSheet()->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);

$query = "INSERT INTO `product_to_category` (`product_id`, `category_id`, `created_at`, `updated_at`) VALUES ";


foreach ($data as $key => $row) {
  if ($key != 0) {
    $query .= "(";
    
    foreach ($row as $i => $col) {
      $query .= "'" . $col . "', ";
    }
    
    $query .= "CURRENT_TIME(), CURRENT_TIME()), ";
  }
}

$query = preg_replace('/, $/', '', $query);
echo htmlspecialchars($query);

//$result = $connect->query($query);







