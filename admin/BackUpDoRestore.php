<?php

require_once("../config.php");
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}
$username = "root";
//$password = "";
//$hostname = "localhost";
$dbname   = "project";
$path="d:\backup\backup.sql";


if(file_exists($path)==1){

// if mysql is on the system path you do not need to specify the full path
//$command = "C:\\xampp\\mysql\\bin\\mysql  -u root project < d:\backup\all_db_backup.sql";
$command='C:\\xampp\\mysql\\bin\\mysql -u  '.$username.' '.$dbname .' < ' .$path;
    system($command);
    $msg="Restoration Process is complete";
}
else{
    $msg="Back up file does not exist";
}






echo $msg;
$url=$_SERVER['HTTP_REFERER'];?>
    <html><body><br></body></html>
<?php
echo  PHP_EOL."you will be redirected to previous page in 5 seconds";
header('Refresh: 5; URL='.$url);


?>