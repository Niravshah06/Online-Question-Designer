<?php
/**
 * Created by PhpStorm.
 * User: Nirav
 * Date: 12/2/2017
 * Time: 6:18 PM
 */
require_once("../config.php");

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}
$temp = $_SESSION['user']['user_type'];
if ($temp == 'admin')
    $myHome = $adminHome;
else
    $myHome = $profHome;
$backURL="./ReadQuestions.php";

$examPoint=100;
$sum=0;

$my_key=$_POST['myKey'];

///get selection values
$thisEss=$_POST['ESS'];
$thisTF=$_POST['TF'];
$thisFIB_P=$_POST['FIB_PLUS'];
$thisFIL=$_POST['FIL'];
$thisMA=$_POST['MA'];
$thisMAT=$_POST['MAT'];
$thisMC=$_POST['MC'];
$thisNUM=$_POST['NUM'];
$thisORD=$_POST['ORD'];
$thisSR=$_POST['SR'];

$head=$_POST['fileHeader'];

//start collecting questions
$SelectedIds=array();
if($thisEss>0)
{//get qid array for given question type and key
    $EssArray=array();
    $a=getQuestionIdFromType($my_key,"ESS");
    foreach ($a as $b){
        array_push($EssArray,$b['qid']);}
    if($thisEss==1){
        $random_key = array_rand($EssArray);
        array_push($SelectedIds,$EssArray[$random_key]);

    }
    else {

        $random_keys = array_rand($EssArray, $thisEss);
        for ($x = 0; $x < $thisEss; $x++) {
            array_push($SelectedIds, $EssArray[$random_keys[$x]]);
        }
    }
 //   print_r($SelectedIds);
//echo  $thisEss;
}
if($thisTF>0)
{
    $TFArray=array();
    $a=getQuestionIdFromType($my_key,"TF");
    foreach ($a as $b){
        array_push($TFArray,$b['qid']);}
    if($thisTF==1){
        $random_key = array_rand($TFArray);
        array_push($SelectedIds,$TFArray[$random_key]);

    }
    else {

        $random_keys = array_rand($TFArray, $thisTF);
        for ($x = 0; $x < $thisTF; $x++) {
            array_push($SelectedIds, $TFArray[$random_keys[$x]]);
        }
    }
   // print_r($SelectedIds);


}
if($thisFIB_P>0)
{
    $FIB_PArray=array();
    $a=getQuestionIdFromType($my_key,"FIB_PLUS");
    foreach ($a as $b){
        array_push($FIB_PArray,$b['qid']);}

        if($thisFIB_P==1){
            $random_key = array_rand($FIB_PArray);
            array_push($SelectedIds,$FIB_PArray[$random_key]);

        }
       else {
           $random_keys = array_rand($FIB_PArray, $thisFIB_P);

           for ($x = 0; $x < $thisFIB_P; $x++) {
               array_push($SelectedIds, $FIB_PArray[$random_keys[$x]]);
           }
       }



}
if($thisFIL>0)
{
    $FILArray=array();

    $a=getQuestionIdFromType($my_key,"FIL");
    foreach ($a as $b){
        array_push($FILArray,$b['qid']);}
    if($thisFIL==1){
        $random_key = array_rand($FILArray);
        array_push($SelectedIds,$FILArray[$random_key]);

    }
    else {
        $random_keys = array_rand($FILArray, $thisFIL);
        for ($x = 0; $x < $thisFIL; $x++) {
            array_push($SelectedIds, $FILArray[$random_keys[$x]]);
        }
    }



}
if($thisMA>0)
{//get qid array for given question type and key
    $MAArray=array();
    $a=getQuestionIdFromType($my_key,"MA");
    foreach ($a as $b){
        array_push($MAArray,$b['qid']);}

    if($thisMA==1){
        $random_key = array_rand($MAArray);
        array_push($SelectedIds,$MAArray[$random_key]);

    }
    else {
        $random_keys = array_rand($MAArray, $thisMA);
        for ($x = 0; $x < $thisMA; $x++) {
            array_push($SelectedIds, $MAArray[$random_keys[$x]]);
        }
    }



//echo  $thisEss;
}
if($thisMAT>0)
{//get qid array for given question type and key
    $MATArray=array();
    $a=getQuestionIdFromType($my_key,"MAT");
    foreach ($a as $b){
        array_push($MATArray,$b['qid']);}

    if($thisMAT==1){
        $random_key = array_rand($MATArray);
        array_push($SelectedIds,$MATArray[$random_key]);

    }
    else {
        $random_keys = array_rand($MATArray, $thisMAT);
        for ($x = 0; $x < $thisMAT; $x++) {
            array_push($SelectedIds, $MATArray[$random_keys[$x]]);
        }
    }



//echo  $thisEss;
}
if($thisMC>0)
{//get qid array for given question type and key
    $MCArray=array();
    $a=getQuestionIdFromType($my_key,"MC");
    foreach ($a as $b){
        array_push($MCArray,$b['qid']);}

    if($thisMC==1){
        $random_key = array_rand($MCArray);
        array_push($SelectedIds,$MCArray[$random_key]);

    }
    else {
        $random_keys = array_rand($MCArray, $thisMC);
        for ($x = 0; $x < $thisMC; $x++) {
            array_push($SelectedIds, $MCArray[$random_keys[$x]]);
        }
    }



//echo  $thisEss;
}
if($thisNUM>0)
{//get qid array for given question type and key
    $NUMArray=array();
    $a=getQuestionIdFromType($my_key,"NUM");
    foreach ($a as $b){
        array_push($NUMArray,$b['qid']);}

    if($thisNUM==1){
        $random_key = array_rand($NUMArray);
        array_push($SelectedIds,$NUMArray[$random_key]);

    }
    else {
        $random_keys = array_rand($NUMArray, $thisNUM);
        for ($x = 0; $x < $thisNUM; $x++) {
            array_push($SelectedIds, $NUMArray[$random_keys[$x]]);
        }
    }



//echo  $thisEss;
}
if($thisORD>0)
{//get qid array for given question type and key
    $ORDArray=array();
    $a=getQuestionIdFromType($my_key,"ORD");
    foreach ($a as $b){
        array_push($ORDArray,$b['qid']);}

    if($thisORD==1){
        $random_key = array_rand($ORDArray);
        array_push($SelectedIds,$ORDArray[$random_key]);

    }
    else {
        $random_keys = array_rand($ORDArray, $thisORD);
        for ($x = 0; $x < $thisORD; $x++) {
            array_push($SelectedIds, $ORDArray[$random_keys[$x]]);
        }
    }



//echo  $thisEss;
}
if($thisSR>0)
{//get qid array for given question type and key
    $SRArray=array();
    $a=getQuestionIdFromType($my_key,"SR");
    foreach ($a as $b){
        array_push($SRArray,$b['qid']);}

    if($thisSR==1){
        $random_key = array_rand($SRArray);
        array_push($SelectedIds,$SRArray[$random_key]);

    }
    else {
        $random_keys = array_rand($SRArray, $thisSR);
        for ($x = 0; $x < $thisSR; $x++) {
            array_push($SelectedIds, $SRArray[$random_keys[$x]]);
        }
    }


}
$allrecords=array();
foreach ($SelectedIds as $qid)
{
    $displayRecord=getQuestionDetails($qid);
    $data= mysqli_fetch_assoc($displayRecord);
    array_push($allrecords,$data);

}
?>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>
        Display Exam Questions
    </title>

    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
<h3 style="text-align:center;">All Selected Exam Question details</h3>
<div class="topright">
    <a href="../index.php?logout='1'" style="color: red;">logout</a></div>
<div class="topleft">
    <a href="<?php echo $myHome?>">Home</a>
    <a href="<?php echo $backURL?>">back</a>
</div>
<form  method="post" style="width: auto">
<table class="table-style-three"  style="margin: auto;width: auto">
    <thead>
    <th>Id</th>
    <th>Type</th>
    <th>Question</th>
    <th>Points</th>

    <th>Answer</th>
    <th>Choices</th>
    </thead>
    <tbody>
    <?php
    foreach ($allrecords as $displayRecords) { ?>
        <tr>
            <td>
                 <?php print $displayRecords['qid'] ?>
            </td>
            <td><input name=<?php print $displayRecords['qid'].$displayRecords['question_type'].'type'?>

                       type="text" readonly value="<?php print $displayRecords['question_type']; ?>"></td>


            <td><input name=<?php print $displayRecords['qid'].'text'?> type="text" value="<?php print $displayRecords['question_text']; ?>"></td>

            <td><input name=<?php print $displayRecords['qid'].'points'?> type="number" value= "<?php print $displayRecords['points']; ?>"></td>

            <td><input name=<?php print $displayRecords['qid'].'ans'?>
                       type="text" value=" <?php print $displayRecords['answer']; ?>"></td>

            <td>
                <input name=<?php print $displayRecords['qid'].'choice'?> type="text" value= "<?php
                $choice=getAnswerChoices($displayRecords['qid']);
                foreach ($choice as $c) {
                    echo $c['choice'];
                    echo ",";

                }

                ?>"></td>





        </tr>
    <?php } ?>
    </tbody>
</table>

    <input type="hidden" name="fileHeader" value="<?php print $head?>"/>
    <button type="submit" formaction="./ExamFileQuestionOnly.php">create Class File(Questions Only)</button>
    <button type="submit" formaction="./ExamBBFile.php">create BB File</button>

</form>
</body>
</html>






