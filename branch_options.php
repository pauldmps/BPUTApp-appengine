<?php
header('Content-type: text/xml');

require('phpQuery-onefile.php');

$url = 'http://www.bput.ac.in/exam_schedule_ALL.asp';

$type = $_POST['type'];
$semester = $_POST['semester'];


$post = [
    'semester' => $semester,
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


if ($url != null) {


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

    $semesters = $all['#semester option'];

    echo '<bput>';

    foreach ($semesters as $semester) {

        echo '<semester>';
        echo pq($semester)->text();
        echo '</semester>';


    }

    $branches = $all['#branch option'];

    foreach ($branches as $branch) {
        echo '<branch>';
        echo "<![CDATA[";
        echo pq($branch)->text();
        echo "]]>";
        echo '</branch>';

    }

    echo '</bput>';
}


