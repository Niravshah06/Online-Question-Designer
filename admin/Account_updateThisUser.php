
<?php

require_once("../config.php");

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}

$thisUserName = $_GET['username'];
$thisEmail = $_GET['email'];
$thisUserType= $_GET['user_type'];
$thisPassword= $_GET['password'];




$temp=$_SESSION['user']['user_type'];
if($temp=='admin')
    $myHome= $adminHome;
else
    $myHome=$profHome;
$back=$_SERVER['HTTP_REFERER'];

?>


<html >
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>
        Update This Record
    </title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
<h3 style="text-align:center;">Please enter Values to update User</h3>
<div class="topright">
    <a href="../index.php?logout='1'" style="color: red;">logout</a></div>
<div class="topleft">
    <a href="<?php echo $myHome?>">Home</a>
    <a href="<?php echo $back?>">back</a>
</div>


<form name="updateUserAccountDetails" method="post" action="Account_UpdateThisUserToDB.php">
    <table class="table-style-three">

        <tr>
            <td>username:</td>
            <td><input type="text" readonly name="username" value="<?php print $thisUserName ?>"></td>
        </tr>

        <tr>
            <td>email :</td>
            <td><input type="email" required name="email" value="<?php print $thisEmail ?>"></td>
        </tr>
        <tr>
            <td>password :</td>
            <td><input type="password" required name="password" value="<?php print $thisPassword ?>"></td>
        </tr>



    </table>

    <input type="submit" name="submit" value="Update Me">

</form>
</body>

</html>