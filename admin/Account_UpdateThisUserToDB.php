<?php
/**
 * Nirav
 */


require_once("../config.php");
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}
// print_r is to display the contents of an array() in PHP.
//print_r($_POST);

// new values
$thisUserName = $_POST['username'];
$thisEmail = $_POST['email'];
$thisPassword= $_POST['password'];

$msg= updateThisUserAccount($thisUserName,$thisEmail,$thisPassword);


echo $msg;
$url="./Account_displayAllUsers.php";?>
<html><body><br></body></html>
<?php
echo  PHP_EOL."you will be redirected to previous page in 5 seconds";
header('Refresh: 5; URL='.$url);
//echo $thisUserName;