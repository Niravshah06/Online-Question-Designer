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

// Assigning $_POST values to individual variables for reuse.
$username = $_GET['username'];
$section=$_GET['section'];

//Creating a variable to hold the "@return String  value returned by function DeleteThsiREcord -
$msg = deleteThisRecord($username,$section);

echo $msg;
$url=$_SERVER['HTTP_REFERER'];?>
<html><body><br></body></html>
<?php
echo  PHP_EOL."you will be redirected to previous page in 3 seconds";
header('Refresh: 3; URL='.$url);
?>