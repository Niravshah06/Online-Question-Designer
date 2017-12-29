<?php
/**
 * Created by PhpStorm.
 * User: Nirav
 * Date: 11/28/2017
 * Time: 11:05 PM
 */
require_once("../config.php");
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}
$thisQid = $_GET['qid'];

deleteQuestionAndChoices($thisQid);
$backURL=$_SERVER['HTTP_REFERER'];
    echo  PHP_EOL."you will be redirected to previous page in 5 seconds";
    header('Refresh: 5; URL='.$backURL);
?>