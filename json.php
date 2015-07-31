<?php
header('Content-type: application/json');

require('phpQuery-onefile.php');
 
$all=phpQuery::newDocumentFileHTML('http://www.bput.ac.in/', $charset = 'utf-8');
 
$links = $all['a.myblue'];

echo '{"notice" : [';

foreach ($links as $link) {
	
    echo '{"url" : "';
    echo str_replace('/','\/',pq($link)->attr('href'));
	echo ' ",';

    
	echo '"text" : "';
	$str= pq($link)->text();
	echo trim($str);
	echo '"},';
	
	
}

echo '{}]}';

?>