<?php

    //建立資料連接
  require_once("dbtools.inc.php");

  //建立資料連接
  $link = create_connection();

  //執行 UPDATE 陳述式來更新使用者資料
  for ($i=800;$i<950;$i++) {
    $sql = "select * from jmmember001 where id=$i";
    $result = execute_sql($link, "linyumo_wk01", $sql);

  if (mysqli_num_rows($result) == 0) {
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result);
    }
  else {
    $row = mysqli_fetch_row($result);
    //取得資料
   //mktime的傳入參數分別為(時,分,秒,月,日,年)
    //strtotime則是用來比較兩個時間點的差異，當然也可以運算
    $account = $row[4];
    $date001 = strtotime($row[28]);
    $date002 = date("Y-m-d", strtotime("+3 days", $date001));

    //釋放 $result 佔用的記憶體
    mysqli_free_result($result);
    $sql = "update jmmember001 set account='$account', date002='$date002' WHERE id=$i";
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
      <?php echo " $account / $date001 / $date002 "; ?><br>恭喜您已經修改資料成功了。
      <p><a href="main.php">回會員專屬網頁</a></p>
    </center>        
  </body>
</html>