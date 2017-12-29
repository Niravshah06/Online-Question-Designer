<?php
/**
 * Created by PhpStorm.
 * User: Nirav
 * Date: 12/1/2017
 * Time: 2:28 PM
 */
require_once("..\config.php");
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}
//$back = "./ReadQuestions.php";
$back=$_SERVER['HTTP_REFERER'];
$thisQuestionText = $_POST['questiontext'];
$thisQuestionType = $_POST['q_type'];
$thisQuestionID = $_POST['qid'];
$thisPoints=$_POST['points'];

//echo $thisQuestionID;
if($thisQuestionType=='MC' || $thisQuestionType=='MA' || $thisQuestionType=='MAT'){

    $thisChoice=$_POST[ 'choices'];
    $thisAns=$_POST['answer'];
    echo $thisQuestionID;
   updateQuestion($thisQuestionID,$thisQuestionText,$thisQuestionType,$thisAns,$thisPoints,$thisChoice);

}
else if($thisQuestionType=='TF'){


    $thisAns=$_POST['answer'];
    echo $thisAns;
    $thisChoice="True,False";
    updateQuestion($thisQuestionID,$thisQuestionText,$thisQuestionType,$thisAns,$thisPoints,$thisChoice);

}

else if($thisQuestionType=='SR' || $thisQuestionType=='ESS' ||$thisQuestionType=='FIB_PLUS' || $thisQuestionType=='NUM'){


    $thisAns=$_POST['answer'];
    updateQuestion($thisQuestionID, $thisQuestionText, $thisQuestionType, $thisAns, $thisPoints, null);

}
else if($thisQuestionType=='FIL'){


   // $thisAns="You will have to check manually";
   // echo $thisAns;
    $thisAns="";
    updateQuestion($thisQuestionID, $thisQuestionText, $thisQuestionType, $thisAns, $thisPoints, null);

}
else
{
    echo "error occured";
}
echo "Question has been updated";
echo  PHP_EOL."you will be redirected to previous page in 5 seconds";
header('Refresh: 5; URL='.$back);