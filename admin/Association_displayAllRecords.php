<?php
/**
 * Nirav
 */

require_once("..\config.php");
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
    'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>
        Display all record
    </title>
    <!-- Style -- Can also be included as a file usually style.css -->


        <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>

<?php
$temp=$_SESSION['user']['user_type'];
if($temp=='admin')
    $myHome= $adminHome;
else
    $myHome=$profHome;
$back=$_SERVER['HTTP_REFERER'];

$allrecords = fetchAllUsers();
?>
<h3 style="text-align:center;">All user details</h3>
<div class="topright">
    <a href="../index.php?logout='1'" style="color: red;">logout</a></div>
<div class="topleft">
    <a href="<?php echo $myHome?>">Home</a>
    <a href="<?php echo $back?>">back</a>
</div>
<!-- Table goes in the document BODY -->
<table class="table-style-three"  style="margin: auto">
    <thead>
    <!-- display user details header  -->
    <th>username</th>
    <th>College</th>
    <th>Department</th>
    <th>Course</th>
    <th>Section</th>
    </thead>
    <tbody>
    <?php
    foreach ($allrecords as $displayRecords) { ?>
        <tr>
            <td>
                <?php
                $temp='username='. $displayRecords['username'].'&section='. $displayRecords['section'].
                    '&college='. $displayRecords['college'].'&department='. $displayRecords['department'].
                '&course='. $displayRecords['course']?>

                <a href="Association_updateThisRecord.php?<?php print $temp?>" style="color: red;">
                    <?php print $displayRecords['username']; ?></a>
            </td>
            <td><?php print $displayRecords['college']; ?></td>
            <td><?php print $displayRecords['department']; ?></td>
            <td><?php print $displayRecords['course']; ?></td>
            <td><?php print $displayRecords['section']; ?></td>
            <td>
                <a href="Association_deleteThisRecord.php?<?php print $temp ?>" style="color: red;"><?php print "delete"; ?></a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

</body>

</html>
