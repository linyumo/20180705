<?php

    //建立資料連接
  $link = mysqli_connect("localhost", "idc01", "zxc123") or die("無法建立資料連接: " . mysqli_connect_error());
   mysqli_query($link, "SET NAMES utf8");

 function execute_sql($link, $database, $sql){
  mysqli_select_db($link, $database) or die("開啟資料庫失敗: " . mysqli_error($link));
   $result = mysqli_query($link, $sql);
   return $result;
 }

 function execute_sql1($link, $database, $sql1){
  mysqli_select_db($link, $database)
   or die("開啟資料庫失敗: " . mysqli_error($link));
   $result1 = mysqli_query($link, $sql1);
   return $result1;
 }

 function execute_sql2($link, $database, $sql2){
  mysqli_select_db($link, $database)
   or die("開啟資料庫失敗: " . mysqli_error($link));
   $result2 = mysqli_query($link, $sql2);
   return $result2;
 }

 function execute_sql3($link, $database, $sql3){
  mysqli_select_db($link, $database)
   or die("開啟資料庫失敗: " . mysqli_error($link));
   $result3 = mysqli_query($link, $sql3);
   return $result3;
 }

    //取得資料
    $fatherid002 = 1;
    $fathername002 = 'B01總公司';

for ($i=1;$i<1000;$i++){
    //執行 UPDATE 陳述式來更新使用者資料
    $sql = "select * from jmmember001 where id=$i";
    $result = execute_sql($link, "linyumo_wk01", $sql);

 if (mysqli_num_rows($result) == 0){
  //釋放 $result 佔用的記憶體
  mysqli_free_result($result);
}
 else{
 $row = mysqli_fetch_row($result);
  $sql1 = "select * from jmmember001 where memberid001=$row[17]";
  $result1 = execute_sql1($link, "linyumo_wk01", $sql1);
  $row1 = mysqli_fetch_row($result1);
  $fathertwid001=$row1[4];
  $fathername001=$row1[3];

if ($row[17] < 86){
 $fathertwid001 = "0";
 $fathername001 = "(".$row[17].")待確認";
}

$sql = "UPDATE jmmember001 SET account='$row[4]', fatherid002=$fatherid002, fathername002 = '$fathername002', fathertwid001=$fathertwid001, fathername001='$fathername001' WHERE id=$i";
$result = execute_sql($link, "linyumo_wk01", $sql);

}
}
      //釋放記憶體空間
      //mysqli_free_result($result);
      //mysqli_free_result($result1);

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
      <?php echo $uid001." / ".$fatherid002." / ".$fathername002."<br>".$sql; ?>，恭喜您已經修改資料成功了。
      <p><a href="main.php">回會員專屬網頁</a></p>
    </center>        
  </body>
</html>