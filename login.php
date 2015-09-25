<?php
$err="";
$user="";
$pwd="";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
if(empty($_POST["user"]) )
{
	$err="！用户名不能为空";
}
else
{
	$user=$_POST["user"];
            if(empty($_POST["pwd"]) )
            {
            	        $err="！密码不能为空";
            	}
            	else
            	{
            	        $pwd=$_POST["pwd"];        
                     $con = mysql_connect("localhost","root","liuyuhan");
                     if(!$con)
                     {
	                   die('Could not connect: ' . mysql_error());
                     }
                     mysql_query("set names utf8");
                     mysql_select_db("Collection",$con);
                     $result=mysql_query("select  UName   from   Users   where   UName='$user'  AND  Password='$pwd' ");
                    if(mysql_num_rows($result)  > 0)
                    {          
             	        session_start();
	                    $_SESSION['name']=$user;
	                    echo "<script  language=\"javascript\" >";
                                 echo "document.location=\"user.html\" ";
	                    echo "</script>";
                                
                     }
                    else
                    {
	                    $err="！用户名或密码错误";
                    }
                    mysql_close($con);
             }
}
}
?>