<?php
/**
 * Nirav
 */

//print_r($_POST); //printing the Super Global POST Array.

require_once("config.php");
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}

// Assigning $_POST values to individual variables for reuse.

$username = $_SESSION['user']['username'];
$oldpassword=$_POST['password'];
$newPassword = $_POST['newPassword1'];



$msg = updatePassword($username,$oldpassword,$newPassword);


echo $msg;
$url=$_SERVER['HTTP_REFERER'];?>
<html><body><br>

<?php
echo  PHP_EOL."you will be redirected to previous page in 5 seconds";
header('Refresh: 5; URL='.$url);

?>
