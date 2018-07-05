<?php

    //建立資料連接
  require_once("dbtools.inc.php");
  header("Content-type: text/html; charset=utf-8");

 function execute_sql1($link, $database, $sql1){
  mysqli_select_db($link, $database) or die("開啟資料庫失敗: " . mysqli_error($link));
   $result1 = mysqli_query($link, $sql1);
   return $result1;
 }

 function execute_sql2($link, $database, $sql2){
  mysqli_select_db($link, $database) or die("開啟資料庫失敗: " . mysqli_error($link));
   $result2 = mysqli_query($link, $sql2);
   return $result2;
 }

 function execute_sql3($link, $database, $sql3){
  mysqli_select_db($link, $database) or die("開啟資料庫失敗: " . mysqli_error($link));
   $result3 = mysqli_query($link, $sql3);
   return $result3;
 }

  //取得資料
  $fatherid002 = 1;
  $fathername002 = 'B01總公司';

  //建立資料連接
  $link = create_connection();

for ($i=697;$i<1000;$i++) {

    //執行 UPDATE 陳述式來更新使用者資料
    $sql = "select * from jmmember001 where id=$i";
    $result = execute_sql($link, "linyumo_wk01", $sql);

 if (mysqli_num_rows($result) == 0) {
  //釋放 $result 佔用的記憶體
  mysqli_free_result($result);
}

else {
$sql = "update jmmember001 set fatherid002=$fatherid002, fathername002 = $fathername002 WHERE id=$i";
$result = execute_sql($link, "linyumo_wk01", $sql);
}

}
      //釋放記憶體空間
      //mysqli_free_result($result);

    //關閉資料連接
    mysqli_close($link);
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
      <?php echo "$fatherid002 / $fathername002 <br> $sql"; ?><br>恭喜您已經修改資料成功了。
      <p><a href="main.php">回會員專屬網頁</a></p>
    </center>        
  </body>
</html>