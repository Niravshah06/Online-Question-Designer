<?php
/**
 * Created by PhpStorm.
 * User: Nirav
 * Date: 12/1/2017
 * Time: 5:10 PM
 */
require_once("../config.php");

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}
$thisCollege = $_GET['college'];
$thisDepartment = $_GET['department'];
$thisCourse= $_GET['course'];
$allrecords = CheckSelection($thisCollege,$thisDepartment,$thisCourse);

$count=mysqli_num_rows($allrecords);
$backURL=$_SERVER['HTTP_REFERER'];
if($count==0){
    echo "You may have selected wrong college/course/dept/section";
    echo  PHP_EOL."you will be redirected to previous page in 5 seconds";
    header('Refresh: 5; URL='.$backURL);
}
else {
    $temp = $_SESSION['user']['user_type'];
    if ($temp == 'admin')
        $myHome = $adminHome;
    else
        $myHome = $profHome;

?>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>
        Add a Exam
    </title>

    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
<h3 style="text-align:center;">Add a Exam</h3>
<div class="topright">
    <a href="../index.php?logout='1'" style="color: red;">logout</a></div>
<div class="topleft">
    <a href="<?php echo $myHome?>">Home</a>
    <a href="<?php echo $backURL?>">back</a>
</div>
<form action="ExamQuestionOptions.php" method="post" id="createExam" >
    <table class="table-style-three">
        <tr>
            <td>College</td>
            <td><input required type="text"  readonly name="College" value="<?php print $thisCollege ?>"></td>
        </tr>
        <tr>
            <td>School</td>
            <td><input required type="text"  placeholder="Please provide school name" name="School" value=""></td>
        </tr>
        <tr>
            <td>Department</td>
            <td><input required type="text"  readonly name="Department" value="<?php print $thisDepartment ?>"></td>
        </tr>
        <tr>
            <td>Course Name</td>
            <td><input required type="text"  readonly name="Course" value="<?php print $thisCourse ?>"></td>
        </tr>
        <tr>
            <td>Exam Name
            <td><select name="ExamName">
                <option value="Midterm Examination">Midterm Examination</option>
                    <option value="Final Examination">Final Examination</option>
                    <option value="Weekly Examination">Weekly Examination</option>
                </select></td>
        </tr>
        <tr>
            <td>Exam Date</td>
            <td><input required type="date"   name="examDate" ></td>
        </tr>
         <tr>
            <td>Instructor Name</td>
            <td><input required type="text"  readonly name="ins_name" value="<?php print $_SESSION['user']['username']; ?>"></td>
        </tr>
        <tr>
            <td>Instructor Email</td>
            <td><input required type="email"   name="email" value="<?php print $_SESSION['user']['email']; ?>"></td>
        </tr>
        <tr>
            <td>Semester</td>
            <td><select name="SemName">
                    <option value="Spring">Spring</option>
                    <option value="Fall">Fall</option>
                </select></td>
        </tr>
        <tr>
            <td>Year</td>
            <td><input type="number" name="year" required min="2017" max="2099" step="1" value="2017" />
            </td>
        </tr>
    </table>
    <input type="submit" name="submit" value="Proceed">
</form>
</body>
</html>

<?php }
?>

