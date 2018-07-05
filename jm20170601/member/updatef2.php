<?php

    //建立資料連接
  require_once("dbtools.inc.php");

  //建立資料連接
  $link = create_connection();

  //執行 UPDATE 陳述式來更新使用者資料
  for ($i=700;$i<1000;$i++) {
    $sql = "select * from jmmember001 where id=$i";
    $result = execute_sql($link, "linyumo_wk01", $sql);

  if (mysqli_num_rows($result) == 0) {
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result);
    }
  else {
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result);

    //取得資料
    $fatherid002 = 1;
    $fathername002 = 'B01總公司';
    $sql = "update jmmember001 set fatherid002='$fatherid002', fathername002='$fathername002' WHERE id=$i";
    $result = execute_sql($link, "linyumo_wk01", $sql);
    }
  }

  //釋放 $result 佔用的記憶體
  mysqli_free_result($result);

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