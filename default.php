<?php
header('Content-type: text/xml');

require('phpQuery-onefile.php');

$all=phpQuery::newDocumentFileHTML('http://www.bput.ac.in/', $charset = 'utf-8');

$links = $all['a.myblue'];


echo '<bput>';

foreach ($links as $link) {

    echo '<notice url = " ';
    echo pq($link)->attr('href');
    echo ' ">';


    echo "<![CDATA[";
    echo pq($link)->text();
    echo "]]>";
    echo '</notice>';

}

echo '</bput>';
