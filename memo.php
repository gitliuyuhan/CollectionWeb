<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style type="text/css">
    *{
        margin: 0;
        padding: 0;
    }

    body{
        background:url('./image/bg.png');
        background-repeat: repeat;
    }
    
    #ok{
        position: absolute;
        margin-top: 50px;
        right: 35%;
        font-size: 15px;
    
    }
    textarea{
        position: absolute;
        margin-top: 80px;
        left: 20%;
       /* right: 30%;*/
    }
    #nn{
        position: absolute;
        margin-top: 20px;
        left: 20%;
        color: white;
        width: 40%;
        text-align: left;
    }
    #nn  input{
        width: 60%;
    }

    #tit{
        position: absolute;
        left: 20%;
        margin-top: 50px;
        color: white;
    }
                               
    </style>
</head>

<?php
session_start();
$user=$_SESSION['name'];  
$time=$_GET['mtime'];
echo  $time;
$notes="";

$con = mysql_connect("localhost","root","liuyuhan");
mysql_query("set names utf8");
mysql_select_db("Collection",$con);
$result=mysql_query("select  MContent  from   Memo   where   UName='$user'  AND  MTime='$time' ");
if(mysql_num_rows($result)  > 0)
{
        $row=mysql_fetch_array($result);
        $cont=$row['MContent'];
}
mysql_close($con);
?>

<body>
            <center>
    	<form    action="jpmemo.php"   method="post">
                       
    		<label    id="nn">备注：<input type="text" name="notes"    value="<?php  echo  $notes;  ?>"></label>
                         <label    id="tit">正文：</label>  
                         <input type="hidden" name="time"    value="<?php  echo  $time;  ?>">                
                         <input type="submit" value="保存" id="ok">
                           
                         <textarea  name="cont"  rows=50  cols= 40%    ><?php  echo   $cont; ?></textarea>
    	</form>
    
</body>
</html>