<?php
header('Content-type: text/xml');

require('phpQuery-onefile.php');

$url= $_POST['url'];

$all=phpQuery::newDocumentFileHTML($url, $charset = 'utf-8');

$tags = preg_grep("/style([0-9 -()+]+$)/", explode("\n", $all['td']));

$texts=$all['p'];
$popuptext=$all['td.jeetext'];
$table_head=$all['td.style17'];
$table_body=$all['td.style9'];

echo '<bput>';

foreach ($texts as $text) {
	
	echo '<text>';
	echo '<![CDATA[';
    echo pq($text)->text();
	echo '<br>';
	echo ']]>';
	echo '</text>';
  }

foreach ($popuptext as $text) {
	
	echo '<text>';
	echo '<![CDATA[';
    echo pq($text)->text();
	echo '<br>';
	echo ']]>';
	echo '</text>';
  }

 foreach($table_head as $th) {
	
	echo '<thead>';
	echo '<![CDATA[';
	echo pq($th)->text();
	echo ']]>';
	echo '</thead>';
 }

foreach($table_body as $td) {

	echo '<td>';
	echo '<![CDATA[';
	echo pq($td)->text();
	echo ']]>';
	echo '</td>';
 }
 echo '</bput>';

?>