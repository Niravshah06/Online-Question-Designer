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
         Create New Record
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

?>
<h3 style="text-align:center;">Please enter Values to Insert record</h3>
<div class="topright">
    <a href="../index.php?logout='1'" style="color: red;">logout</a></div>
<div class="topleft">
    <a href="<?php echo $myHome?>">Home</a>
    <a href="<?php echo $back?>">back</a>
</div>

<form name="createNewRecord" action="Association_createNewRecordToDB.php" method="post">
    <!-- Table goes in the document BODY -->
    <table class="table-style-three">
        <thead>
        <!-- Display CRUD options in TH format -->
        <tr>
            <th>username</th>
            <td><input type="text" name="username" value="" required></td>
        </tr>

        <tr>
            <td>college :</td>
            <td>
                <select name="college" id="college">

                    <option value="Stevens">Stevens</option>
                    <option value="NYIT">NYIT</option>
                    <option value="Pace University">Pace University</option>
                    <option value="NJIT">NJIT</option>
                </select>

            </td>
        </tr>

        <tr>
            <td>Department :</td>
            <td>
                <select name="department" id="department">
                    <option value="Information Science">Information Science</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Computer Engineering">Computer Engineering</option>
                    <option value="Computer Science">Computer Science</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>course</th>
            <td><input type="text" name="course" value="" required></td>
        </tr>
        <tr>
            <th>section</th>
            <td><input type="text" name="section" value="" required></td>
        </tr>

        <tr>
            <td><input type="Submit" name="submit" value="create record"></td>
        </tr>
        </thead>
    </table>
</form>
</body>
</html>