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
         Create New Account
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

<form name="createUserAccount" action="Account_createNewUserToDB.php" method="post">
    <!-- Table goes in the document BODY -->
    <table class="table-style-three">
        <thead>
        <!-- Display CRUD options in TH format -->
        <tr>
            <th>username</th>
            <td><input type="text" name="username" value="" required></td>
        </tr>
        <tr>
            <th>email</th>
            <td><input type="email" name="email" value="" required></td>
        </tr>
        <tr>
            <th>password</th>
            <td><input type="password" name="password" value="" required></td>
        </tr>

        <tr>
            <td>User Type :</td>
            <td>
                <input type="radio" name="user_type" checked value="professor">professor
                <input type="radio" name="user_type" value="admin">admin
            </td>
        </tr>

        <tr>
            <td><input type="Submit" name="submit" value="create new Account"></td>
        </tr>
        </thead>
    </table>
</form>
</body>
</html>