<?php	
ini_set('display_errors',1);
error_reporting(E_ALL);

define("DB_HOST", "mysql.hostinger.ph");
define("DB_USER", "u198333443_admin");
define("DB_PASSWORD", "password");
define("DB_DATABASE", "u198333443_mydb");
define("GOOGLE_API_KEY", "AIzaSyANdJ_--g965Mmhy1F_no0dYZMX4fDCkss");



$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE);

$result = mysqli_query($con,"SELECT reg_id from table_regid");

$registration_ids=array();
while ($row = mysqli_fetch_row($result)) $registration_ids[]=$row[0];
mysqli_free_result($result);

$message= "Hi. this is a test";

$url = 'https://android.googleapis.com/gcm/send';
 
$fields = array(
'registration_ids' => $registration_ids,
'data' => array( "message" => $message ),
);
 
$headers = array(
'Authorization: key=' . GOOGLE_API_KEY,
'Content-Type: application/json'
);

$ch = curl_init();
 

curl_setopt($ch, CURLOPT_URL, $url);
 
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
// Disabling SSL Certificate support temporarly
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
 
        // Close connection
        curl_close($ch);
        echo $result;
?>