<?php
/**
 * Created by PhpStorm.
 * User: Nirav
 * Date: 12/4/2017
 * Time: 7:17 PM
 *
 *
 */

$head=$_POST['fileHeader'];
$myfile = fopen("D:/sample_exam_blackboard.txt", "w") or die("Unable to open file!");

$ChoiceFlag=0;
$NoChoiceFlag=0;
$correctAns="";
$MATOrORd=0;
$Num=0;
$MA=0;
$FIB=0;
//type-text-points-ans-choice
foreach ($_POST as $key => $value) {
    if (strpos($key, 'type') !== false) {
        $temp=$key;
        $temp=str_replace('type','',$temp);
        $temp = preg_replace('/[0-9]+/', '', $temp);//remove digits
        fwrite($myfile,$temp."\r\t");

        if($temp=='MC'  )
        {
            $ChoiceFlag=1;
        }
        if($temp=='MAT' || $temp=='ORD')
        {
            $MATOrORd=1;
        }
        if( $temp=='NUM'){
            $Num=1;
        }
        if( $temp=='MA'){
            $MA=1;
        }
        if( $temp=='FIB_PLUS'){
            $FIB=1;
        }
        if($temp=='TF' ||$temp=='ESS' || $temp=='SR'){
            $NoChoiceFlag=1;

        }
    }
    if (strpos($key, 'text') !== false) {
        if($FIB==1){
            $Firstpos = strpos($value, "_");
            $Lastpos = strrpos($value, "_");


            $value = $string = preg_replace('/_+/', '_', $value);
            $arr = str_split($value);
            $t="";
            $char = 'x';
            foreach ($arr as $c){
                if($c=="_"){
                    $t=$t."[".$char."]";
                    $char++;
                }
                else
                    $t=$t.$c;
            }
           // echo $t;
            $value=$t;
        }
        fwrite($myfile,$value."\r\t");
    }
    if (strpos($key, 'ans') !== false) {
        $value = trim(preg_replace('/\s+/',' ', $value));
        $correctAns=$value;//used for MC/MA type
        if($NoChoiceFlag==1){

            fwrite($myfile,$value);
            $NoChoiceFlag=0;
        }
        if($FIB==1){
            $char='x';
            $pieces = explode(" ", $value);
            foreach ($pieces as $p) {//ans and offset
                $piecesp = explode(",", $p);
                fwrite($myfile,  $char."\r\t");
                $char++;
                foreach ($piecesp as $pp) {
                    fwrite($myfile,  $pp."\r\t");
                }
            }
            $FIB=0;
        }
        if($Num==1){
            $str = trim(preg_replace('/\s+/',' ', $value));

            $str=rtrim($str,", ");
            $pieces = explode(" ", $str);
            foreach ($pieces as $p) {//ans and offset
                fwrite($myfile,  $p."\r\t");
            }
            $Num=0;

        }
    }


    if (strpos($key, 'choice') !== false) {
        if($ChoiceFlag==1){

            $str = trim(preg_replace('/\s+/',' ', $value));
            $str=rtrim($str,", ");
            $pieces = explode(",", $str);
            foreach ($pieces as $p) {
                fwrite($myfile,  $p."\r\t");
                if($p==$correctAns)
                    fwrite($myfile,  "Correct	");
                else
                    fwrite($myfile,  "Incorrect\r\t");
            }
            $ChoiceFlag=0;

        }
        if($MATOrORd==1){
            $str = trim(preg_replace('/\s+/',' ', $value));
            $str=rtrim($str,", ");
            $pieces = explode(",", $str);
            foreach ($pieces as $p) {
                fwrite($myfile,  $p."\r\t");
            }
            $MATOrORd=0;

        }
        if($MA==1){
            $correctAns=trim(preg_replace('/\s+/',' ', $correctAns));
            $correctAns=rtrim($correctAns,", ");
            $c=explode(",", $correctAns);

            $str = trim(preg_replace('/\s+/',' ', $value));
            $str=rtrim($str,", ");
            $pieces = explode(",", $str);

            foreach ($pieces as $p) {
                fwrite($myfile,  $p."\r\t");
                if (in_array("$p", $c))
                {
                    fwrite($myfile,  "Correct	");
                }
                else
                {
                    fwrite($myfile,  "Incorrect\r\t");
                }
            }
            $MA=0;

        }

        fwrite($myfile,"\r\n");

    }
}
fclose($myfile);
$file = 'D:/sample_exam_blackboard.txt';



if (file_exists($file)) {

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}