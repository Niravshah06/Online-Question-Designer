<?php
/**
 * Created by PhpStorm.
 * User: Nirav
 * Date: 11/27/2017
 * Time: 8:51 PM
 */


require_once("../config.php");
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}
$backURL=$_SERVER['HTTP_REFERER'];


$thisCollege = $_GET['college'];
$thisDepartment = $_GET['department'];
$thisCourse= $_GET['course'];
//$thisSection= $_POST['section'];

$thisUserName=  e($_SESSION['user']['username']);
$my_key=$thisUserName.'-'.$thisCollege.'-'.$thisDepartment.'-'.$thisCourse;
//echo $my_key;
$allrecords = fetchAllQuestions($my_key);

$count=mysqli_num_rows($allrecords);
$backURL=$_SERVER['HTTP_REFERER'];
if($count==0){
    echo "Question are not avaible with current selection,please change selection";
echo  PHP_EOL."you will be redirected to previous page in 5 seconds";
header('Refresh: 5; URL='.$backURL);
}
else {
    $temp = $_SESSION['user']['user_type'];
    if ($temp == 'admin')
        $myHome = $adminHome;
    else
        $myHome = $profHome;

    $back = "./ReadQuestions.php";


    ?>
    <html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>
Display all Questions
</title>

    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
<h3 style="text-align:center;">All Question details</h3>
<div class="topright">
    <a href="../index.php?logout='1'" style="color: red;">logout</a></div>
<div class="topleft">
    <a href="<?php echo $myHome?>">Home</a>
    <a href="<?php echo $back?>">back</a>
</div>
<table class="table-style-three"  style="margin: auto">
    <thead>
    <th>Id</th>
    <th>Question</th>
    <th>Type</th>
    <th>Answer</th>
    <th>Choices</th>
    <th>Points</th>
    </thead>
    <tbody>
    <?php
    foreach ($allrecords as $displayRecords) { ?>
        <tr>
            <td>
                <?php $getP="qid=".$displayRecords['qid']."&q_type=".$displayRecords['question_type']; ?>
                <a href="QuestionUpdateThis.php?<?php print $getP ?>" style="color: red;"><?php print $displayRecords['qid'] ?></a>
            </td>
            <td><?php print $displayRecords['question_text']; ?></td>
            <td><?php print $displayRecords['question_type']; ?></td>
            <td><?php print $displayRecords['answer']; ?></td>

            <td><?php


            $choice=getAnswerChoices($displayRecords['qid']);
        foreach ($choice as $c) {
        echo $c['choice'];
            echo "\x20\x20\x20";

        }

                ?></td>
            <td><?php print $displayRecords['points']; ?></td>
            <td>
                <a href="QuestionDelete.php?qid=<?php print $displayRecords['qid'] ?>" style="color: red;"><?php print "delete"; ?></a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
    </html>

<?php }
?>