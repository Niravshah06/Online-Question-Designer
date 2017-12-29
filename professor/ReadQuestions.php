<?php
/**
 * Created by PhpStorm.
 * User: Nirav
 * Date: 11/27/2017
 * Time: 8:35 PM
 */
require_once("..\config.php");
$temp=$_SESSION['user']['user_type'];
if($temp=='admin')
    $myHome= $adminHome;
else
    $myHome=$profHome;
$back=$_SERVER['HTTP_REFERER'];
$allrecords =SelectDepartmentCourseAndCollege();

?>

<html >
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>
        Read Questions
    </title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
<h3 style="text-align:center;">Please Select Options</h3>
<div class="topright">
    <a href="../index.php?logout='1'" style="color: red;">logout</a></div>
<div class="topleft">
    <a href="<?php echo $myHome?>">Home</a>
    <a href="<?php echo $back?>">back</a>
</div>



    <?php
    $colleges= array();
    $departments=array();
    $courses= array();
    $sections=array();
    foreach ($allrecords as $displayRecords) { ?>

      <?php
        $colleges[]=$displayRecords['college'];
        $departments[]=$displayRecords['department'];
        $courses[]=$displayRecords['course'];
        $sections[]=$displayRecords['section'];

     }
     //removing duplicates if any
    $colleges=array_unique($colleges);
    $departments=array_unique($departments);
    $courses=array_unique($courses);
    $sections=array_unique($sections);
?>
<form name="readParameters"  method="get">
     <table class="table-style-three">

    <label>Please Select College         </label>
    <select name="college" id="college">

  <?php
    foreach($colleges as $c) { ?>
        <option value="<?php echo $c ?>"><?php echo $c ?></option>
        <?php
    } ?>
</select>
    <br><br>
    <label>Please Select Department       </label>
    <select name="department" id="department">

        <?php
        foreach($departments as $d) { ?>
            <option value="<?php echo $d ?>"><?php echo $d ?></option>
            <?php
        } ?>
    </select>
    <br><br>
    <label>Please Select Course             </label>
    <select name="course" id="course">

        <?php
        foreach($courses as $d) { ?>
            <option value="<?php echo $d ?>"><?php echo $d ?></option>
            <?php
        } ?>
    </select>
         <!-- <br><br>
   <label>Please Select Section           </label>
    <select name="section" id="section">

        <?php
        foreach($sections as $d) { ?>
            <option value="<?php echo $d ?>"><?php echo $d ?></option>
            <?php
        } ?>
    </select>-->
    <br><br>
         <button type="submit" formaction="./QuestionsShow.php">Show Questions</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <button type="submit" formaction="./QuestionAdd.php">Add Question</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <button type="submit" formaction="./QuestionsShow.php">Update Question</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <button type="submit" formaction="./QuestionsShow.php">Delete Question</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <br><br><button type="submit" formaction="./ExamCreateForm.php"><b>create a exam</b></button>

     </table>
</form>
</body>
</html>