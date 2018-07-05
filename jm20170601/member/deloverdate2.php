<?php
  require_once("dbtools.inc.php");
  
  //取得表單資料
  $delid001 = $_POST["delid001"];

  //建立資料連接
  $link = create_connection();

//將要刪除的資料先保留在變數
  $sql = "SELECT * FROM jmmember001 where id='$delid001'";
  $result = execute_sql($link, "linyumo_wk01", $sql);
  $row = mysqli_fetch_row($result);
  $keepdate = $row;
  $j=$row[24];

//重排KEY單球號
  $sql = "SELECT * FROM jmmember001 ORDER BY id DESC";
  $result = execute_sql($link, "linyumo_wk01", $sql);
  $row = mysqli_fetch_row($result);
  $bigi=$row[0];

  //執行 UPDATE 陳述式來更新使用者資料
  for ($i=($delid001+1);$i<=$bigi;$i++) {
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
    $memid1 = $j;
    $j++;
    $sql = "update jmmember001 set memberid001=$memid1 WHERE id=$i";
    $result = execute_sql($link, "linyumo_wk01", $sql);
    }
  }
  //釋放 $result 佔用的記憶體
  mysqli_free_result($result);

		
    //執行 SQL 命令，將刪除的資料保留備查
    $sql = "INSERT INTO jmdellog001 (
    id, account, password, name, taiwid001, year, month, day, telephone, cellphone, fax, email, address, bname001, 
    bbranch001, baccount001, bowner001, fatherid001, fathertwid001, fathername001, fatherid002, fathername002, 
    fatherid003, fathername003, memberid001, memberid002, qualification, qualificationno, date001, date002, 
    luckps001, rema001, qualification2) 
    VALUES (
    '$keepdate[0]', '$keepdate[1]', '$keepdate[2]', '$keepdate[3]', '$keepdate[4]', '$keepdate[5]', '$keepdate[6]', 
    '$keepdate[7]', '$keepdate[8]', '$keepdate[9]', '$keepdate[10]', '$keepdate[11]', '$keepdate[12]', '$keepdate[13]', 
    '$keepdate[14]', '$keepdate[15]', '$keepdate[16]', '$keepdate[17]', '$keepdate[18]', '$keepdate[19]', '$keepdate[20]', 
    '$keepdate[21]', '$keepdate[22]', '$keepdate[23]', '$keepdate[24]', '$keepdate[25]', '$keepdate[26]', '$keepdate[27]', 
    '$keepdate[28]', '$keepdate[29]', '系統刪除', '$keepdate[31]', '$keepdate[32]')";
    $result = execute_sql($link, "linyumo_wk01", $sql);
    //釋放 $result 佔用的記憶體	
    mysqli_free_result($result);

    //執行刪除
    $sql="delete from jmmember001 where id=$delid001";
    $result=execute_sql($link,"linyumo_wk01",$sql);

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
      <?php echo "$name"; ?>您已經刪除資料成功了。
      <p style=text-align:center;font-size:24px;color:#c3c;>請 <a href="javascript:window.close();">關閉視窗</a> ! 謝謝!</p>
    </center>        
  </body>
</html>