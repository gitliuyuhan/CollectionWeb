<?php

$notes="";
$cont="";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
         $notes=$_POST["notes"];
         $cont=$_POST["cont"];
         
         if(empty($cont))
         {
             return;
         }

         date_default_timezone_set('Asia/Shanghai');
         $time=date("Y-m-d|H:i:s");

         $con = mysql_connect("localhost","root","liuyuhan");
    /*     if(!$con)
        {
	die('Could not connect: ' . mysql_error());
         }*/
         mysql_query("set names utf8");
         mysql_select_db("Collection",$con);

         session_start();
         $user=$_SESSION['name'];

         if(empty($user))
         {
                 return;
         }

         $res=mysql_query("INSERT INTO  Memo(MContent,MTime,UName,MNotes)  Values('$cont','$time','$user','$notes')");
          mysql_close($con);
}
?>