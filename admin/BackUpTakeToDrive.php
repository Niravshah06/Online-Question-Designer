<?php

require_once("../config.php");
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}
$username = "root";
//$password = "";
//$hostname = "localhost";
//$dbname   = "--all-databases";
$dbname   ="project";
$path="d:\backup\backup.sql";

// if mysqldump is on the system path you do not need to specify the full path
//$command = "C:\\xampp\\mysql\\bin\\mysqldump  -u root project > d:\backup\all_db_backup.sql";
$command='C:\\xampp\\mysql\\bin\\mysqldump  -u  '.$username.' '.$dbname .' > ' .$path;
system($command);
if(file_exists($path)==1){
    $msg="Back up has been taken";}
else{
    $msg="unknown error occured,was not able to take back up!Please try again";
}

echo $msg;
$url=$_SERVER['HTTP_REFERER'];?>
    <html><body><br></body></html>
<?php
echo  PHP_EOL."you will be redirected to previous page in 5 seconds";
header('Refresh: 5; URL='.$url);


?>