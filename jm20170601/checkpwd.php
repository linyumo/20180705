﻿<?php
  require_once("dbtools.inc.php");
  header("Content-type: text/html; charset=utf-8");
	
  //取得表單資料
  $account = $_POST["account"]; 	
  $password = $_POST["password"];

  //建立資料連接
  $link = create_connection();
					
  //檢查帳號密碼是否正確
  $sql = "SELECT * FROM jmmember001 Where account = '$account' AND password = '$password'";
  $result = execute_sql($link, "linyumo_wk01", $sql);

  //如果帳號密碼錯誤
  if (mysqli_num_rows($result) == 0)
  {
    //釋放 $result 佔用的記憶體
    mysqli_free_result($result);
	
    //關閉資料連接	
    mysqli_close($link);
		
    //顯示訊息要求使用者輸入正確的帳號密碼
    echo "<script type='text/javascript'>";
    echo "alert('帳號密碼錯誤，請查明後再登入');";
    echo "history.back();";
    echo "</script>";
  }
	
  //如果帳號密碼正確
  else
  {
    //取得 id 欄位
    $row = mysqli_fetch_row($result); 
    $id =$row[0];
    $whosfathertwid =$row[4];
	
    //釋放 $result 佔用的記憶體	
    mysqli_free_result($result);
		
    //關閉資料連接	
    mysqli_close($link);

    //將使用者資料加入 cookies
    setcookie("id", $id);
    setcookie("account", $account);
    setcookie("whosfathertwid", $whosfathertwid);
    setcookie("passed", "TRUE");		
    header("location:main.php");		
  }
?>