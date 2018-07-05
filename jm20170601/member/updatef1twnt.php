<?php

    //建立資料連接
  require_once("dbtools.inc.php");

  function execute_sql1($link, $database, $sql1){
  mysqli_select_db($link, $database) or die("開啟資料庫失敗: " . mysqli_error($link));
  $result1 = mysqli_query($link, $sql1);
  return $result1;
  }

  //建立資料連接
  $link = create_connection();

  //執行 UPDATE 陳述式來更新使用者資料
    $sql = "select * from jmmember001 where id=86";
    $result = execute_sql($link, "linyumo_wk01", $sql);

  if (mysqli_num_rows($result) == 0) {
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result);
    }
  else {
    //取得資料
    $row = mysqli_fetch_row($result);
    $sql1 = "select * from jmmember001 where memberid002=$row[17]";
echo "推薦人球號:".$row[17];
    $result1 = execute_sql1($link, "linyumo_wk01", $sql1);

  if (mysqli_num_rows($result1) == 0) {
    //釋放 $result 佔用的記憶體
    //mysqli_free_result($result1)
echo "找不到:".$row[17];
    }
  else {
    //取得資料
    $row1 = mysqli_fetch_row($result1);
echo "身分證:".$row1[4];
echo "名　字:".$row1[3];

    $sql = "update jmmember001 set fathertwid001='$row1[4]', fathername001='$row1[3]' WHERE id=86";
    $result = execute_sql($link, "linyumo_wk01", $sql);
}
}

  //釋放 $result 佔用的記憶體
  //mysqli_free_result($result)
  //mysqli_free_result($result1)

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