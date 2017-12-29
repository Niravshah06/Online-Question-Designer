<?php
include('../config.php');
if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ./index.php');
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
    <?php echo "Hello ,Professor:"?>
    <div class="profile_info">
        <img src="../images/user_profile.png"  >

        <div>
            <?php  if (isset($_SESSION['user'])) : ?>

                <strong><?php echo $_SESSION['user']['username']; ?></strong>

                    <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
                    <br><div class="topright">
                    <a href="../index.php?logout='1'" style="color: red;">logout</a><br>
                        <a href="../changePassword.php" style="color: green;">Change Password</a></div>


            <?php endif ?>
        </div>
    </div>
</div>
    <div class="content">
        <h3>Manage Questions</h3>
        <table class="table-style-three">
            <thead>

            <tr>
                <th><a href="ReadQuestions.php">Create A Question </a></th>
            </tr>

            <tr>
                <th><a href="ReadQuestions.php">Read A Question </a></th>
            </tr>
            <tr>
                <th><a href="ReadQuestions.php">Update A Question </a></th>
            </tr>
            <tr>
                <th><a href="ReadQuestions.php">Delete A Question </a></th>
            </tr>

            </thead>
        </table>
    </div>
<div class="content">
<h3>Manage Exams</h3>

<table class="table-style-three">
    <thead>

    <tr>
        <th><a href="ReadQuestions.php">Create A Exam </a></th>
    </tr>

    <tr>
        <th><a href="ExamHistoryShow.php">Exam History </a></th>
    </tr>


    </thead>
</table>
</div>
</body>
</html>
