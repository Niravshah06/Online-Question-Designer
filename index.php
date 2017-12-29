
<?php require_once("config.php"); ?>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>
        welcome
    </title>
    <!-- Style -- Can also be included as a file usually style.css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>

<?php echo display_error(); ?>
<h3 style="background-color:powderblue;text-align:center">Welcome to My Question Pool Portal</h3>
<form method="post" action="index.php">



<div class="input-group">
    <label>Username</label>
    <input type="text" name="username" required autofocus>
</div>
<div class="input-group">
    <label>Password</label>
    <input type="password" name="password" required>
</div>
<div class="input-group">
    <button type="submit" class="btn" name="login_btn">Login</button>
    <button type="reset" class="btn" name="reset_btn">Reset</button>
</div>

</form>

</body>
</html>
