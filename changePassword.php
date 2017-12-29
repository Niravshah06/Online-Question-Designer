<?php

require_once("config.php");
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
        Change Password
    </title>
    <!-- Style -- Can also be included as a file usually style.css -->

    <link rel="stylesheet" type="text/css" href="./css/style.css">


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
<?php echo display_error(); ?>
<h3 style="text-align:center;">Please enter current and new password to chnage the password</h3>
<div class="topright">
    <a href="./index.php?logout='1'" style="color: red;">logout</a></div>
<div class="topleft">
    <a href="<?php echo $myHome?>">Home</a>
    <a href="<?php echo $back?>">back</a>
</div>
<form name="changePassword" action="changePasswordDone.php" method="post">
    <!-- Table goes in the document BODY -->
    <table class="table-style-three">
        <thead>
        <!-- Display CRUD options in TH format -->
        <tr>
            <th>current password</th>
            <td><input type="password" name ="password" id="password" reqired></td>
        </tr>

        <tr>
            <th>new password</th>
            <td><input type="password" name ="newPassword1" id="newPassword1"  required onkeyup="handleInput()"></td>
        </tr>
        <tr>
            <th>confirm new password</th>
            <td><input type="password" name= "newPassword2" id="newPassword2" required onkeyup="handleInput()" ></td>
            <td><p style="color:red;"id="validate-status"></p></td>
        </tr>
        <tr>
            <td><input type="Submit" id="myBtn" name="submit" value="chnage password"></td>
        </tr>
        </thead>
    </table>
</form>
</body>
<script>
    document.getElementById("myBtn").disabled = true;
    function handleInput(){
        var password1 = document.getElementById('newPassword1').value;
        var password2 = document.getElementById('newPassword2').value;
        if(password2!=""){
        if(password1 === password2) {
            document.getElementById('validate-status').innerHTML="Match";
            document.getElementById("myBtn").disabled = false;

        }
        else {
            document.getElementById('validate-status').innerHTML="No Match";
            document.getElementById("myBtn").disabled = true;
        }
    }}
</script>
</html>