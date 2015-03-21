<?php
$local_file = "Home.htm";//This is the file where we save the information
$remote_file = "http://www.bput.ac.in/"; //Here is the file we are downloading
//$remote_file = "http://google.co.in"; //Here is the file we are downloading


$ch = curl_init();
$ch = curl_init($remote_file);
curl_setopt($ch,CURLOPT_CONNECT_ONLY,TRUE);
curl_setopt($ch, CURLOPT_TIMEOUT, 50);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_ENCODING, "");
curl_exec($ch);
$error_code = curl_errno($ch);
curl_close($ch);
//echo $error_code;

if($error_code==0)
{
 $ch = curl_init();
$fp = fopen ($local_file, 'w+');
$ch = curl_init($remote_file);
curl_setopt($ch, CURLOPT_TIMEOUT, 50);
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_ENCODING, "");
curl_exec($ch);
curl_close($ch);
fclose($fp); 
//echo $error_code;
}


header('Content-type: text/xml');

require('phpQuery/phpQuery.php');
 
$all=phpQuery::newDocumentFileHTML('Home.htm', $charset = 'utf-8');
 
$links = $all['a.myblue'];

echo '<?xml version="1.0" encoding="utf-8"?>';
echo '<bput>';

 if($error_code==0){
	 echo '<current value="true"></current>';
	 }
  else
  {
	 echo '<current value="false"></current>'; 
	  }	 

foreach ($links as $link) {
	
    echo '<notice url = " ';
    echo pq($link)->attr('href');
	echo '">';
	
    
	echo '<![CDATA[';
	echo pq($link)->text();
	echo ']]>';
	echo '</notice>';
	
	}

echo '</bput>';



?>