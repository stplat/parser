<?php

$start = microtime(true);

header('Content-Type: text/html; charset=utf-8');

include 'simple_html_dom.php';
include 'parser_category.php';
require_once __DIR__ . '/Classes/PHPExcel.php';
require_once __DIR__ . '/Classes/PHPExcel/Writer/Excel2007.php';
require_once __DIR__ . '/Classes/PHPExcel/IOFactory.php';

set_time_limit(0);

$arrayHtml = [];
$arrayParse = [];

$html = file_get_html("http://magazintroica.ru/");
global $html_in;

$links_category = $parse_category;

/*
 * Список ссылок на категории
*/

function translit($str) {
  $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
  $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
  return str_replace($rus, $lat, $str);
}

// html_entity_decode($link_category->href) !== 'http://magazintroica.ru/specialnoe-predlozhenie/' && html_entity_decode($link_category->href) !== 'http://magazintroica.ru/novinki/'
// html_entity_decode($link_category->href) === 'http://magazintroica.ru/chistyashhie-sredstva-dlya-serebra/' http://magazintroica.ru/kresty/kresty_bolshogo_razmera/


/*if (!empty($links_category)) {
  foreach ($links_category as $number => $link_category) {
    $start = microtime(true);

    if (true) {
      $xls = new PHPExcel();
      $xls = PHPExcel_IOFactory::load(__DIR__ . '/layout.xlsx');

      $xls->setActiveSheetIndex(0);
      $sheet = $xls->getActiveSheet();

      $objWriter = new PHPExcel_Writer_Excel2007($xls);

      $file_name = (string)html_entity_decode($link_category);
      $first_char = strrpos($file_name, '/', -2) + 1;
      $last_char = strrpos($file_name, '/');
      $file_name = substr($file_name, $first_char, $last_char - $first_char);

      $page_category = file_get_html(html_entity_decode($link_category) . '?limit=1000');

      $links_item = $page_category->find('#content .product-thumb');

      foreach ($links_item as $i => $link_item) {
        if (!empty($link_item)) {

          if (!strpos(html_entity_decode($link_item->find('.caption > a', 0)->href), '%')) {
            $page_item = file_get_html(html_entity_decode($link_item->find('.caption > a', 0)->href));

            $brand = str_replace('&nbsp;', ' ', $page_item->find('[itemprop="brand"]', 0)->plaintext);
            $brand = html_entity_decode(trim(preg_replace('/\s+/', ' ', $brand)));

            $article = html_entity_decode(trim(preg_replace('/\s+/', ' ', $page_item->find('[itemprop="model"]', 0)->plaintext)));

            $available = html_entity_decode(trim(preg_replace('/\s+/', ' ', $page_item->find('#product > .col-md-5', 1)->find('.col-md-6', 2)->plaintext)));

            $weight = html_entity_decode(trim(preg_replace('/\s+/', ' ', $page_item->find('#product > .col-md-5', 1)->find('.col-md-6', 3)->plaintext)));
            $price = html_entity_decode(trim(preg_replace('/\s+/', ' ', $page_item->find('.autocalc-product-price', 0)->plaintext)));
            $category = html_entity_decode(trim(preg_replace('/\s+/', ' ', $page_item->find('.breadcrumb li', 1)->plaintext)));

            $other = html_entity_decode(trim(preg_replace('/\s+/', ' ', $page_item->find('[itemprop="description"]', 0))));
            $desc = [];

            $desc_try = $page_item->find('[itemprop="description"]', 0)->find('p');

            for ($h = 0; $h < count($desc_try); $h++) {
              if ($h != 0) {
                $str = (string)$desc_try[$h]->plaintext;
                $str = str_replace('&nbsp;', ' ', $str);
                $str = preg_replace('/\s+/', ' ', html_entity_decode($str));
                $str = trim(str_replace('~', '-', $str));

                array_push($desc, $str);
              }
            }

            $name = html_entity_decode(str_replace('&nbsp;', ' ', $page_item->find('span[itemprop="name"]', 0)->plaintext));
            $name = trim(preg_replace('/\s+/', ' ', $name));
            $name = (str_replace('эмаль', '', $name));
            $name = (str_replace('серебро', '', $name));
            $name = (str_replace('родий', '', $name));
            $name = (str_replace('позолота', '', $name));
            $name = (str_replace('арт.', '', $name));
            $name = preg_replace('/-$/', '', $name);
            $name = str_replace($article, '', $name);
            $name = trim(str_replace(preg_replace("/[^0-9]/", '', $article), '', $name));
            $name = (str_replace(', , Россия', '', $name));
            $name = (str_replace(', , Акимов', '', $name));
            $name = (str_replace(', , Елизавета', '', $name));
            $name = (str_replace(', , Анастасия', '', $name));

            $material_try = [
              'серебро 925', 'позолота 999', 'каучук', 'нержавеющая сталь', 'Серебро', 'фианит', 'сербро 925',
              'Золото (585)', 'Серебро (925)', 'Позолота (999)', 'Ag 925', 'Золото красное 585', 'сербро',
              'кожа', 'бархат', 'Красное и белое золото 585', 'металл', 'натуральный агат', 'натуральная яшма', 'родий',
              'сталь', 'натуральный коралл', 'латунь', 'керамика', 'латунь', 'медь', 'жемчуг', 'топаз', 'дерево'
            ];
            $material = [];

            foreach ($material_try as $str) {
              if (strpos($other, $str) !== false) {
                array_push($material, strtolower($str));
              }
            }

            $technic_try = [
              'Миниатюрный рельеф', 'литье', 'позолота', 'Ручная работа', 'Авторская работа', 'чернение', 'Горячая перегородчатая эмаль',
              'серебрение', 'горячая эмаль', 'биметаллическое литье', 'родирование', 'плетение', 'мелкая пластика', 'чеканка', 'гальванопластика',
              'патинирование', 'золочение'
            ];
            $technic = [];

            foreach ($technic_try as $str) {
              if (strpos($other, $str) !== false) {
                array_push($technic, strtolower($str));
              }
            }

            $image_name = str_replace('&nbsp;', ' ', $name);
            $image_name = preg_replace('/-/', '', $image_name);
            $image_name = preg_replace('/^ /', '', $image_name);
            $image_name = preg_replace('/«/', '', $image_name);
            $image_name = str_replace('/', ' ', $image_name);
            $image_name = preg_replace('/»/', '', $image_name);
            $image_name = preg_replace('/\(/', '', $image_name);
            $image_name = preg_replace('/\)/', '', $image_name);
            $image_name = preg_replace('/:/', '', $image_name);
            $image_name = preg_replace('/\./', '', $image_name);
            $image_name = preg_replace('/,/', '', $image_name);
            $image_name = preg_replace('/"/', '', $image_name);
            $image_name = preg_replace('/”/', '', $image_name);
            $image_name = preg_replace('/\s+/', ' ', $image_name);
            $image_name = preg_replace('/№/', '', $image_name);
            $image_name = str_replace(' ', '_', translit($image_name));
            $image_name = preg_replace('/_$/', '', $image_name);
            $image_name = mb_strtolower($image_name . '_' . str_replace(' ', '_', $article) . '.jpg');

            $links_image = $page_item->find('[data-zoom-image]');
            $urls = [];

            foreach ($links_image as $j => $link_image) {
              $url_image = (string)$link_image->attr['data-zoom-image'];
              $url_image = str_replace('cache/', '', $url_image);
              $url_image = str_replace('-1200x800', '', $url_image);

              array_push($urls, $url_image);
            }

            $urls = array_values(array_unique($urls));

            foreach ($urls as $j => $url) {
              $path = html_entity_decode(__DIR__ . '/items/' . $image_name . ($j !== 0 ? '_' . ($j + 1) : '') . '.jpg');
              file_put_contents($path, file_get_contents($url));
            }

            $sheet->setCellValue('A' . (2 + $i), $name);
            $sheet->setCellValue('B' . (2 + $i), $brand);
            $sheet->setCellValue('C' . (2 + $i), $article);
            $sheet->setCellValue('D' . (2 + $i), $available);
            $sheet->setCellValue('E' . (2 + $i), $weight);
            $sheet->setCellValue('F' . (2 + $i), $price);
            $sheet->setCellValue('G' . (2 + $i), implode($material, ', '));
            $sheet->setCellValue('H' . (2 + $i), implode($technic, ', '));
            $sheet->setCellValue('I' . (2 + $i), implode($desc, ' '));
            $sheet->setCellValue('J' . (2 + $i), $image_name);
            $sheet->setCellValue('K' . (2 + $i), $category);
            $sheet->setCellValue('L' . (2 + $i), $link_category);
            $sheet->setCellValue('M' . (2 + $i), $other);
          }
        }
      }

      //echo $file_name.'</br>';

      $objWriter->save(__DIR__ . '/excel/' . $file_name . '.xlsx');
      $xls->disconnectWorksheets();
      unset($objWriter, $xls);
    }

    $finish = microtime(true);
    $delta = round($finish - $start);
    $minute = floor($delta / 60);
    $second = abs(floor($delta / 60) * 60 - $delta);

    //echo $number + 1 . '. Success - ' . $link_category . '! Execution time:' . $minute . ' min ' . $second . ' sec</br>' . PHP_EOL;
  }
}*/


$finish = microtime(true);
$delta = round($finish - $start);
$minute = floor($delta / 60);
$second = abs(floor($delta / 60) * 60 - $delta);

$html->clear();
unset($html);

//echo '</br>Success! Execution time: ' . $minute . ' min ' . $second . ' sec';

die();


