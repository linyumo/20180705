<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $aid = $_COOKIE["aid"];
  $aname = $_COOKIE["aname"];
  $passed = $_COOKIE["passed"];

  //時區宣告
  date_default_timezone_set ("Asia/Taipei");

  /*  如果 cookie 中的 passed 變數不等於 TRUE
      表示尚未登入網站，將使用者導向首頁 index.html	*/
  if ($passed != "TRUE")
  {
    header("location:index.html");
    exit();
  }

  require_once("showdbtools.inc.php");
  function execute_sql1($link, $database, $sql1)
  {
    mysqli_select_db($link, $database)
    or die("開啟資料庫失敗: " . mysqli_error($link));
    $result1 = mysqli_query($link, $sql1);
    return $result1;
  }

  //建立資料連接
  $link = create_connection();

  //找到原始會員的最新紀錄
  $sql = "SELECT * FROM jmoriginal001 order by id desc";
  $result = execute_sql($link, "linyumo_wk01", $sql);
  //取得記錄數
  $rows = mysqli_num_rows($result);
  $row = mysqli_fetch_row($result);

  $staraddid=$row[3];

  //找到原始會員的最新紀錄之後加入的會員
  $sql1 = "SELECT * FROM jmmember001 where id > '$staraddid' order by id";
  $result1 = execute_sql1($link, "linyumo_wk01", $sql1);
  //取得記錄數
  $rows1 = mysqli_num_rows($result1);

  while($row1 = mysqli_fetch_row($result1)){

  $searchtwid=$row1[4];

  //檢查帳號密碼是否正確
  $sql = "SELECT * FROM jmoriginal001 where twid = '$searchtwid'";
  $result = execute_sql($link, "linyumo_wk01", $sql);

  //如果帳號密碼錯誤
  if (mysqli_num_rows($result) == 0){
  $sql = "INSERT INTO jmoriginal001 (twid, name, originalid, remark) 
                   VALUES ('$row1[4]', '$row1[3]', '$row1[0]', '$now001')";     
  $result = execute_sql($link, "linyumo_wk01", $sql);
  }
  }
?>
<!doctype html>
<html>
  <head>
    <title>未完成重銷清單</title>
    <meta charset="utf-8">
  </head>
  <body>
  <p align="center"><img src="management.jpg"></p>
  <p align="center"><b>3個月內未完成重銷清單</b>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a style=text-decoration:none; href="javascript:window.close();">關閉視窗</a>  
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <a style=text-decoration:none; href="javascript:window.location.reload()">重新整理</a>
</p>
  <?php
      //顯示欄位名稱
      echo "<table border='1' align='center' style='border-collapse: collapse; border-spacing: 0px;'>";
      echo "<tr align='center' style='font-size:14px;'>";			
      echo "<td>項次</td>";
      echo "<td>ID</td>";
      echo "<td>帳號<br>密碼</td>";
      echo "<td>姓名<br>身分證</td>";
      echo "<td>民國生日</td>";
      echo "<td>地址</td>";
      echo "<td>聯絡方式</td>";
      echo "<td>傳真/Email</td>";
      echo "<td>匯款行庫(分行)戶名<br>帳號</td>";
      echo "<td>推薦人<br>身分證</td>";
      echo "<td>註冊日</td>";
      echo "</tr>";

  //按照原始會員資料庫排序出超過3個月未重銷清單
  $sql = "SELECT * FROM jmoriginal001 order by id desc";
  $result = execute_sql($link, "linyumo_wk01", $sql);
  $i=1;
  while($row = mysqli_fetch_row($result)){
  $sql1 = "SELECT * FROM jmmember001 where taiwid001= '$row[1]' or fathertwid001='$row[1]' order by id desc";
  $result1 = execute_sql1($link, "linyumo_wk01", $sql1);
  $rows1 = mysqli_num_rows($result1);
  $row1 = mysqli_fetch_row($result1);
  $date001 =strtotime($row1[28]);
  $date002= date("Y-m-d", strtotime("+3 month", $date001));
  if ($date002<date('Y-m-d')){
         echo "<tr  style='font-size:14px;'>";
        echo "<td>$i</td>";
        $i++;	
        echo "<td>$row1[0]</td>";	
        echo "<td>$row1[1]<br>$row1[2]</td>";
        echo "<td>$row1[3]<br>$row1[4]</td>";
        echo "<td>$row1[5]/$row1[6]/$row1[7]</td>";
        echo "<td style='font-size:12px;'>$row1[12]</td>";
        echo "<td>$row1[8]<br>$row1[9]</td>";
        echo "<td>$row1[10]<br>$row1[11]</td>";
        echo "<td>$row1[13]&nbsp;($row1[14])&nbsp;$row1[16]<br>$row[15]</td>";
        echo "<td>$row1[19]<br>$row1[18]</td>";
        echo "<td>$row1[28]</td>";
        echo "</tr>";		
      }
else{
}
  }
  echo "</table>" ;
  ?> 
  </body>
</html>