<?php
/**
 * Created by PhpStorm.
 * User: Nirav
 * Date: 12/1/2017
 * Time: 11:28 AM
 */
require_once("../config.php");
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}
$backURL="./ReadQuestions.php";
$temp = $_SESSION['user']['user_type'];
if ($temp == 'admin')
    $myHome = $adminHome;
else
    $myHome = $profHome;

$qid=$_GET['qid'];
$question_type=$_GET['q_type'];
$question=getQuestionDetails($qid);

$choices=getAnswerChoices($qid);
?>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>
        Update  Question
    </title>

    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
<h3 style="text-align:center;">Update Question details</h3>
<div class="topright">
    <a href="../index.php?logout='1'" style="color: red;">logout</a></div>
<div class="topleft">
    <a href="<?php echo $myHome?>">Home</a>
    <a href="<?php echo $backURL?>">back</a>
</div>
<?php
foreach ($question as $displayRecords) { ?>
<form name="updateQuestionDetails" method="post" action="QuestionUpdateThisToDB.php">
    <table class="table-style-three">
        <tr>
            <td>questiont ID:</td>
            <td><input required type="text"  readonly name="qid" value="<?php print $displayRecords['qid'] ?>"></td>
        </tr>
        <tr>
            <td>questiontext:</td>
            <td><input required type="text" style="width: 400;height: 100" name="questiontext" value="<?php print $displayRecords['question_text'] ?>"></td>
        </tr>
        <tr>
            <td>questionType :</td>
            <td>
                <select id="q_type" name="q_type" >

                    <option value="TF">True/False</option>
                    <option value="ESS">Essay</option>
                    <option value="FIB_PLUS">Fill in the blank</option>
                    <option value="FIL">File response</option>
                    <option value="MA">Multiple Answer</option>
                    <option value="MAT">Matching Answer</option>
                    <option value="MC">Multiple Choice</option>
                    <option value="NUM">Numeric</option>
                    <option value="ORD">Ordering</option>
                    <option value="SR">Short Response</option>
                </select>

            </td>
        </tr>
        <tr>
            <td>Choices :(Separate  by commas in order to update)</td>
            <td><input type="text"  name="choices" value="<?php
                foreach ($choices as $c) {
                    echo $c['choice'];
                    echo ",";

                }

                ?>"></td>
            </td>
        </tr>
        <tr>
            <td>Answer :</td>
            <td><input type="text"  required name="answer" value="<?php print $displayRecords['answer'] ?>"></td>
            </td>
        </tr>
        <tr>
            <td>points :</td>
            <td><input type="number" name="points" value="<?php print $displayRecords['points'] ?>"></td>
        </tr>



    </table>

    <input type="submit" name="submit" value="Update Me">
    <?php } ?>
</form>
</body>
<script>
    function selectQuestionType()
    {
        var php_var = "<?php echo $question_type; ?>";

        for(var i = 0;i < document.getElementById("q_type").length;i++){
            console.log(document.getElementById("q_type").options[i].value);
            if(document.getElementById("q_type").options[i].value === php_var ){
                document.getElementById("q_type").selectedIndex = i;
            }
        }


    }
    window.onload =selectQuestionType;

</script>
</html>
