<?php
error_reporting(0);
header("Content-Type:text/html;charset=utf-8");
session_start();
$user=$_SESSION['name'];
$url=$_POST["url"];
$notes=$_POST["notes"];
$type=$_POST["slt"];
if($type=='none')
 {
      $type='other';
  }

function file_get_contents_curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
$html = file_get_contents_curl($url);
$doc = new DOMDocument();
$doc->loadHTML($html);
$nod = $doc->getElementsByTagName('title');
$title = $nod->item(0)->nodeValue;
if($title=="")
{
	$title="have   no   description!";
}

set_time_limit(0);
$time=time();
$outdir='./image/'.$time.'.png';
$cmd="sudo xvfb-run cutycapt --url=$url --out=$outdir";
exec($cmd);
$chmod="sudo chmod 666 ".$outdir;
exec($chmod);

/*
echo "Title: $title"."\n";
echo $user;
echo  $url;
echo  $notes;
echo  $type;
*/

$con = mysql_connect("localhost","root","liuyuhan");
if(!$con)
{
	die('Could not connect: ' . mysql_error());
}
mysql_query("set names utf8");
mysql_select_db("Collection",$con);

$res=mysql_query("insert   into  WebPages(WUrl,WTitle,WPreview,WNotes,WType,UName)   values('$url','$title','$outdir','$notes','$type','$user')");
mysql_close($con);

echo "<script  language=\"javascript\" >";
echo "document.location=\"add.html\" ";
echo "</script>";
?>