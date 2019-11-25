<?php

include 'simple_html_dom.php';
require_once 'Classes/PHPExcel.php';


$xls = new PHPExcel();


$xls->setActiveSheetIndex(0);
$sheet = $xls->getActiveSheet();
$sheet->setTitle('Products');
$sheet->setCellValue("A1", 'product_id');
$sheet->setCellValue("B1", 'Name');
$sheet->setCellValue("C1", 'Model');
$sheet->setCellValue("D1", 'Manufacturer');
$sheet->setCellValue("E1", 'Image_name');
$sheet->setCellValue("F1", 'Price');
$sheet->setCellValue("G1", 'description');

$arrayHtml = [];
$arrayParse = [];
$col = 2;

/* 17 */
for ($k = 1; $k < 17; $k++) {
  $html = file_get_html('http://manders.ru/carpet/?PAGEN_1=' . $k);

  foreach ($html->find('.wrap_filter_item_photo_hidden') as $element)
    array_push($arrayHtml, 'http://manders.ru' . $element->href);
}

echo 'Всего ковров: ' . count($arrayHtml);
echo '<br/>';
echo 'Показано: ' . $col;
echo '<br/><br/>';


for ($i = 0; $i < $col; $i++) {
  $string = '';
  $html = file_get_html($arrayHtml[$i]);
  $j = $i + 2;

  /*id*/
  $sheet->setCellValue("A" . $j, $i + 1);

  /*NAME*/
  foreach ($html->find('h1') as $element)
    $sheet->setCellValue("B" . $j, $element->innertext);

  /*MODEL*/
  foreach ($html->find('.card_vendor span') as $element)
    $sheet->setCellValue("C" . $j, $element->innertext);

  /*MANUFACTURER*/
  foreach ($html->find('.chrctr_table tr', 0)->find('td a') as $element)
    $sheet->setCellValue("D" . $j, $element->innertext);

  /*IMAGE_NAME*/
  foreach ($html->find('.card_characteristics #id-card-preview img[data-bx-src]') as $element)
    $sheet->setCellValue("E" . $j, 'http://manders.ru' . $element->src);

  /*PRICE*/
  foreach ($html->find('.roll-price') as $element)
    $string = $element->innertext;
  echo $string;
  $price = trim(substr($string, 0, strpos($string, ' ₽<span>/шт</span>')), ' ');
  $sheet->setCellValue("F" . $j, $price);


  /*foreach ($html->find('.card_slick_item img') as $element)
    $string .= $element->src . ', ';
  $helper = explode(',', $string);
  unset($helper[0]);
  unset($helper[1]);
  unset($helper[2]);
  unset($helper[3]);
  print_r($helper);
  echo ' --- ';

  foreach ($html->find('.chrctr_table_cont') as $element)
    echo $element;
  echo ' --- ';

  echo '<br>';*/
}

$objWriter = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
$objWriter->save('imports.xlsx');


$html->clear();
unset($html);