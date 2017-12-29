<?php
include('../functions.php');
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}

?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <h3>
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>
    <!-- logged in user information -->
    <?php echo "Hello ,Admin:"?>
    <div class="profile_info">
        <img src="../images/user_profile.png"  >
    </div>
        <div>
            <?php  if (isset($_SESSION['user'])) : ?>

                <strong><?php echo $_SESSION['user']['username']; ?></strong>
                <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
                <div class="topright">
                    <a href="../index.php?logout='1'" style="color: red;">logout</a><br>
                    <a href="../changePassword.php" style="color: green;">Change Password</a>
                </div>

            <?php endif ?>
        </div>
</div>
<div class="content">
    <h3>Manage User Accounts</h3>
    <table class="table-style-three">
        <thead>
        <!-- Display CRUD options in TH format -->
        <tr>
            <th><a href="Account_createNewUer.php">Create A User </a></th>
        </tr>

        <tr>
            <th><a href="Account_displayAllUsers.php">Read All User information </a></th>
        </tr>
        <tr>
            <th><a href="Account_displayAllUsers.php">Update A User </a></th>
        </tr>
        <tr>
            <th><a href="Account_displayAllUsers.php">Delete A User </a></th>
        </tr>

        </thead>
    </table>
</div>
<div class="content">
    <h3>Manage User Accounts Associations</h3>
    <table class="table-style-three">
        <thead>
        <!-- Display CRUD options in TH format -->
        <tr>
            <th><a href="Association_createNewRecord.php">Associate professor with new course </a></th>
        </tr>
        <tr>
            <th><a href="Association_displayAllRecords.php">Read All Record information </a></th>
        </tr>
        <tr>
            <th><a href="Association_displayAllRecords.php">Update A Record </a></th>
        </tr>
        <tr>
            <th><a href="Association_displayAllRecords.php">Delete A Record </a></th>
        </tr>

        </thead>
    </table>
</div>
    <div class="content">
        <h3>BackUp Options</h3>
        <table class="table-style-three">
            <thead>
            <!-- Display CRUD options in TH format -->
            <tr>
                <th><a href="BackUpTakeToDrive.php">Take back up All the Database</a></th>
            </tr>
            <tr>
                <th><a href="BackUpDoRestore.php">Restore from Back Up,Use This in case for failure</a></th>
            </tr>
            </thead>
        </table>
    </div>
</div>
</body>
</html>