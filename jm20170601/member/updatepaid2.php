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
    $paid001 = $_POST["paid001"];

   $fatherid003 = $_POST["fatherid003"];
   $fathername003 = $_POST["fathername003"];

   $memberid002 = $_POST["memberid002"];

   $date002 = $_POST["date002"];

   $luckps001 = $_POST["luckps001"];
   $rema001 = $_POST["rema001"];
		
    //建立資料連接
    $link = create_connection();
				
    //執行 UPDATE 陳述式來更新使用者資料
$sql = "UPDATE jmmember001 SET 

fatherid003 = '$fatherid003', 
fathername003 = '$fathername003', 

memberid002 = '$memberid002', 

date002 = '$date002', 

luckps001 = '$luckps001', 
rema001 = '$rema001'

WHERE id = $paid001";
$result = execute_sql($link, "linyumo_wk01", $sql);
		
    //關閉資料連接
    mysqli_close($link);
  }		
?>
<!doctype html>
<html>
  <head>
    <title>確認繳費成功</title>
    <meta charset="utf-8">
  </head>
  <body>
    <center>
      <img src="revise.jpg"><br><br>
      <?php echo $name ?>恭喜您已經確認繳費成功了。
      <p style=text-align:center;font-size:24px;color:#c3c;>請 <a href="javascript:window.close();">關閉視窗</a> ! 謝謝!</p>
    </center>        
  </body>
</html>