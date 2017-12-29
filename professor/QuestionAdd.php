<?php
/**
 * Created by PhpStorm.
 * User: Nirav
 * Date: 11/29/2017
 * Time: 5:11 PM
 */
require_once("../config.php");

if (!isLoggedIn()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}
$thisCollege = $_GET['college'];
$thisDepartment = $_GET['department'];
$thisCourse= $_GET['course'];
//$thisSection= $_POST['section'];

//set values for next page
$_SESSION['college'] = $thisCollege;
$_SESSION['course'] = $thisCourse;
$_SESSION['department'] = $thisDepartment;



$allrecords = CheckSelection($thisCollege,$thisDepartment,$thisCourse);

$count=mysqli_num_rows($allrecords);
$backURL=$_SERVER['HTTP_REFERER'];
if($count==0){
    echo "You may have selected wrong college/course/dept/section";
    echo  PHP_EOL."you will be redirected to previous page in 5 seconds";
    header('Refresh: 5; URL='.$backURL);
}
else {
    $temp = $_SESSION['user']['user_type'];
    if ($temp == 'admin')
        $myHome = $adminHome;
    else
        $myHome = $profHome;

    $back = "./ReadQuestions.php";

    ?>
    <html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
        <title>
            Add a Question
        </title>

        <link rel="stylesheet" type="text/css" href="../css/style.css">

    </head>
    <body>
    <h3 style="text-align:center;">Add a question</h3>
    <div class="topright">
        <a href="../index.php?logout='1'" style="color: red;">logout</a></div>
    <div class="topleft">
        <a href="<?php echo $myHome?>">Home</a>
        <a href="<?php echo $back?>">back</a>
    </div>
    <form action="QuestionAddToDB.php" method="post" id="form1">
        <div>
            <label>Enter the Question text</label>
            <input type="text" name="question_text" id="question_text"required  style="width:500;height:50"><br><br><br>
        </div>
        <label>Enter the Question Type</label>
        <select id="q_type" name="q_type" onChange="jsfunction()">
            <option value="Select" selected>Select Question Type</option>
            <option value="TF">True/False</option>
            <option value="ESS">Essay</option>
            <option value="FIB_PLUS">Fill in the blank</option>
            <option value="FIL">File response</option>
            <option value="MA">Multiple Answer</option>
            <option value="MAT">Matching Answer</option>
            <option value="MC">Multiple Choice</option>
            <option value="NUM">Numeric</option>
            <option value="ORD">Ordering</option>
            <option value="SR">Short Response</option>
        </select>
        <div id="MCorMA"  style="visibility: hidden">
            <label>Enter the choices seprated by comma</label>
            <input type="text" value="" name="Choices" id="choices"required  style="width:500;">
            <label>Please  fill in  Answer ( separated by comma in case of its matching answer)</label>
            <input type="text" value="" name="ans1" id="ans1"required  style="width:500;">
        </div>
        <div id="ORD"  style="visibility: hidden">
            <label>Specify the correct Order for the options (example 1-3-2) if you have 3 choices in question text</label><br>
            <input type="text" value="" name="order" id="choices"required  style="width:500;">
        </div>
        <div id="TF"  style="visibility: hidden">
            <label>Select true or false....</label>
            <input type="radio" name="TFANS" value="True" checked>True
            <input type="radio" name="TFANS" value="False">False
        </div>
        <div id="NUM"  style="visibility: hidden">
            <label>Enter the Numeric Answer</label>
            <input type="number" name="numans" value=""><br>
            <label>Enter the Numeric Offset</label>
            <input type="number" name="numoff" value="">
        </div>
        <div id="SRorESS"  style="visibility: hidden">
            <label>Paste/Write Answer</label>
            <textarea rows="4" cols="70" name="ansSRorESS" placeholder="Enter your Answer here"></textarea>
        </div>
        <div id="FIL"  style="visibility: hidden">
            <label>For This student will have submit file(s)</label>
        </div>
        <div id="FIB_PLUS"  style="visibility: hidden">
            <label>Please Enter the Answer of fill in the blank separated by comma for same blank.And</label>
            <label>Please Enter the space between  the two fill in the blank answers </label>
            <input type="text" name="fillAns" id="fillAns"required  style="width:500;"><br><br><br>
        </div>
        <div id="MAT"  style="visibility: hidden">
            <label>Please  fill in the Left Side  separated by comma(it will be taken as 1,2,3..)</label>
            <input type="text" name="leftSide" id="leftSide"required  style="width:500;"><br><br>
            <label>Please  fill in the Right Side  separated by commait will be taken as A,B,C..</label>
            <input type="text" name="rightSide" id="rightSide"required  style="width:500;"><br><br>
            <label>Please  fill in Matching Answer  separated by comma(ex.A-2,B-1..)</label>
            <input type="text" name="matchingAns"  id="matchingAns"required  style="width:500;"><br><br>
        </div>
        <div>
            <label>Enter the Question Point</label>
            <input type="number" name="points" id="question_text" required  ><br><br><br>
        </div>
        <button onclick="goTODB();" name="AddQuestion">AddQuestion</button>
    </form>
    </body>
    <script>
        function goTODB() {
            document.getElementById("form1").submit();
        }

        function jsfunction(){
            removeVisibility();
            var e = document.getElementById("q_type");
            var value = e.options[e.selectedIndex].value;

            if(value==="MC" || value==="MA"){

                document.getElementById("MCorMA").style.visibility = "visible";

            }
            else if(value==="TF")
            {

                document.getElementById("TF").style.visibility = "visible";
            }

            else if(value==="SR" || value==="ESS"){

                document.getElementById("SRorESS").style.visibility = "visible";
            }
            else if(value==="NUM"){

                document.getElementById("NUM").style.visibility = "visible";
            }
            else if(value==="FIL"){

                document.getElementById("FIL").style.visibility = "visible";
            }
            else if(value==="FIB_PLUS"){

                document.getElementById("FIB_PLUS").style.visibility = "visible";
            }
            else if(value==="ORD"){

                document.getElementById("ORD").style.visibility = "visible";
            }
            else if(value==="MAT"){

                document.getElementById("MAT").style.visibility = "visible";
            }
        }
        function removeVisibility()
        {
            var elem = document.getElementById('MCorMA').style.visibility = "hidden";
            var elem = document.getElementById('TF').style.visibility = "hidden";
            var elem = document.getElementById('NUM').style.visibility = "hidden";
            var elem=  document.getElementById('SRorESS').style.visibility = "hidden";
            var elem=  document.getElementById('FIL').style.visibility = "hidden";
            var elem=  document.getElementById('FIB_PLUS').style.visibility = "hidden";
            var elem=  document.getElementById('ORD').style.visibility = "hidden";
            var elem=  document.getElementById('MAT').style.visibility = "hidden";
        }

    </script
    </html>
<?php }
?>
