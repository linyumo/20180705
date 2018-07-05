<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $aid = $_COOKIE["aid"];
  $aname = $_COOKIE["aname"];
  $passed = $_COOKIE["passed"];
	
  /*  如果 cookie 中的 passed 變數不等於 TRUE
      表示尚未登入網站，將使用者導向首頁 index.html	*/
  if ($passed != "TRUE")
  {
    header("location:index.html");
    exit();
  }

require_once("showdbtools.inc.php");
  //建立資料連接
  $link = create_connection();
  $sql = "SELECT * FROM jmdellog001 where luckps001 = 'UNPAID'";
  $result = execute_sql($link, "linyumo_wk01", $sql);
  $row = mysqli_fetch_row($result);
  $firstunpaid001=$row[0];
  mysqli_free_result($result1);

?>
<!doctype html>
<html>
  <head>
    <title>刪除會員備查</title>
    <meta charset="utf-8">
  </head>
  <body>
    <p align="center"><img src="management.jpg"></p>
    <p align="center">刪除會員備查</p>
    <p align="center">
      <a href="javascript:window.close();"><font color=#909>關閉視窗</font></a>&nbsp;&nbsp;&nbsp;&nbsp;
      <a href="javascript:window.location.reload()"><font color=#909>重新整理</font></a>
    </p>

 <?php
  function execute_sql1($link, $database, $sql1){
  mysqli_select_db($link, $database) or die("開啟資料庫失敗: " . mysqli_error($link));
  $result1 = mysqli_query($link, $sql1);
  return $result1;
  }

      //指定每頁顯示幾筆記錄
      $records_per_page = 10;
			
      //取得要顯示第幾頁的記錄
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;

 //執行 SQL 命令
      $sql = "SELECT * FROM jmdellog001";
      $result = execute_sql($link, "linyumo_wk01", $sql);
			
      //取得欄位數
      $total_fields = mysqli_num_fields($result);
			
      //取得記錄數
      $total_records = mysqli_num_rows($result);
			
      //計算總頁數
      $total_pages = ceil($total_records / $records_per_page);
			
      //計算本頁第一筆記錄的序號
      $started_record = $records_per_page * ($page - 1);
			
      //將記錄指標移至本頁第一筆記錄的序號
      mysqli_data_seek($result, $started_record);
		  
      //顯示欄位名稱
      echo "<table border='1' align='center' style='border-style:solid; border-collapse:collapse; border-spacing:0px;'>";
      echo "<tr align='center' style='font-size:14px;'>";			
      echo "<td>項次ID</td>";
      echo "<td>帳號<br>密碼</td>";
      echo "<td>姓名<br>身分證</td>";
      echo "<td>民國生日</td>";

      echo "<td>地址</td>";
      echo "<td>聯絡方式</td>";
      echo "<td>傳真/Email</td>";

      echo "<td>匯款行庫(分行)戶名<br>帳號</td>";
      echo "<td>推薦人<br>身分證</td>";
      echo "<td>(KEY單人)<br>KEY單中心</td>";
      echo "<td>(確認人)<br>確認中心</td>";
      echo "<td>KEY單球號</td>";
      echo "<td>真實球號</td>";
      echo "<td>收件中心</td>";
      echo "<td>入會類別<br>(編號)註</td>";
      echo "<td>KEY單日<br>繳費日</td>";
      echo "<td>狀態</td>";
      echo "<td>備註</td>";
      echo "</tr>";
			
      //顯示記錄
      $j = 1;
      while ($row = mysqli_fetch_row($result) and $j <= $records_per_page){
        echo "<tr  style='font-size:14px;'>";		
        echo "<td>$row[0]</td>";	
        echo "<td>$row[1]<br>$row[2]</td>";
        echo "<td>$row[3]<br>$row[4]</td>";
        echo "<td>$row[5]/$row[6]/$row[7]</td>";
        echo "<td style='font-size:12px;'>$row[12]</td>";
        echo "<td>$row[8]<br>$row[9]</td>";
        echo "<td>$row[10]<br>$row[11]</td>";
        echo "<td>$row[13]&nbsp;($row[14])&nbsp;$row[16]<br>$row[15]</td>";
        echo "<td>$row[19]<br>$row[18]</td>";
        echo "<td>($row[20])<br>$row[21]</td>";
        echo "<td>($row[22])<br>$row[23]</td>";
        echo "<td>$row[24]</td>";
        echo "<td>$row[25]</td>";
        echo "<td>$row[21]</td>";
        echo "<td>$row[26]<br>($row[27])$row[32]</td>";
        echo "<td>$row[28]<br>$row[29]</td>";
        echo "<td>$row[30]<br>(UNPAID=尚未繳費)</td>";
        echo "<td>$row[31]</td>";
        echo "</tr>";
        $j++;
      }
      echo "</table>" ;
			
      //產生導覽列
      echo "<p align='center'>";
      if ($page > 1)
        echo "<a href='show_recordd.php?twid=".$stwid001."&name=".$sname001."&tel=".$stel001."&page=". ($page - 1) . "'>上一頁</a> ";
      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
          echo "$i ";
        else
          echo "<a href='show_recordd.php?twid=".$stwid001."&name=".$sname001."&tel=".$stel001."&page=$i'>$i</a> ";		
      }
			
      if ($page < $total_pages)
        echo "<a href='show_recordd.php?twid=".$stwid001."&name=".$sname001."&tel=".$stel001."&page=". ($page + 1) . "'>下一頁</a> ";	
				
			echo "</p>";
			
      //釋放記憶體空間
      mysqli_free_result($result);
      mysqli_close($link);
    ?> 

  </body>
</html>