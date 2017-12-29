<?php



session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'project');

// variable declaration
$username = "";
$email    = "";
$errors   = array();
$db_table_prefix="project";
$adminHome="http://localhost/Myproject/admin/adminHome.php";
$profHome="http://localhost/Myproject/professor/profHome.php";
/////////////////////////////////////user account function starts////////////////
function fetchAllUserAccounts()
{
    //$username = $_SESSION['user']['username'];
    global $db;
    $query = "SELECT *  FROM user_Accounts";
    $results = mysqli_query($db, $query);
    return $results;

}
function updateThisUserAccount($thisUserName,$thisEmail,$thisPassword){
    global $db;
    // grap form values
    $username = e($thisUserName);
    $newEmail=e($thisEmail);
    $newPassword=e($thisPassword);

    $query = "UPDATE  user_accounts set password ='$newPassword',email='$newEmail'WHERE username='$username'  LIMIT 1";
    $results = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 1) { // uppdated found
        $msg = "Updated user details";

    } else {

        $msg = "Did you try to update account with same details?";
    }


    return $msg;

}
function createNewUserAccount($thisUserName,$thisEmail,$thisUserType,$thisPassword)
{
    global $db;
    $query = "insert into user_accounts values
('$thisUserName','$thisEmail','$thisUserType','$thisPassword');";
    $results = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 1) { // record inserted
        $msg = "User Account has been Inserted";

    } else {

        $msg = "Unknown Error/You are trying to insert Duplicate Record ";
    }
    return $msg;
}
function deleteEntireEntitty($username){
    $thisUserName=  e($username);
    global $db;

    $SessionUsername = $_SESSION['user']['username'];
    if($SessionUsername!=$username) {
        $query = "DELETE From  relationtable WHERE username='$thisUserName' ";
        $results = mysqli_query($db, $query);
        if (mysqli_affected_rows($db) > 0) { // deletd? found
            $msg = "Associated course/colleges has been  Deleted Successfully first,  ";

        }

        $query = "DELETE From  user_Accounts WHERE username='$thisUserName' ";
        $results = mysqli_query($db, $query);
        if (mysqli_affected_rows($db) > 0) { // deletd? found
            $msg = $msg . "User account has been removed  ";

        }
    }else
        $msg="You can not Delete your account Admin,Please ask other admins to do it";
    return $msg;


}
/////////////////////////////////////user account function ends////////////////
function createNewRecord($thisUserName,$thisNewSection,$thisNewCollege,$thisNewCourse,$thisNewDepartment){

    $thisUserName=  e($thisUserName);
    $thisNewSection=e($thisNewSection);
    $thisNewCollege=e($thisNewCollege);
    $thisNewCourse=e($thisNewCourse);
    $thisNewDepartment=e($thisNewDepartment);

    global $db;
    $query1="select user_type from user_accounts where username='$thisUserName'";
    $results = mysqli_query($db, $query1);
    $user_type = mysqli_fetch_assoc($results);
    $user_type= $user_type['user_type'];
    if($user_type=='professor') {

        $query = "insert into relationtable(username,college,department,course,section) values
('$thisUserName','$thisNewCollege','$thisNewDepartment','$thisNewCourse','$thisNewSection');";
        $results = mysqli_query($db, $query);
        if (mysqli_affected_rows($db) == 1) { // record inserted
            $msg = "Record has been Inserted";

        } else {

            $msg = "Unknown Error/You are trying to insert Duplicate Record ";
        }
    }
    else
    {
        $msg="User with entered username not found /You can not modify admin account";
    }
    return $msg;


}


/**fetch and return all records
 * @return bool|mysqli_result
 */
function fetchAllUsers()
{
    global $db;
    $query = "SELECT username,college,department,course,section  FROM relationtable";
    $results = mysqli_query($db, $query);
    return $results;

}

/**
 * @param $thisUserName
 * @param $thisNewSection
 * @param $thisNewCollege
 * @param $thisNewCourse
 * @param $thisNewDepartment
 * @param $thisOldSection
 * @param $thisOldCourse
 * @param $thisOldDepartment
 * @param $thisOldCollege
 */
function updateThisRecord($thisUserName,$thisNewSection,$thisNewCollege,$thisNewCourse,$thisNewDepartment,
                          $thisOldSection,$thisOldCourse,$thisOldDepartment,$thisOldCollege)
{
    global $db;
    $query = "UPDATE  relationtable set college ='$thisNewCollege',department='$thisNewDepartment'  
    ,course='$thisNewCourse' ,section='$thisNewSection'
WHERE username='$thisUserName' AND college= '$thisOldCollege'
 and department='$thisOldDepartment' and course='$thisOldCourse' and section='$thisOldSection'";
    $results = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 1) { // uppdated found
        $msg="Record has been updated";

    }else {

        $msg="Update unscuessfull,Duplicate record found,please change values";
    }
    return $msg;
}

/**
 * update account password
 * @param $username
 * @param $oldpassword
 * @param $newPassword
 * @return string
 */
function updatePassword($username,$oldpassword,$newPassword){

    global $db;
    // grap form values
    $username = e($username);
    $newPassword=e($newPassword);
    $oldpassword=e($oldpassword);


    $query = "UPDATE  user_accounts set password ='$newPassword'WHERE username='$username' AND password= '$oldpassword' LIMIT 1";
    $results = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 1) { // uppdated found
        $msg="Password has been changed";

    }else {

        $msg="Your current password is wrong";
    }


    return $msg;

}

/**
 * delete record
 * @param $username
 * @param $section
 * @return string
 */
function deleteThisRecord($username,$section)
{
    global $db;
    $username = e($username);
    $section=e($section);

    $query = "DELETE From  relationtable WHERE username='$username' AND section= '$section' LIMIT 1";
    $results = mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 1) { // deletd? found
        $msg="Record Deleted Successfully";

    }else {

        $msg="Unknown Error,Record could not be deleted";
    }


    return $msg;

}

/**
 * search functionality
 * @param $sid
 */
function search($sid)
{



}

/**
 * display all errors
 */
function display_error() {
    global $errors;

    if (count($errors) > 0){
        echo '<div class="error">';
        foreach ($errors as $error){
            echo $error .'<br>';
        }
        echo '</div>';
    }
    $errors=array();
}
// escape string
function e($val){
    global $db;
    return mysqli_real_escape_string($db, trim($val));
}
/**
 * check if log in button is pressed
 */
if (isset($_POST['login_btn'])) {
    login();
}

// LOGIN USER
/**
 *
 */
function login(){
    global $db, $username, $errors;

    // grap form values
    $username = e($_POST['username']);
    $password = e($_POST['password']);
    //$user_type=e($_POST['user_type']);


    $query = "SELECT * FROM user_accounts WHERE username='$username' AND password='$password'  LIMIT 1";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) == 1) { // user found
        // check if user is admin or user
        $logged_in_user = mysqli_fetch_assoc($results);
        if ($logged_in_user['user_type'] == 'admin') {

            $_SESSION['user'] = $logged_in_user;
            $_SESSION['success']  = "You are now logged in";
            header('location: admin/adminHome.php');
        }else{
            $_SESSION['user'] = $logged_in_user;
            $_SESSION['success']  = "You are now logged in";

            header('location: professor/profHome.php');
        }
    }else {
        array_push($errors, "Wrong username/password combination");
    }

}

/**
 *  check if user has pressed log out button
 */
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: ./index.php");
}

/**
 * @return bool
 * now allowing direct acces to other pages,i,e first log in then acces
 */
function isLoggedIn()
{
    if (isset($_SESSION['user'])) {
        return true;
    }else{
        return false;
    }
}