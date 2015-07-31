<?php

require('phpQuery-onefile.php');

//$type = $_POST['type'];

$url = 'http://www.bput.ac.in/exam_schedule_ALL.asp';



/*
if($type==='B.TECH' or $type==='B.TECH' or $type==='MBA'or $type==='B.ARCH' or $type==='B.PHARM' or $type==='B.HMCT'or $type==='MCA' or $type==='M.TECH' or $type==='M.PHARM' or $type==='MAM' or $type==='MSC')
{
    $url = 'http://www.bput.ac.in/exam_schedule_ALL.asp?prog='.$type;
}
elseif($type==='BACK')
{
    $url = 'http://www.bput.ac.in/exam_schedule_BACK.asp';
}
elseif($type==='SPECIAL')
{
    $url ='http://www.bput.ac.in/exam_schedule_SPECIAL.asp';
}
else
{
    $url = null;
}
*/


$all=phpQuery::newDocumentFileHTML($url, $charset = 'utf-8');

/*

$options = $all['a.myellow'];

foreach ($options as $option)
{
    echo pq($option)->text();
    echo '<br>';

}
*/

$semesters = $all['#semester option'];

foreach ($semesters as $semester)
{
    echo pq($semester)->text();
    echo '<br>';

}



?>