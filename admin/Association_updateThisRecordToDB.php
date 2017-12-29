<?php
/**
 * Nirav
 */


require_once("..\config.php");
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}

// print_r is to display the contents of an array() in PHP.
//print_r($_POST);

// new values
$thisUserName = $_POST['username'];
$thisNewSection = $_POST['section'];
$thisNewCollege= $_POST['college'];
$thisNewCourse= $_POST['course'];
$thisNewDepartment= $_POST['department'];
//echo $thisUserName;
//echo "new ".$thisNewSection.' '. $thisNewCollege.' '. $thisNewCourse.' '. $thisNewDepartment.'          ';
//unset session variables

//old values
$thisOldSection= $_SESSION['section'];
unset($_SESSION['section']);

$thisOldCourse= $_SESSION['course'];
unset($_SESSION['course']);

$thisOldDepartment= $_SESSION['department'];
unset($_SESSION['department']);

$thisOldCollege= $_SESSION['college'];
unset($_SESSION['college']);

//echo "old ".$thisOldSection.' '. $thisOldCollege.' '. $thisOldCourse.' '. $thisOldDepartment;
//Creating a variable to hold the "@return boolean value returned by function updateThisRecord - is boolean 1 with
//successfull and 0 when there is an error with executing the query .
$msg= updateThisRecord($thisUserName,$thisNewSection,$thisNewCollege,$thisNewCourse,$thisNewDepartment,
    $thisOldSection,$thisOldCourse,$thisOldDepartment,$thisOldCollege);


echo $msg;
$url="./Association_displayAllRecords.php";?>
<html><body><br></body></html>
<?php echo  PHP_EOL."you will be redirected to previous page in 5 seconds";
header('Refresh: 5; URL='.$url);
?>