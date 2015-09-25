<?php
$userErr="<span  style=\"color:#FF0000;\">*</span>";
$pwd1Err="<span  style=\"color:#FF0000;\">*</span>";
$pwd2Err="<span  style=\"color:#FF0000;\">*</span>";
$emailErr="<span  style=\"color:#FF0000;\">*</span>";

$user="";
$pwd1="";
$pwd2="";
$email="";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
         $user=$_POST["user"];
         $pwd1=$_POST["pwd1"];
         $pwd2=$_POST["pwd2"];
         $email=$_POST["email"];
         if(empty($user))
         {
         	$userErr="<span  style=\"color:#FF0000;\">* 用户名不能为空</span>";
             return;
         }
         if(empty($pwd1))
         {
         	$pwd1Err="<span  style=\"color:#FF0000;\">* 密码不能为空</span>";
         	return;
         }
         if(empty($pwd2))
         {
         	$pwd2Err="<span  style=\"color:#FF0000;\">* 密码不能为空</span>";
         	return;
         }
         if(empty($email))
         {
         	$emailErr="<span  style=\"color:#FF0000;\">* 邮箱不能为空</span>";
         	return;
         }
         if($pwd1 != $pwd2)
         {
         	$pwd1Err="<span  style=\"color:#FF0000;\">* 两次密码输入不一致</span>";
         	return;
         }

         $con = mysql_connect("localhost","root","liuyuhan");
    /*     if(!$con)
        {
	die('Could not connect: ' . mysql_error());
         }*/
         mysql_query("set names utf8");
         mysql_select_db("Collection",$con);

         $result=mysql_query("SELECT  UName,Email,Password  FROM  Users  Where   UName='$user'  OR  Email='$email'  ");
         if(mysql_num_rows($result)  > 0)
         {
         	       $userErr="<span  style=\"color: green;\">√</span>";
         	       $pwd1Err="<span  style=\"color: green;\">√</span>";
         	       $pwd2Err="<span  style=\"color: green;\">√</span>";
         	       $emailErr="<span  style=\"color: green;\">√</span>";
         	       while($row=mysql_fetch_array($result))
                   {
                          if($user==$row['UName'])
                          {
                          	$userErr="<span  style=\"color:#FF0000;\">* 用户名已被注册</span>";
                          }
                          if($email==$row['Email'])
                          {
                          	$emailErr="<span  style=\"color:#FF0000;\">* 邮箱已被占用</span>";
                          }
                   }
         }
         else
         {
                    $res=mysql_query("INSERT INTO Users(UName,Email,Password) Values('$user','$email','$pwd1')");
                    if($res)
                    {
	                 session_start();
	                 $_SESSION['name']=$user;
	                 $_SESSION['email']=$email;
	                 echo "<script  language=\"javascript\" >";
	                 echo "document.location=\"user.html\" ";
	                 echo "</script>";
                     }
                     else
                     {
                     	     $userErr="<span  style=\"color:#FF0000;\">* 注册失败</span>";
                              $pwd1Err="<span  style=\"color:#FF0000;\">*</span>";
                              $pwd2Err="<span  style=\"color:#FF0000;\">*</span>";
                              $emailErr="<span  style=\"color:#FF0000;\">*</span>";
                     }
                     mysql_close($con);
           }
}
?>