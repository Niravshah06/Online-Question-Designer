<?php
/**
 * Created by PhpStorm.
 * User: Nirav
 * Date: 12/4/2017
 * Time: 2:00 PM
 */


    // do stuff
    $head=$_POST['fileHeader'];
    $myfile = fopen("D:/sample_exam_blackboard_questions_only.txt", "w") or die("Unable to open file!");

    fwrite($myfile, $head);
    $i=1;
    $choicesFlag=0;
    $MCFlag=0;
    $MATFlag=0;
    $ORDFlag=0;
    foreach ($_POST as $key => $value) {


        //question
         if (strpos($key, 'text') !== false) {
             fwrite($myfile,  "\r\n");
             fwrite($myfile,  "\r\n");
             fwrite($myfile,  "Q".$i.": ");

             fwrite($myfile,  $value."");
             $i=$i+1;

          }
          //type
        else if (strpos($key, 'type') !== false) {
             $temp=$key;
             $temp=str_replace('type','',$temp);
            $temp = preg_replace('/[0-9]+/', '', $temp);//remove digits
            if($temp=='TF'){

                $choicesFlag=1;
            }
            if($temp=='MC' || $temp=='MA')
            {
                $MCFlag=1;
            }
            if($temp=='MAT')
            {
                $MATFlag=1;
            }
            if($temp=='ORD')
            {
                $ORDFlag=1;
            }

        }
        //points
        else if (strpos($key, 'points') !== false) {
            fwrite($myfile,  " (");
            fwrite($myfile,$value." pts)");
        }
        //choice
       else if (strpos($key, 'choice') !== false) {
           fwrite($myfile,  "\r\n");
            if($choicesFlag==1)
            {
                fwrite($myfile,  "\r\n");

                $str = trim(preg_replace('/\s+/',' ', $value));

                $pieces = explode(",", $str);

                if(count($pieces)==2)//means its TF
                {
                    foreach ($pieces as $p) {
                        fwrite($myfile,  $p."\r\n");
                    }
                }
                $choicesFlag=0;
            }

           if($MCFlag==1)
           {


               $str = trim(preg_replace('/\s+/',' ', $value));
               $str=substr($str,0,-1);
               $pieces = explode(",", $str);

               //echo $str."\r\n";
               fwrite($myfile,  "\r\n");

               $char = 'A';
                   foreach ($pieces as $p) {
                       fwrite($myfile,$char.")  ");
                       fwrite($myfile,  $p."\r\n");
                       $char++;
                   }

               $MCFlag=0;
           }

           if($ORDFlag==1)
           {


               $str = trim(preg_replace('/\s+/',' ', $value));
               $str=rtrim($str,", ");
               $pieces = explode(",", $str);
               fwrite($myfile,  "\r\n");

               $char = 1;
               foreach ($pieces as $p) {
                   fwrite($myfile,$char.".  ");
                   fwrite($myfile,  $p."\r\n");
                   $char++;
               }


               $ORDFlag=0;
           }

           if($MATFlag==1)
           {

               fwrite($myfile,  "\r\n");
               $str = trim(preg_replace('/\s+/',' ', $value));
               $str=rtrim($str,", ");
               $pieces = explode(",", $str);


               $char = 'A';
               $j=1;
               foreach ($pieces as $p1) {

                   if ($j % 2 != 0) {
                       fwrite($myfile, $j . ".  ");
                       fwrite($myfile, $p1 . "\r\t\t");

                   } else {
                       fwrite($myfile, $char . ".  ");
                       $char++;
                       fwrite($myfile, $p1 . "\r\n");
                   }
                   $j++;


               }
               }


               $MATFlag=0;
           }


           //fwrite($myfile,  $value."\r\n");
        }




    fclose($myfile);
$file = 'D:/sample_exam_blackboard_questions_only.txt';



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