<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE["passed"];

	
  /*  如果 cookie 中的 passed 變數不等於 TRUE
      表示尚未登入網站，將使用者導向首頁 index.html	*/
  if ($passed != "TRUE")
  {
    header("location:index.html");
    exit();
  }
?>
<!doctype html>
<html>
  <head>
    <title>會員管理</title>
    <meta charset="utf-8">
  </head>
  <body>

 <?php
      require_once("showdbtools.inc.php");

function execute_sql1($link, $database, $sql1){
mysqli_select_db($link, $database) or die("開啟資料庫失敗: " . mysqli_error($link));
$result1 = mysqli_query($link, $sql1);
return $result1;
}

      //建立資料連接
      $link = create_connection();

      //計算目前的球號
      $sql = "SELECT MAX(memberid001) FROM jmmember001";	
      $result = execute_sql($link, "linyumo_wk01", $sql);
      $row = mysqli_fetch_row($result);
      $allno=$row[0];
?>

    <p align="center"><img src="management.jpg"></p>
    <p align="center">
      <font style="font-size:32px; color:#c50;"><b>目前總會員編號=<?php echo "$allno"; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></font>
      <!-- a href="join.html">新增會員資料</a> -->
      <!-- a href="modify.php">修改會員資料</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
      <!-- a href="delete.php">刪除會員資料</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
<a href="javascript:window.close();">關閉視窗</a>
    </p>

 <?php
     $id = $_COOKIE{"id"};
     $account = $_COOKIE["account"];
     $whosfathertwid= $_COOKIE["whosfathertwid"];
			
      //指定每頁顯示幾筆記錄
      $records_per_page = 10;
			
      //取得要顯示第幾頁的記錄
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
				
      //建立資料連接
      $link = create_connection();
			
      //執行 SQL 命令
     $sql = "SELECT * FROM jmmember001 Where fathertwid001 = '$whosfathertwid'";
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
      echo "<table border='1' align='center' width='100%'>";
      echo "<tr align='center'>";			
      echo "<td>項次</td>";
      echo "<td>姓名</td>";
      echo "<td>身分證</td>";
      echo "<td>會員編號</td>";
      echo "<td>註冊日期</td>";
      echo "<td>推薦人</td>";
      echo "<td>狀態</td>";
      echo "<td>達成第1次獎金<br>會員(球號)註冊日期</td>";
      echo "<td>達成第2次獎金<br>會員(球號)註冊日期</td>";
      echo "<td>達成第3次獎金<br>會員(球號)註冊日期</td>";
      echo "<td>統計直推人數<br>(清單)</td>";
      echo "</tr>";
			
      //顯示記錄

      $j = 1;
      while ($row = mysqli_fetch_row($result) and $j <= $records_per_page)
      {
        echo "<tr align='center'>";
		
if ($row[30]!="UNLK"){
    $myluck = "<font stype=font-size:11 color:#c00>[需確認]</font>";
}
else {
    $myluck = "正常";
}

//計算公式
$myno= $row[25];
$formula1=(int)$myno*27+1;
$formula2=(int)$myno*77+1;
$formula3=(int)$myno*157+1;
$rowtwid=substr($row[4], 0, -4)."****";

          echo "<td>$row[0]</td>";
          echo "<td>$row[3]</td>";
          echo "<td>$rowtwid</td>";
          echo "<td>$row[25]</td>";
          echo "<td>$row[28]</td>";
          echo "<td>$row[19]</td>";
          echo "<td>$myluck</td>";

//抓取達成球號資料錄
$cashbackname1="未達";
$cashbackname2="未達";
$cashbackname3="未達";
$cashbackno1="會員數";
$cashbackno2="會員數";
$cashbackno3="會員數";
$cashbackdate1="SOON";
$cashbackdate2="SOON";
$cashbackdate3="SOON";

$sql1 = "select * from jmmember001 where memberid002 >= $formula1";
$result1 = execute_sql1($link, "linyumo_wk01", $sql1);
if (mysqli_num_rows($result1) == 0){
          echo "<td>$cashbackname1($cashbackno1)<br>$cashbackdate1</td>";
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result1);
}
  //若有資料則取真球與註冊日
  else{
  $row1 = mysqli_fetch_row($result1);
  $cashbackname1=substr($row1[3], 0, 3)."Ｏ".substr($row1[3], 6, 3);
  $cashbackno1=$row1[25];
  $cashbackdate1=$row1[28];
          echo "<td>$cashbackname1($cashbackno1)<br>$cashbackdate1</td>";
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result1);
  }

$sql1 = "select * from jmmember001 where memberid001 >= $formula2";
$result1 = execute_sql1($link, "linyumo_wk01", $sql1);
if (mysqli_num_rows($result1) == 0){
          echo "<td>$cashbackname2($cashbackno2)<br>$cashbackdate2</td>";
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result1);
}
  //若有資料則取真球與註冊日
  else{
  $row1 = mysqli_fetch_row($result1);
  $cashbackname2=substr($row1[3], 0, 3)."Ｏ".substr($row1[3], 6, 3);
  $cashbackno2=$row1[25];
  $cashbackdate2=$row1[28];
          echo "<td>$cashbackname2($cashbackno2)<br>$cashbackdate2</td>";
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result1);
  }

$sql1 = "select * from jmmember001 where memberid001 >= $formula3";
$result1 = execute_sql1($link, "linyumo_wk01", $sql1);
if (mysqli_num_rows($result1) == 0){
          echo "<td>$cashbackname3($cashbackno3)<br>$cashbackdate3</td>";
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result1);
}
  //若有資料則取真球與註冊日
  else{
  $row1 = mysqli_fetch_row($result1);
  $cashbackname3=substr($row1[3], 0, 3)."Ｏ".substr($row1[3], 6, 3);
  $cashbackno3=$row1[25];
  $cashbackdate3=$row1[28];
          echo "<td>$cashbackname3($cashbackno3)<br>$cashbackdate3</td>";
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result1);
  }

$sql1 = "select * from jmmember001 where fathertwid001 ='$row[18]'";
$result1 = execute_sql1($link, "linyumo_wk01", $sql1);
if (mysqli_num_rows($result1) == 0){
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result1);
}
  //若有資料
  else{
  $rows1 = mysqli_num_rows($result);
          echo "<td>$rows1</td>";
}
        
        $j++;
        echo "</tr>";		
      }
      echo "</table>" ;
			
      //產生導覽列
      echo "<p align='center'>";
      if ($page > 1)
        echo "<a href='show_recordf.php?page=". ($page - 1) . "'>上一頁</a> ";
				
      for ($i = 1; $i <= $total_pages; $i++)
      {
        if ($i == $page)
          echo "$i ";
        else
          echo "<a href='show_recordf.php?page=$i'>$i</a> ";		
      }
			
      if ($page < $total_pages)
        echo "<a href='show_recordf.php?page=". ($page + 1) . "'>下一頁</a> ";	
				
			echo "</p>";
			
      //釋放記憶體空間
      mysqli_free_result($result);
      mysqli_close($link);
    ?> 
  </body>
</html>