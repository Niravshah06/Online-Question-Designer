<?php

require_once("../config.php");

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}
$thisUserName = $_GET['username'];
$thisSection = $_GET['section'];
$thisCollege= $_GET['college'];
$thisCourse= $_GET['course'];
$thisDepartment= $_GET['department'];

//set attribute for current values
$_SESSION['college'] = $thisCollege;
$_SESSION['course'] = $thisCourse;
$_SESSION['department'] = $thisDepartment;
$_SESSION['section'] = $thisSection;

$temp=$_SESSION['user']['user_type'];
if($temp=='admin')
    $myHome= $adminHome;
else
    $myHome=$profHome;
$back=$_SERVER['HTTP_REFERER'];

?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN'
    'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>
         Update This Record
    </title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
<h3 style="text-align:center;">Please enter Values to update record</h3>
<div class="topright">
    <a href="../index.php?logout='1'" style="color: red;">logout</a></div>
<div class="topleft">
    <a href="<?php echo $myHome?>">Home</a>
    <a href="<?php echo $back?>">back</a>
</div>


<form name="updateUserDetails" method="post" action="Association_updateThisRecordToDB.php">
    <table class="table-style-three">

            <tr>
                <td>username:</td>
                <td><input type="text" readonly name="username" value="<?php print $thisUserName ?>"></td>
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
                <td>course :</td>
                <td><input type="text" name="course" value="<?php print $thisCourse ?>"></td>
            </tr>
            <tr>
                <td>section :</td>
                <td><input type="text" name="section" value="<?php print $thisSection ?>"></td>
            </tr>



    </table>

    <input type="submit" name="submit" value="Update Me">

</form>
</body>
<script>
function selectCollegeAndDepartment()
{
    var php_var = "<?php echo $thisCollege; ?>";

    for(var i = 0;i < document.getElementById("college").length;i++){
        console.log(document.getElementById("college").options[i].value);
        if(document.getElementById("college").options[i].value === php_var ){
            document.getElementById("college").selectedIndex = i;
        }
    }
    var php_var2 = "<?php echo $thisDepartment; ?>";

    for(var i = 0;i < document.getElementById("department").length;i++){
        if(document.getElementById("department").options[i].value === php_var2 ){
            document.getElementById("department").selectedIndex = i;
        }
    }

}
window.onload =selectCollegeAndDepartment;

</script>
</html>