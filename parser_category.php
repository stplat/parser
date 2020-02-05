<?php
/**
 * Created by PhpStorm.
 * User: platonovso
 * Date: 18.10.2019
 * Time: 14:00
 */

function translit($str) {
  $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
  $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'Yo', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Kh', 'Ts', 'Ch', 'Sh', 'Sch', '', 'Y', '', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'kh', 'c', 'ch', 'sh', 'sch', '', 'y', '', 'e', 'yu', 'ya');
  return str_replace($rus, $lat, $str);
}

echo translit('подвеска_пудо_святителя_спиридона_стоптанный_тапочек');

global $parse_category;

$parse_category = [
  //'http://magazintroica.ru/specialnoe-predlozhenie/',
  //'http://magazintroica.ru/novinki/',
  /*'http://magazintroica.ru/pravoslavnye-businy/',
  'http://magazintroica.ru/pravoslavnye-businy/braslety-iz-busin/',
  'http://magazintroica.ru/pravoslavnye-businy/tri-businy-i-braslet-v-podarok/',
  'http://magazintroica.ru/pravoslavnye-businy/braslety-dlya-busin/',
  'http://magazintroica.ru/pravoslavnye-businy/nabory-s-businami/',
  'http://magazintroica.ru/pravoslavnye-businy/sergi-perexodniki-pod-businy/',
  'http://magazintroica.ru/kresty/',
  'http://magazintroica.ru/kresty/kresty_bolshogo_razmera/',
  'http://magazintroica.ru/kresty/kresty_srednego_razmera/',
  'http://magazintroica.ru/kresty/krestilnye_krestiki/',
  'http://magazintroica.ru/kresty/kresty_so_vstavkami/',
  'http://magazintroica.ru/kresty/vosmikonechnye-kresty/',
  'http://magazintroica.ru/kresty/golgofskij-krest/',
  'http://magazintroica.ru/kresty/zhenskie-krestiki/',
  'http://magazintroica.ru/kresty/muzhskie-kresty/',
  'http://magazintroica.ru/kresty/detskie--krestiki/',
  'http://magazintroica.ru/kresty/kresty-s-emalyu/',
  'http://magazintroica.ru/kresty/kresty-serebro/',
  'http://magazintroica.ru/kresty/zolotye-krestiki/',
  'http://magazintroica.ru/ladanki/',
  'http://magazintroica.ru/obrazki/',
  'http://magazintroica.ru/obrazki/zhetony/',
  'http://magazintroica.ru/obrazki/obrazki_angelov/',
  'http://magazintroica.ru/obrazki/obrazki_bogorodicy/',
  'http://magazintroica.ru/obrazki/obrazki_bogorodicy/vladimirskaya-ikona-bozhiej-materi2/',
  'http://magazintroica.ru/obrazki/obrazki_bogorodicy/ikona-bozhiej-materi-znamenie/',
  'http://magazintroica.ru/obrazki/obrazki_bogorodicy/ikona-bozhiej-materi-semistrelnaya2/',
  'http://magazintroica.ru/obrazki/obrazki_bogorodicy/kazanskaya-ikona-bozhiej-materi/',
  'http://magazintroica.ru/obrazki/obrazki_bogorodicy/tixvinskaya-ikona-bozhiej-materi/',
  'http://magazintroica.ru/obrazki/obrazki_bogorodicy/feodorovskaya-ikona-bozhiej-materi/',
  'http://magazintroica.ru/obrazki/obrazki_bogorodicy/drugie-ikony-bozhiej-materi/',
  'http://magazintroica.ru/obrazki/obrazki_imennye/',
  'http://magazintroica.ru/obrazki/zhenskie_imennye_obrazki/',
  'http://magazintroica.ru/obrazki/zhenskie_imennye_obrazki/blazhennaya-matrona-moskovskaya/',
  'http://magazintroica.ru/obrazki/zhenskie_imennye_obrazki/svyataya-blazhennaya-kseniya-peterburgskaya/',
  'http://magazintroica.ru/obrazki/muzhskie_imennye_obrazki/',
  'http://magazintroica.ru/obrazki/muzhskie_imennye_obrazki/arxangel-mixail/',
  'http://magazintroica.ru/obrazki/muzhskie_imennye_obrazki/velikomuchenik-georgij-pobedonosec/',
  'http://magazintroica.ru/obrazki/muzhskie_imennye_obrazki/velikomuchenik-panteleimon-celitel/',
  'http://magazintroica.ru/obrazki/muzhskie_imennye_obrazki/prepodobnyj-sergij-radonezhskij/',
  'http://magazintroica.ru/obrazki/muzhskie_imennye_obrazki/svyatitel-nikolaj-chudotvorec/',
  'http://magazintroica.ru/obrazki/muzhskie_imennye_obrazki/svyatoj-blagovernyj-knyaz-aleksandr-nevskij/',
  'http://magazintroica.ru/obrazki/obrazki_svjatyh/',
  'http://magazintroica.ru/obrazki/podveski/',
  'http://magazintroica.ru/obrazki/obrazki-s-emalyu/',
  'http://magazintroica.ru/obrazki/intaliya/',
  'http://magazintroica.ru/obrazki/obrazki-serebro/',
  'http://magazintroica.ru/moshheviki_i_skladni/',
  'http://magazintroica.ru/oxrannye-kolca/',
  'http://magazintroica.ru/oxrannye-kolca/kolca-s-emalyu/',
  'http://magazintroica.ru/oxrannye-kolca/perstni/',
  'http://magazintroica.ru/oxrannye-kolca/pozolochennye-kolca/',
  'http://magazintroica.ru/oxrannye-kolca/serebryanye-kolca/',
  'http://magazintroica.ru/sergi/',
  'http://magazintroica.ru/pasxalnye-yajca/',
  'http://magazintroica.ru/cepi/',
  'http://magazintroica.ru/cepi/litye-cepi/',
  'http://magazintroica.ru/cepi/serebrjanye_cepi/',
  'http://magazintroica.ru/cepi/pozolochennye_cepi/',
  'http://magazintroica.ru/cepi/braslety/',
  'http://magazintroica.ru/cepi/braslety/braslety_na_ruku/',
  'http://magazintroica.ru/cepi/perexodniki-dlya-cepej-i-shnurov/',
  'http://magazintroica.ru/braslety-s-molitvoj/',
  'http://magazintroica.ru/braslety-s-molitvoj/braslety-kamennye/',
  'http://magazintroica.ru/braslety-s-molitvoj/braslety-na-nitke/',
  'http://magazintroica.ru/braslety-s-molitvoj/braslety-pozolochennye/',
  'http://magazintroica.ru/braslety-s-molitvoj/braslety-serebryanye/',
  'http://magazintroica.ru/braslety-s-molitvoj/derevyannye-braslety/',
  'http://magazintroica.ru/braslety-s-molitvoj/kozhanye-braslety/',
  'http://magazintroica.ru/braslety-s-molitvoj/pletenye-braslety/',
  'http://magazintroica.ru/bukvicy/',
  'http://magazintroica.ru/izdeliya-iz-kozhi-s-molitvoj/',*/
  'http://magazintroica.ru/shnurki_i_gajtany/',
  /*'http://magazintroica.ru/zaponki/',
  'http://magazintroica.ru/pravoslavnye-chetki/',
  'http://magazintroica.ru/lozhki/',
  'http://magazintroica.ru/serebryanye-izdeliya-raznoe/',
  'http://magazintroica.ru/chasy-naruchnye/',
  'http://magazintroica.ru/yuvelirnaya-upakovka/',
  'http://magazintroica.ru/ikony/',
  'http://magazintroica.ru/ikony/ikony-avtomobilnye/',
  'http://magazintroica.ru/ikony/ikony-gospodni/',
  'http://magazintroica.ru/ikony/ikony-bogorodicy/',
  'http://magazintroica.ru/ikony/ikony-svyatyx/',
  'http://magazintroica.ru/ikony/ikony-svyatyx/ikony-sv-georgiya-pobedonosca/',
  'http://magazintroica.ru/ikony/ikony-svyatyx/ikony-sv-nikolaya-chudotvorca/',
  'http://magazintroica.ru/ikony/ikony-svyatyx/ikony-sv-serafima-sarovskogo/',
  'http://magazintroica.ru/ikony/ikony-svyatyx/ikony-sv-sergiya-radonezhskogo/',
  'http://magazintroica.ru/ikony/ikony-angelov/',
  'http://magazintroica.ru/ikony/ikony-prazdnikov/',
  'http://magazintroica.ru/ikony/ikony-s-okladom/',
  'http://magazintroica.ru/krestilnye-nabory/',
  'http://magazintroica.ru/krestilnye-nabory/dlya-devochek/',
  'http://magazintroica.ru/krestilnye-nabory/dlya-malchikov/',
  'http://magazintroica.ru/svechi-dekorativnye/',
  'http://magazintroica.ru/svechi-dekorativnye/svechi-pasxalnye/',
  'http://magazintroica.ru/svechi-dekorativnye/svechi-rozhdestvenskie/',
  'http://magazintroica.ru/suveniry/',
  'http://magazintroica.ru/chistyashhie-sredstva-dlya-serebra/'*/
];