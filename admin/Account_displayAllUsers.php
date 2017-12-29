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

<html>
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

$allrecords = fetchAllUserAccounts();
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
    <th>email</th>
    <th>user Type</th>
    <th>Password</th>
    </thead>
    <tbody>
    <?php
    foreach ($allrecords as $displayRecords) { ?>
        <tr>
            <td>
                <?php
                $temp='username='. $displayRecords['username'].'&email='. $displayRecords['email'].
                    '&user_type='. $displayRecords['user_type'].'&password='. $displayRecords['password']?>


                <a href="Account_updateThisUser.php?<?php print $temp?>" style="color: red;">
                    <?php print $displayRecords['username']; ?></a>
            </td>
            <td><?php print $displayRecords['email']; ?></td>
            <td><?php print $displayRecords['user_type']; ?></td>
            <td><?php print $displayRecords['password']; ?></td>
            <td>
                <a href="./Account_DeleteThisUser.php?username=<?php print $displayRecords['username'] ?>" style="color: red;"><?php print "delete"; ?></a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

</body>

</html>
