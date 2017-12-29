<?php
/**
 * Created by PhpStorm.
 * User: Nirav
 * Date: 12/1/2017
 * Time: 10:52 PM
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
$backURL=$_SERVER['HTTP_REFERER'];



$thisCollege = $_POST['College'];
$thisSchool=$_POST['School'];
$thisDepartment = $_POST['Department'];
$thisCourse= $_POST['Course'];

$thisExamName= $_POST['ExamName'];
$thisExamDate= date('m/d/Y', strtotime($_POST['examDate']));

//print date_format($thisExamDate,"Y/m/d H:i:s");
$thisInsName= $_POST['ins_name'];
$thisInsEmail= $_POST['email'];
$thisSem= $_POST['SemName'];
$thisYear= $_POST['year'];

$allTypes=fetchQuestionTypes();
$thisUserName=  e($_SESSION['user']['username']);
$my_key=$thisUserName.'-'.$thisCollege.'-'.$thisDepartment.'-'.$thisCourse;

//$myfile = fopen("D:/newfile.txt", "w") or die("Unable to open file!");
$head=$thisCollege."\r\n".$thisSchool."\r\n".$thisSem." ".$thisYear."\r\n".$thisExamName."\r\n\r\n"."Date:  ".$thisExamDate."\r\n"."Name:"."\r\n";
//fwrite($myfile,$thisCollege."\r\n".$thisSchool."\r\n".$thisSem."\t".$thisYear."\r\n".$thisExamName."\r\n\r\n"."Date:  ".$thisExamDate."\r\n"."Name:"."\r\n\r\n");
//fclose($myfile);


?>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>
        Exam Options
    </title>

    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
<h3 style="text-align:center;">You have following Question types availble</h3>
<div class="topright">
    <a href="../index.php?logout='1'" style="color: red;">logout</a></div>
<div class="topleft">
    <a href="<?php echo $myHome?>">Home</a>
    <a href="<?php echo $backURL?>">back</a>
</div>
<h3 style="text-align:center;">Please go  and add question if you want to have more number of question in particular type</h3>
<form name="examOptions" action="ExamCreateFiles.php" method="post">
<table class="table-style-three"  style="margin: auto">
    <thead>
    <th>Question Type</th>
    <th>Full Form of Question Type</th>
    <th>Numbe of question available</th>
    <th>Number of question you want</th>
    <tbody>
    <?php
    foreach ($allTypes as $displayRecords) { ?>
    <tr>
        <?php $t=$displayRecords['q_type'];?>
        <td><?php  print $t?></td>
        <td><?php  print $displayRecords['full_form'];?></td>
        <td>
            <?php $count=getCountOfQuestionType($my_key,$t);
           print $count ?>
        </td>
        <td>


            <input  name= "<?php print $t?>" type="number" value="0" min="0" max=<?php  print $count ?>></td>
    </tr>
    <?php }
    ?>

    </tbody>

</table>
    <input type="hidden" name="fileHeader" value="<?php print $head?>"/>
    <input type="hidden" name="myKey" value="<?php print $my_key?>"/>
    <input type="submit" value="Generate Exam" onclick="storeExam()">
</form>
</body>
<script>
    function storeExam() {

        <?php
        createExamReport($thisCollege,$thisSchool,$thisDepartment,$thisCourse,$thisExamName,$thisSem,$thisYear,$thisExamDate);
        ?>
    }

</script>

</html>
