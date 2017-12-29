<?php
/**
 * Created by PhpStorm.
 * User: Nirav
 * Date: 11/29/2017
 * Time: 6:45 PM
 */
require_once("..\config.php");
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}
$backURL=$_SERVER['HTTP_REFERER'];


//session traveeling attributes ,unset once used
$thisOldCourse= $_SESSION['course'];
unset($_SESSION['course']);

$thisOldDepartment= $_SESSION['department'];
unset($_SESSION['department']);

$thisOldCollege= $_SESSION['college'];
unset($_SESSION['college']);

//post parameterts for furthur processing
$thisUserName=  e($_SESSION['user']['username']);
$mykey= $thisUserName.'-'.$thisOldCollege.'-'.$thisOldDepartment.'-'.$thisOldCourse;
$thisQuestionText = $_POST['question_text'];
$thisQuestionPoint= $_POST['points'];
$thisQuestionType = $_POST['q_type'];
//print_r($_POST);
if($thisQuestionType=='MC' || $thisQuestionType=='MA'){

    $thisChoice=$_POST[ 'Choices'];
    $thisAns=$_POST['ans1'];
    echo $thisAns;
    storeChoicesAndAnswer($mykey,$thisQuestionText,$thisQuestionType,$thisAns,$thisQuestionPoint,$thisChoice);

}
if($thisQuestionType=='ORD'){


    $thisAns=$_POST['order'];
    echo $thisAns;
    storeChoicesAndAnswer($mykey,$thisQuestionText,$thisQuestionType,$thisAns,$thisQuestionPoint,null);

}
if($thisQuestionType=='TF'){


    $thisAns=$_POST['TFANS'];
    echo $thisAns;
    $thisChoice="True,False";
    storeChoicesAndAnswer($mykey,$thisQuestionText,$thisQuestionType,$thisAns,$thisQuestionPoint,$thisChoice);

}
if($thisQuestionType=='NUM'){


    $thisAns=$_POST['numans']." ".$_POST['numoff'];
    echo $thisAns;
    storeChoicesAndAnswer($mykey,$thisQuestionText,$thisQuestionType,$thisAns,$thisQuestionPoint,null);

}
if($thisQuestionType=='SR' || $thisQuestionType=='ESS' ){


    $thisAns=$_POST['ansSRorESS'];
    echo $thisAns;
    storeChoicesAndAnswer($mykey,$thisQuestionText,$thisQuestionType,$thisAns,$thisQuestionPoint,null);

}
if($thisQuestionType=='FIL'){


    //$thisAns="You will have to check manually";
    $thisAns="";
    echo $thisAns;
    storeChoicesAndAnswer($mykey,$thisQuestionText,$thisQuestionType,$thisAns,$thisQuestionPoint,null);

}
if($thisQuestionType=='FIB_PLUS'){


    $thisAns=$_POST['fillAns'];
    echo $thisAns;
    storeChoicesAndAnswer($mykey,$thisQuestionText,$thisQuestionType,$thisAns,$thisQuestionPoint,null);

}
if($thisQuestionType=='MAT'){


    $thisleftSide=$_POST['leftSide'];
    $thisRightSide=$_POST['rightSide'];
    $thisAns=$_POST['matchingAns'];
    $leftpieces = explode(",", $thisleftSide);
    $rightpieces = explode(",", $thisRightSide);
    $anspieces = explode(",", $thisAns);
    echo sizeof($leftpieces);
    if(sizeof($leftpieces)==sizeof($rightpieces) && sizeof($leftpieces)==sizeof($anspieces)) {
        echo"hello";
        $choice="";
        for ($i = 0; $i < count($leftpieces); ++$i) {
            $choice=$choice.$leftpieces[$i].','.$rightpieces[$i].',';
        }
        $choice=substr($choice,0,strlen($choice)-1);
        storeChoicesAndAnswer($mykey,$thisQuestionText,$thisQuestionType,$thisAns,$thisQuestionPoint,$choice);
        echo"\x20\x20 $choice";
    }
    else{
        echo "plese select same number of option on both sides and for the answer";
        echo  PHP_EOL."you will be redirected to previous page in 5 seconds";
        header('Refresh: 5; URL='.$backURL);
    }

}
echo "Question has been added";
echo  PHP_EOL."you will be redirected to previous page in 5 seconds";
header('Refresh: 5; URL='.$backURL);