<?php

require('phpQuery-onefile.php');

$url= $_POST['url'];

$all=phpQuery::newDocumentFileHTML($url, $charset = 'utf-8');

$tags = preg_grep("/style([0-9 -()+]+$)/", explode("\n", $all['td']));

$table_head=$all['td.style17'];

foreach ($tags as $tag) {

    echo pq($tag)->text();

   // $table_body += $all['td' . $tag];
}


/*
foreach($table_body as $td) {

    echo '<td>';
    echo '<![CDATA[';
    echo pq($td)->text();
    echo ']]>';
    echo '</td>';
}
echo '</bput>';

*/

?>