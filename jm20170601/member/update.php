<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE["passed"];
	
  /* 如果 cookie 中的 passed 變數不等於 TRUE，
     表示尚未登入網站，將使用者導向首頁 index.html */
  if ($passed != "TRUE")
  {
    header("location:index.html");
    exit();
  }
	
  /* 如果 cookie 中的 passed 變數等於 TRUE，
     表示已經登入網站，則取得使用者資料 */
  else
  {
    require_once("dbtools.inc.php");
	
    //取得 modify.php 網頁的表單資料
    $id = $_COOKIE["id"];
    $editid001 = $_POST["editid001"];
    $account = $_POST["account"];
    $password = $_POST["password"];

    $name = $_POST["name"];
    $taiwid001 = $_POST["taiwid001"];

    $year = $_POST["year"];
    $month = $_POST["month"];
    $day = $_POST["day"];

    $telephone = $_POST["telephone"];
    $cellphone = $_POST["cellphone"];
    $fax = $_POST["fax"];
    $email = $_POST["email"];
    $address = $_POST["address"];

    $bname001=$_POST["bname001"];
    $bbranch001=$_POST["bbranch001"];
    $baccount001=$_POST["baccount001"];
    $bowner001=$_POST["bowner001"];

   $fatherid001 = $_POST["fatherid001"];
   $fathertwid001 = $_POST["fathertwid001"];
   $fathername001 = $_POST["fathername001"];

   $fatherid002 = $_POST["fatherid002"];
   $fathername002 = $_POST["fathername002"];

   $fatherid003 = $_POST["fatherid003"];
   $fathername003 = $_POST["fathername003"];

   $memberid001 = $_POST["memberid001"];
   $memberid002 = $_POST["memberid002"];

   $qualification = $_POST["qualification"];
   $qualification2 = $_POST["qualification2"];
   $qualificationno = $_POST["qualificationno"];

   $date001 = $_POST["date001"];
   $date002 = $_POST["date002"];

   $luckps001 = $_POST["luckps001"];
   $rema001 = $_POST["rema001"];
		
    //建立資料連接
    $link = create_connection();
				
    //執行 UPDATE 陳述式來更新使用者資料
$sql = "UPDATE jmmember001 SET 

account = '$account', 
password = '$password', 

name = '$name', 
taiwid001 = '$taiwid001', 

year = $year, 
month = $month, 
day = $day, 

telephone = '$telephone', 
cellphone = '$cellphone', 
fax = '$fax', 
email = '$email', 
address = '$address', 

bname001 = '$bname001', 
bbranch001= '$bbranch001', 
bowner001 = '$bowner001', 
baccount001 = '$baccount001', 

fatherid001 = '$fatherid001', 
fathertwid001 = '$fathertwid001', 
fathername001 = '$fathername001', 

fatherid002 = '$fatherid002', 
fathername002 = '$fathername002', 

fatherid003 = '$fatherid003', 
fathername003 = '$fathername003', 

memberid001 = '$memberid001', 
memberid002 = '$memberid002', 

qualification =  '$qualification', 
qualification2 =  '$qualification2', 
qualificationno =  '$qualificationno', 

date001 = '$date001', 
date002 = '$date002', 

luckps001 = '$luckps001', 
rema001 = '$rema001'

WHERE id = $editid001";
$result = execute_sql($link, "linyumo_wk01", $sql);
		
    //關閉資料連接
    mysqli_close($link);
  }		
?>
<!doctype html>
<html>
  <head>
    <title>修改會員資料成功</title>
    <meta charset="utf-8">
  </head>
  <body>
    <center>
      <img src="revise.jpg"><br><br>
      <?php echo $name ?>恭喜您已經修改資料成功了。
      <p style=text-align:center;font-size:24px;color:#c3c;>請 <a href="javascript:window.close();">關閉視窗</a> ! 謝謝!</p>
    </center>        
  </body>
</html>