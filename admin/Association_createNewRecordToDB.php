<?php
/**
 * Nirav Shah
 */

//print_r($_POST); //printing the Super Global POST Array.

require_once("../config.php");
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}

// Assigning $_POST values to individual variables for reuse.
$thisUserName = $_POST['username'];
$thisNewSection = $_POST['section'];
$thisNewCollege= $_POST['college'];
$thisNewCourse= $_POST['course'];
$thisNewDepartment= $_POST['department'];

//Creating a variable to hold the "@return String value returned by function createNewRecord -

$msg = createNewRecord($thisUserName,$thisNewSection,$thisNewCollege,$thisNewCourse,$thisNewDepartment);


echo $msg;
$url=$_SERVER['HTTP_REFERER'];?>
<html><body><br></body></html>
<?php
echo  PHP_EOL."you will be redirected to previous page in 5 seconds";
header('Refresh: 5; URL='.$url);
?>
