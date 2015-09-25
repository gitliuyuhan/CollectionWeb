
<?php
$notes="";
$cont="";

         $notes=$_POST["notes"];
         $cont=$_POST["cont"];
         $oldtime=$_POST["time"];
         
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

         $res=mysql_query("UPDATE  Memo   SET MContent='$cont',MTime='$time',MNotes='$notes'  WHERE   MTime='$oldtime'  AND  UName='$user'   "  );
          mysql_close($con);

     /*     echo   $oldtime;
          echo  $time;
          echo  $cont;
          echo  $user;*/

          echo "<script  language=\"javascript\" >";
          echo "document.location=\"memo.html\" ";
          echo "</script>";

?>