<?php
/**
 * Created by PhpStorm.
 * User: Nirav
 * Date: 11/27/2017
 * Time: 8:43 PM
 */


// connect to database
$db = mysqli_connect('localhost', 'root', '', 'project');


function SelectDepartmentCourseAndCollege()
{
    $thisUserName=  e($_SESSION['user']['username']);
    global $db;
    $query = "SELECT college,department,course,section  FROM relationtable WHERE username='$thisUserName' ";
    $results = mysqli_query($db, $query);
    return $results;
}



function CheckSelection( $thisCollege,$thisDepartment,$thisCourse){

    $thisUserName=  e($_SESSION['user']['username']);
    global $db;
    //echo $thisUserName,$thisCollege,$thisDepartment,$thisCourse,$thisSection;
    $query = "SELECT college,department,course,section  FROM relationtable WHERE username='$thisUserName'
And department='$thisDepartment' and college='$thisCollege'and course='$thisCourse' ";

    $results = mysqli_query($db, $query);
    return $results;


}
function fetchAllQuestions($my_key){
    global $db;
    $query = "SELECT qid,question_text,question_type,answer,points  FROM question WHERE question_for='$my_key' ";
    $results = mysqli_query($db, $query);
    return $results;
}

function getAnswerChoices($qid){
    global $db;
    $query = "SELECT *  FROM question_choices WHERE question_id='$qid' ";
    $results = mysqli_query($db, $query);
    return $results;


}
function deleteQuestionAndChoices($thisQid){

    // echo  "Deleting first choices associated with   ".$thisQid;
    global $db;
    //we have used cascade delete instaead
 //   $query = "delete  FROM question_choices WHERE question_id='$thisQid' ";
  //  $results = mysqli_query($db, $query);
    echo  "     Deleting question from db with id  ".$thisQid;
    $query = "delete  FROM question WHERE qid='$thisQid' ";
    $results = mysqli_query($db, $query);

}
/////////////////////////////////////////////////////////////////
///
function storeChoicesAndAnswer($mykey,$q_text,$q_type,$answer,$thisQuestionPoint,$thisChoice)
{
    global $db;


    $answer=rtrim($answer,", ");
   $query = "insert into question(question_for,question_text,question_type,answer,points) values('$mykey','$q_text','$q_type','$answer','$thisQuestionPoint') ";
    $results = mysqli_query($db, $query);

    if(null!=$thisChoice) {
        $query = "SELECT qid  FROM question WHERE question_for='$mykey'and question_text='$q_text' ";
        $results = mysqli_query($db, $query);
//runs only 1 time
        foreach ($results as $r) {
            $qid = $r['qid'];
        }
        $thisChoice=rtrim($thisChoice,", ");
        $pieces = explode(",", $thisChoice);
        foreach ($pieces as $p) {
            storeChoices($qid, $p);
        }
    }
}
function storeChoices($qid,$choice)
{
    global $db;
    $query = "insert into question_choices(choice,question_id) values('$choice','$qid') ";
    $results = mysqli_query($db, $query);
}
function getQuestionDetails($qid){
    global $db;
    $query = "select *  FROM question WHERE qid='$qid' ";
    $results = mysqli_query($db, $query);
    return $results;


}

function updateQuestion($thisQuestionID,$q_text,$q_type,$answer,$points,$thisChoice)
{
    global $db;
   $query = "update question set question_text='$q_text',question_type='$q_type',answer='$answer',points='$points' where qid='$thisQuestionID'";
    $results = mysqli_query($db, $query);

       $query = "delete  FROM question_choices WHERE question_id='$thisQuestionID'";
     $results = mysqli_query($db, $query);
    $thisChoice=rtrim($thisChoice,", ");
    echo $thisChoice;
        if($thisChoice!="," && strlen($thisChoice) > 1){
        $pieces = explode(",", $thisChoice);
        foreach ($pieces as $p) {
            storeChoices($thisQuestionID, $p);
        }}


}
/////////////////////////////////exam realted functions////

function fetchQuestionTypes()
{
    global $db;
    $query = "select q_type,full_form FROM question_type";
    $results = mysqli_query($db, $query);
    return $results;
}

function getCountOfQuestionType($my_key,$t){
    global $db;
    $query = "select count(question_text) as total FROM question where question_for='$my_key' and question_type='$t'";
    $results = mysqli_query($db, $query);
   $data= mysqli_fetch_assoc($results);
    return $data['total'];
}
function getQuestionIdFromType($my_key,$t){
    global $db;
    $query = "select qid FROM question where question_for='$my_key' and question_type='$t'";
    $results = mysqli_query($db, $query);
    return $results;

}
/////////////////////////exam_report///////////


function createExamReport($thisCollege,$thisSchool,$thisDepartment,$thisCourse,$thisExamName,$thisSem,$thisYear,$thisExamDate)
{
    global $db;
    $thisUserName=  e($_SESSION['user']['username']);
    $query="insert into exam_report(username,college,school,department,course,examtype,semester,year,examdate) VALUES 
    ('$thisUserName','$thisCollege','$thisSchool','$thisDepartment','$thisCourse','$thisExamName','$thisSem','$thisYear','$thisExamDate')";
    mysqli_query($db, $query);

}

function fetch_reports()
{

    global $db;
    $thisUserName=  e($_SESSION['user']['username']);
    $query="select * from exam_report where username='$thisUserName'";
    $results= mysqli_query($db, $query);
    return $results;

}