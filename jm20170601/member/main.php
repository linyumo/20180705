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
  //建立資料連接
  $link = create_connection();
  $sql = "SELECT * FROM jmmember001 where luckps001 = 'UNPAID'";
  $result = execute_sql($link, "linyumo_wk01", $sql);
  $row = mysqli_fetch_row($result);
  $firstunpaidid001=$row[0];
  $firstunpaid001=$row[24];
  $firstunpaidname001=$row[3];
  mysqli_free_result($result1);

      //指定每頁顯示幾筆記錄
      $records_per_page = 10;

  //計算待牌號(繳費)的頁數
  $fupage=ceil($firstunpaidid001/$records_per_page);

?>
<!doctype html>
<html>
  <head>
    <title>會員管理</title>
    <meta charset="utf-8">
  </head>
  <body>
    <p align="center"><img src="management.jpg"></p>
    <p align="center"><?php echo "收件中心 : $aname ( $aid )"; ?>
    <a style=text-decoration:none; href="maind.php" target="_blank">
    <font style="font-size:12px;">&nbsp;-&nbsp;[ 備查資訊 ]</font></a>
    <br>待排號(繳費)確認 : 
    &nbsp;<b><?php echo $firstunpaidname001; ?></b>
    &nbsp;(編號&nbsp;<b><?php echo $firstunpaid001; ?></b>)
    &nbsp;在第<?php echo "<a style=text-decoration:none; href='show_record.php?page=$fupage'><font color=#c00>$fupage</font></a>"; ?>頁
    </p>
    <p align="center">
      <a style=text-decoration:none; href="join.php">新增會員資料</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a style=text-decoration:none; href="accounting.php" target="_blank">會計系統</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a style=text-decoration:none; href="notrebuy01.php" target="_blank">未重銷名單</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a style=text-decoration:none; href="logout.php">登出網站</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a style=text-decoration:none; href="javascript:window.location.reload()">重新整理</a>
    </p>
    <form action="main.php" method="post" name="filter">
     <table border="0" align="center" style="border-style:solid; border-collapse:collapse; border-spacing:0px;">
    <tr>
    <td>
     <input name="twid" type="text" size="20" placeholder="搜尋身分證字號">&nbsp;&nbsp;&nbsp;
     </td>
     <td>
     <input name="name" type="text" size="20"  placeholder="搜尋名字">&nbsp;&nbsp;&nbsp;
     </td>
     <td>
     <input name="tel" type="text" size="20"  placeholder="搜尋電話">&nbsp;&nbsp;&nbsp;
     </td>
     <td>
     <input type="submit" value="搜尋">&nbsp;&nbsp;&nbsp;
     </td></tr></table>
     </form>
      <!-- a href="modify.php"><a href="#">修改會員資料</a-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <!-- a href="delete.php"><a href="#">刪除會員資料</a-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


 <?php
      $stwid001 = $_POST["twid"];
      $sname001 = $_POST["name"];
      $stel001 = $_POST["tel"];
  function execute_sql1($link, $database, $sql1){
  mysqli_select_db($link, $database) or die("開啟資料庫失敗: " . mysqli_error($link));
  $result1 = mysqli_query($link, $sql1);
  return $result1;
  }
			
      //取得要顯示第幾頁的記錄
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;

 //執行 SQL 命令
      $sql = "SELECT * FROM jmmember001";

  if ($stel001 != ""){
    $sql = "SELECT * FROM jmmember001 where telephone LIKE '%$stel001%' OR cellphone LIKE '%$stel001%'";
  }
  if ($sname001 != ""){
    $sql = "SELECT * FROM jmmember001 where fathername001 LIKE '%$sname001%' OR name LIKE '%$sname001%'";
  }
  if ($stwid001 != ""){
    $sql = "SELECT * FROM jmmember001 where taiwid001 LIKE '%$stwid001%' OR fathertwid001 LIKE '%$stwid001%'";
  }
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
      echo "<td>項次</td>";
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
      echo "<td><font color=#c00><b>功能</b></font></td>";
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


  $sql1 = "select * from jmmember001 where taiwid001='$row[18]'";
  $result1 = execute_sql1($link, "linyumo_wk01", $sql1);
   if (mysqli_num_rows($result1) == 0){
    $fatherid001=0;
    //釋放 $result1 佔用的記憶體
    mysqli_free_result($result1);
    }
  else{
    $row1 = mysqli_fetch_row($result1);
    $fatherid001=$row1[25];
  }

        echo "<td>$row[19]<br>$row[18]</td>";
        echo "<td>($row[20])<br>$row[21]</td>";
        echo "<td>";
    if ($row[22]==0){
    echo "<font color=#c60><b> ($row[22])</b></font>";
    }
    else{
    echo"($row[22])";
    }
        echo"<br>$row[23]</td>";
        echo "<td>$row[24]</td>";
    if ($row[25]==0){
    echo "<td><font color=#c60><b>$row[25]</b></font></td>";
    }
    else{
    echo "<td>$row[25]</td>";
    }
        echo "<td>$row[21]</td>";
        echo "<td>$row[26]<br>($row[27])$row[32]</td>";
        echo "<td>$row[28]<br>$row[29]</td>";
    if (($row[30]=="UNPAID")and($row[0]==$firstunpaid001)){
    echo "<td align=center><a href=updatepaid.php?paid=$row[0] target='_blank'><font color=#c00><b>按一下<br>確認繳費</b></font></a></td>";
    }
    else{
    if ($row[30]=="UNPAID"){
    echo "<td align=center><font color=#c60><b>排隊待<br>確認繳費</b></font></a></td>";
    }
    else{
    echo "<td>$row[30]</td>";
    }
    }
        echo "<td>$row[31]</td>";
    $date001 = strtotime($row[28]);
    if ((date("Y-m-d", strtotime("+3 days", $date001))<date("Y-m-d")) and ($row[30]=="UNPAID")){
    echo "<td><a style=text-decoration:none; href='deloverdate.php?delid=$row[0]' target='_blank'><font color=#090><b>刪除</b></font></a>
    <br><a style=text-decoration:none; href='modify.php?editid001=$row[0]' target='_blank'><font color=#c00><b>修改</b></font></a></td>";
    }
    else{
    echo "<td><a style=text-decoration:none; href='modify.php?editid001=$row[0]' target='_blank'><font color=#c00><b>修改</b></font></a></td>";
    }

        $j++;
        echo "</tr>";		
      }
      echo "</table>" ;
			
      //產生導覽列
      echo "<p align='center'>";
      if ($page > 1)
        echo "<a href='show_record.php?twid=".$stwid001."&name=".$sname001."&tel=".$stel001."&page=". ($page - 1) . "'>上一頁</a> ";
      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
          echo "$i ";
        else
          echo "<a href='show_record.php?twid=".$stwid001."&name=".$sname001."&tel=".$stel001."&page=$i'>$i</a> ";		
      }
			
      if ($page < $total_pages)
        echo "<a href='show_record.php?twid=".$stwid001."&name=".$sname001."&tel=".$stel001."&page=". ($page + 1) . "'>下一頁</a> ";	
				
			echo "</p>";
			
      //釋放記憶體空間
      mysqli_free_result($result);
      mysqli_close($link);
    ?> 

  </body>
</html>