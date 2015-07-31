<?php

header('Content-type: text/xml');

require('phpQuery-onefile.php');

$type = $_POST['type'];
$semester = $_POST['semester'];
$branch = $_POST['branch'];



$post = [
    'semester' => $semester,
    'branch' => $branch,
    'submit2'   => 'Submit',
];

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

try {

    $curl_session = curl_init();

    curl_setopt($curl_session, CURLOPT_URL, $url);
    curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_session, CURLOPT_HEADER, false);

    curl_setopt($curl_session,CURLOPT_POST,1);
    curl_setopt($curl_session,CURLOPT_POSTFIELDS, http_build_query($post));

    $result = curl_exec($curl_session);

    curl_close($curl_session);

}

catch(Exception $e)
{
    echo $e;
}

$all=phpQuery::newDocument($result);

foreach (pq('tr.dselbkg') as $row){
    $columns = array();
    foreach(pq('td',$row) as $td) $columns[] = $td->nodeValue;
    $tableRows[] = $columns;
}

$i=0;
$j=0;

echo '<bput>';

for($i=0;$i<count($tableRows);$i++)
{

  for ($j=0;$j<count($columns);$j++) {
       echo '<item>';

       echo '<index>';
       echo '<![CDATA[';
       echo $tableRows[$i][$j];
       echo ']]>';
       echo '</index>';

       $j++;

       echo '<date>';
       echo '<![CDATA[';
       echo $tableRows[$i][$j];
       echo ']]>';
       echo '</date>';

       $j++;

       echo '<sitting>';
       echo '<![CDATA[';
       echo $tableRows[$i][$j];
       echo $item;
       echo ']]>';
       echo '</sitting>';

       $j++;

       echo '<code>';
       echo '<![CDATA[';
       echo $tableRows[$i][$j];
       echo ']]>';
       echo '</code>';

       $j++;

       echo '<subject>';
       echo '<![CDATA[';
       echo $tableRows[$i][$j];
       echo ']]>';
       echo '</subject>';


       echo '</item>';

   }
}

echo '</bput>';

?>