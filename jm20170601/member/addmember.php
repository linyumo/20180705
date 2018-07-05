<?php
  require_once("dbtools.inc.php");
  
  //取得表單資料
  $account = $_POST["taiwid001"];
  $password = $_POST["password"]; 
  $name = $_POST["name"]; 
  $taiwid001 = $_POST["taiwid001"]; 
  $year = $_POST["year"]; 
  $month = $_POST["month"]; 
  $day = $_POST["day"];
  $address = $_POST["address"];
  $telephone = $_POST["telephone"]; 
  $cellphone = $_POST["cellphone"]; 	
  $fax = $_POST["fax"]; 	
  $email = $_POST["email"]; 	
  $bname001 = $_POST["bname001"]; 	
  $bbranch001 = $_POST["bbranch001"]; 	
  $baccount001 = $_POST["baccount001"]; 	
  $bowner001 = $_POST["bowner001"]; 	
  $fathertwid001 = $_POST["fathertwid001"];
  $amifather1 = $_POST["amifather1"];
  $amifather2 = $_POST["amifather1"];
  $fatherid002 = $_POST["fatherid002"];
  $fatherid0022 = $_POST["fatherid0022"];
  $fathername002=$_POST["fathername002"];
    if ($fatherid0022 == 'B01') {
    $fathername002="B01總公司";
    }
    if ($fatherid0022 == 'B02') {
    $fathername002="B02台中東區";
    }
    if ( $fatherid0022 == 'B03' ) {
    $fathername002="B03台中大肚";
    }
    if ( $fatherid0022 == 'B04' ) {
    $fathername002="B04台中太平";
    }
    if ( $fatherid0022 == 'O01' ) {
    $fathername002="其他-".$fathername002;
    }
  $memberid002 = 0;
  $qualification = $_POST["qualification"];
  $qualificationno = $_POST["qualificationno"];
  $qualification2 = $_POST["qualification2"];
  $date001 = $_POST["date001"];
  $date002 = 0000-00-00;
  $luckps001 = "UNPAID";
  $rema001 = $_POST["rema001"];

  //建立資料連接
  $link = create_connection();
					
  //檢查推薦人身分證與姓名
  if ( $amifather1 == 'yes' ) {
  $fatherid001 = 0;
  $fathertwid001 = $taiwid001;
  $fathername001 = $name;
  }
else {
  $sql = "select * from jmmember001 where taiwid001 = '$fathertwid001' order by id desc";
  $result = execute_sql($link, "linyumo_wk01", $sql);

  //如果推薦人身分證字號錯誤
  if (mysqli_num_rows($result) == 0)
  {
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result);
	
    //顯示訊息要求管理員輸入正確的推薦人身分證字號
    echo "<p align='center'><font size='6' color='#00F'>查無推薦人身分證字號 <b>$fathertwid001</b><br>請返回上一步，查明後再輸入</font><p>";
    echo "<script type='text/javascript'>";
    echo "alert('推薦人身分證字號'$fathertwid001'錯誤，請查明後再輸入');";
    echo "history.back();";
    echo "</script>";
  }
	
  //如果推薦人身分證字號正確

    //取得推薦人 id 與 姓名 欄位
    while($row=mysqli_fetch_object($result))
{
    $fatherid001 = $row->id;
    $fathername001 = $row->name;
}}

    //釋放 $result 佔用的記憶體	
    mysqli_free_result($result);
		
 /***********
	
  //檢查帳號是否有人申請
  $sql = "SELECT * FROM jmmember001 Where account = '$account'";
  $result = execute_sql($link, "linyumo_wk01", $sql);

 //如果帳號已經有人使用
  if (mysqli_num_rows($result) != 0)
  {
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result);
		
    //顯示訊息要求使用者更換帳號名稱
    echo "<script type='text/javascript'>";
    echo "alert('您所指定的帳號已經有人使用，請使用其它帳號');";
    echo "history.back();";
    echo "</script>";
  }
	
  //如果帳號沒人使用
  else
  {

 //釋放 $result 佔用的記憶體	
    mysqli_free_result($result);

**********/
		
    //執行 SQL 命令，新增此帳號
    $sql = "INSERT INTO jmmember001 (account, password, name, taiwid001, year, month, day, address, telephone, 
                  cellphone, fax, email, bname001, bbranch001, baccount001, bowner001, fatherid001, fathertwid001, fathername001, 
                  fatherid002, fathername002, memberid002, qualification, qualificationno, qualification2, date001, date002, luckps001, rema001) 
                   VALUES ('$account', '$password', '$name', '$taiwid001', '$year', '$month', '$day', '$address', '$telephone',
                  '$cellphone', '$fax', '$email', '$bname001', '$bbranch001', '$baccount001', '$bowner001', '$fatherid001', 
                  '$fathertwid001', '$fathername001', '$fatherid002', '$fathername002', '$memberid002', 
                  '$qualification', '$qualificationno', '$qualification2', '$date001', '$date002', '$luckps001', '$rema001')";

    $result = execute_sql($link, "linyumo_wk01", $sql);
 /*  } */

    //釋放 $result 佔用的記憶體	
    mysqli_free_result($result);

//產出虛擬id
$sql="select * from jmmember001 order by id desc";
$result = execute_sql($link, "linyumo_wk01", $sql);
$memberid001=mysqli_num_rows($result);
$num=mysqli_num_fields($result);
$row=mysqli_fetch_row($result);

$id001=$row[0];

    //釋放 $result 佔用的記憶體	
    mysqli_free_result($result);

if ( $amifather2 == 'yes' ) {
$sql="update jmmember001 set memberid001='$memberid001', fatherid001='$memberid001' where id='$id001'";
$result=execute_sql($link,"linyumo_wk01",$sql);
}
else {
$sql="update jmmember001 set memberid001='$memberid001' where id='$id001'";
$result=execute_sql($link,"linyumo_wk01",$sql);
}
    //釋放 $result 佔用的記憶體	
    mysqli_free_result($result);

  //關閉資料連接	
  mysqli_close($link);

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>新增帳號成功</title>
  </head>
  <body bgcolor="#FFFFFF">
    <p align="center"><img src="success.jpg">       
    <p align="center">新會員註冊成功了，您的資料如下：（請勿按重新整理鈕）<br>
      球號：<font color="#FF0000"><?php echo $memberid001 ?></font><br>
      帳號：<font color="#FF0000"><?php echo $account ?></font><br>
      密碼：<font color="#FF0000"><?php echo $password ?></font><br>       
      請記下您的帳號及密碼，然後<a href="index.html">登入網站</a>。
<br><br>或 &nbsp <a href="main.php"><font color="#00F">回到主頁</font></a>
 &nbsp 或 &nbsp <a href="join.php"><font color="#00F">KEY下一單</font></a>
 &nbsp 或 &nbsp <a href="javascript:history.back()"><font color="#00F">以同身份KEY下一單</font></a>

<br><br><br><font color="#FF0000"><?php echo $fatherid002 ?></font><br>
<font color="#FF0000"><?php echo $fathername002 ?></font><br>
<font color="#FF0000"><?php echo $amifather1 ?></font><br>
    </p>
  </body>
</html>
<?php ?>