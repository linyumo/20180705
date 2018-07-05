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
    $password = $_POST["password"];
    $address = $_POST["address"];
    $telephone = $_POST["telephone"];
    $cellphone = $_POST["cellphone"];
    $fax = $_POST["fax"];
    $email = $_POST["email"];
    $bname001=$_POST["bname001"];
    $bbranch001=$_POST["bbranch001"];
    $baccount001=$_POST["baccount001"];
    $bowner001=$_POST["bowner001"];
    $luckps001 = $_POST["luckps001"];
		
    //建立資料連接
    $link = create_connection();
				
    //執行 UPDATE 陳述式來更新使用者資料
    $sql = "UPDATE jmmember001 SET password = '$password', address = '$address', telephone = '$telephone', cellphone = '$cellphone', fax = '$fax', email = '$email', bname001 = '$bname001', bbranch001 = '$bbranch001', baccount001 = '$baccount001', bowner001 = '$bowner001' WHERE id = $editid001";
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
      <?php echo $name ?>，恭喜您已經修改資料成功了。
      <p><a href="main.php">回會員專屬網頁</a></p>
    </center>        
  </body>
</html>