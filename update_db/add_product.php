<?php

require_once '../Classes/PHPExcel.php';
require_once '../Classes/PHPExcel/Writer/Excel2007.php';
require_once '../Classes/PHPExcel/IOFactory.php';

//Подключаемся к БД Хост, Имя пользователя MySQL, его пароль, имя нашей базы
//$connect = new mysqli("localhost", "root", "", "srv67580_vech_lar");

//Кодировка данных получаемых из базы
//$connect->query("SET NAMES 'utf8' ");

function translit($str) {
  $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
  $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Kh', 'Ts', 'Ch', 'Sh', 'Sch', '', 'Y', '', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'kh', 'c', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya');
  return str_replace($rus, $lat, $str);
}

$excel = PHPExcel_IOFactory::load('product_sushi.xlsx');

$maxCell = $excel->getActiveSheet()->getHighestRowAndColumn();
$data = $excel->getActiveSheet()->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);

$query = "TRUNCATE TABLE product; ";
$query .= "INSERT INTO `product` (`product_id`, `category_id`, `name`, `slug`, `manufacturer`, `article`, `meta_keywords`, `meta_description`, `meta_title`, `available`, `weight`, `price`, `dimension`, `comment`, `material`, `technic`, `description`, `video`, `image_path`, `similar_product_id`, `created_at`, `updated_at`) VALUES ";


foreach ($data as $key => $row) {
  if ($key != 0) {
    $query .= "(";

    foreach ($row as $i => $col) {
      $query .= "'" . $col . "', ";
    }

    //$query .= "CURRENT_TIME(), CURRENT_TIME()), ";
    $query = substr($query, 0, -2);
    $query .= "), ";
  }
}

$query = preg_replace('/, $/', '', $query);
echo htmlspecialchars($query);

//$result = $connect->query($query);







