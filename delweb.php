<?php
session_start();
$user=$_SESSION['name'];
$delurl=$_GET['delurl'];
$type=$_GET['wtype'];
echo  $delurl;
echo  "\n";
echo  $type;

$con = mysql_connect("localhost","root","liuyuhan");
if(!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_query("set names utf8");
mysql_select_db("Collection",$con);

$result=mysql_query("select  WPreview from WebPages where  WUrl='$delurl'   AND  UName='$user' ");
while($row=mysql_fetch_array($result))
{
             $img=$row['WPreview'];
             exec("sudo  rm  $img");
}
mysql_query("delete   from   WebPages   where   UName='$user'  AND  WUrl='$delurl' ");
mysql_close($con);
echo "<script  language=\"javascript\" >";
echo "document.location=\"$type".".html\" ";
echo "</script>";

?>