<?php
/**
 * Created by PhpStorm.
 * User: Nirav
 * Date: 12/8/2017
 * Time: 12:54 PM
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

$back = $_SERVER['HTTP_REFERER'];

$allrecords =fetch_reports();


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
<h3 style="text-align:center;">Examdetails</h3>
<div class="topright">
    <a href="../index.php?logout='1'" style="color: red;">logout</a></div>
<div class="topleft">
    <a href="<?php echo $myHome?>">Home</a>
    <a href="<?php echo $back?>">back</a>
</div>
<table class="table-style-three"  style="margin: auto">
    <thead>
    <th>College</th>
    <th>School</th>
    <th>Department</th>
    <th>Course</th>
    <th>Exam Type</th>
    <th>Semester</th>
    <th>Year</th>
    <th>Exam Date</th>
    <th>Date Created</th>
    </thead>
    <tbody>
    <?php
    foreach ($allrecords as $displayRecords) { ?>
        <tr>

            <td><?php print $displayRecords['college']; ?></td>
            <td><?php print $displayRecords['school']; ?></td>
            <td><?php print $displayRecords['department']; ?></td>
            <td><?php print $displayRecords['course']; ?></td>
            <td><?php print $displayRecords['examtype']; ?></td>
            <td><?php print $displayRecords['semester']; ?></td>
            <td><?php print $displayRecords['year']; ?></td>
            <td><?php print $displayRecords['examdate']; ?></td>

            <td><?php print $displayRecords['date_created']; ?></td>

        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>

