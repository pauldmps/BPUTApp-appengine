<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

define("DB_HOST", "mysql.hostinger.in");
define("DB_USER", "u949187246_admin");
define("DB_PASSWORD", "password");
define("DB_DATABASE", "u198333443_mydb");

$mail_id = $_POST["mail_id"];
$reg_id = $_POST["reg_id"];


$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE) or die(mysqli_error($con));

$result = mysqli_query($con,"INSERT INTO table_regid(mail_id, reg_id) VALUES('$mail_id','$reg_id')"); 
 
if($result)
echo '0';
else
echo '1';
        
?>