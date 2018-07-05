<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $aid = $_COOKIE["aid"];
  $aname = $_COOKIE["aname"];
  $passed = $_COOKIE["passed"];

//八種獎金金額
//新單直推給推薦人
$bonusa="1000";
//一階分紅
$bonus71="500";
//二階分紅
$bonus72="14000";
//三階分紅
$bonus77="25000";
//四階分紅
$bonus7f="58500";
//重銷一單給推薦人的推薦人
$bonusf72="3000";
//重銷二單給推薦人的推薦人
$bonusf77="5500";
//重銷三單給推薦人的推薦人
$bonusf7f="15500";
//重銷直推給推薦人的推薦人
$bonush="1000";

$bonustype001=$_POST["bonustype001"]; 

  /*  如果 cookie 中的 passed 變數不等於 TRUE
      表示尚未登入網站，將使用者導向首頁 index.html	*/
  if ($passed != "TRUE")
  {
    header("location:index.html");
    exit();
  }

//匯入第一資料庫函式
require_once("showdbtools.inc.php");

//第二資料庫函式
  function execute_sql1($link, $database, $sql1){
  mysqli_select_db($link, $database) or die("開啟資料庫失敗: " . mysqli_error($link));
  $result1 = mysqli_query($link, $sql1);
  return $result1;
  }

  //建立資料連接
  $link = create_connection();

?>
<!doctype html>
<html>
  <head>
    <title>會計系統</title>
    <meta charset="utf-8">
  </head>
  <body>
    <p align="center"><img src="accounting.jpg"></p>
    <p align="center">
    <?php echo "收件中心 : $aname ( $aid )"; ?>&nbsp;&nbsp;&nbsp;
    <a style=text-decoration:none; href="javascript:window.close();">
    <font color=#909>關閉視窗</font></a>&nbsp;&nbsp;&nbsp;
    <a style=text-decoration:none; href="javascript:window.location.reload()">
    <font color=#909>重新整理</font></a>
    </p>

    <form action="accounting.php" method="post" name="filter">
     <table border="0" align="center" style="border-style:solid; border-collapse:collapse; border-spacing:0px;">
    <tr>
    <td>
    <input type="radio" name="bonustype001" value="bonus001" 
  <?php
    if (($bonustype001=="") or ($bonustype001=="bonus001")){
      echo "checked>";
    }
  ?><b>新單直推&nbsp;
    <input type="radio" name="bonustype001" value="bonus002"
  <?php
    if ($bonustype001=="bonus002"){
      echo "checked>";
    }
  ?><b>分紅&原始直推&nbsp;
    <input type="radio" name="bonustype001" value="bonus003"
  <?php
    if ($bonustype001=="bonus003"){
      echo "checked>";
    }
  ?><b><font color="#ccc">備用功能(重銷)</font></b>&nbsp;
    </td>
    <td>
      &nbsp;&nbsp;&nbsp;<font size="1">輸入
     <input name="ayear001" type="text" size="5" placeholder="西元年份" value="2017">&nbsp;
     </td>
     <td>
     <input name="amonth001" type="text" size="5"  placeholder="月份"  value="09">&nbsp;
     </td>
     <td>
     <input type="submit" value="查詢">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     </td>
     </tr>
     </table>
     </form>

 <?php
      $ayear001 = $_POST["ayear001"];
      $amonth001 = $_POST["amonth001"];
			
  if ($ayear001 != ""){
    $staryear001 = $ayear001;
    $endyear001 = $ayear001;
  }
  else {
    $staryear001 = "2017";
    $endyear001 = "2017";
  }

  if ($amonth001 != ""){
    if ($amonth001 >= 3){
    $starmonth001= ($amonth001-2);
    $endmonth001= ($amonth001-1);
    }
    else{
      if ($amonth001 == 2){
      $starmonth001= (12+$amonth001-2);
      $endmonth001= ($amonth001-1);
      $staryear001 = ($staryear001-1);
      }
      else{
        if ($amonth001 == 1){
        $starmonth001= (12+$amonth001-2);
        $endmonth001= (12+$amonth001-1);
        $staryear001 = ($staryear001-1);
        $endyear001 = ($staryear001-1);
        }
        else{
        $starmonth001= "07";
        $endmonth001= "08";
        }
      }
    }
  }
  else{
  $starmonth001= "07";
  $endmonth001= "08";
  }

      //執行 SQL 命令



//選擇獎金形式
  if ($bonustype001==""){
    $sql = "SELECT * FROM jmmember001 where date001 BETWEEN '$staryear001-$starmonth001-16' AND '$endyear001-$endmonth001-15' and qualification = '新單'";
    $result = execute_sql($link, "linyumo_wk01", $sql);
    require_once("bonus001.php");
  }
  if ($bonustype001=="bonus001"){
    $sql = "SELECT * FROM jmmember001 where date001 BETWEEN '$staryear001-$starmonth001-16' AND '$endyear001-$endmonth001-15' and qualification = '新單'";
    $result = execute_sql($link, "linyumo_wk01", $sql);
    require_once("bonus001.php");
  }
  if ($bonustype001=="bonus002"){
    $sql = "SELECT * FROM jmmember001 where date001 BETWEEN '$staryear001-$starmonth001-16' AND '$endyear001-$endmonth001-15' and qualification != '新單'";
    $result = execute_sql($link, "linyumo_wk01", $sql);
    require_once("bonus002.php");
  }
  if ($bonustype001=="bonus003"){
    $sql = "SELECT * FROM jmmember001 where date001 BETWEEN '$staryear001-$starmonth001-16' AND '$endyear001-$endmonth001-15' and qualification = '新單'";
    $result = execute_sql($link, "linyumo_wk01", $sql);
    require_once("bonus003.php");
  }

?> 
  </body>
</html>