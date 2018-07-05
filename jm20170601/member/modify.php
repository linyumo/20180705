<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE 
  $passed = $_COOKIE{"passed"};
	
  //如果 cookie 中的 passed 變數不等於 TRUE
  //表示尚未登入網站，將使用者導向首頁 index.html
  if ($passed != "TRUE")
  {
    header("location:index.html");
    exit();
  }
	
  //如果 cookie 中的 passed 變數等於 TRUE
  //表示已經登入網站，取得使用者資料	
  else
  {
    require_once("dbtools.inc.php");
		
    $id = $_COOKIE{"id"};
    $editid001 = stripslashes($_GET[editid001]);
		
    //建立資料連接
    $link = create_connection();
				
    //執行 SELECT 陳述式取得使用者資料
    $sql = "SELECT * FROM jmmember001 Where id = $editid001";
    $result = execute_sql($link, "linyumo_wk01", $sql);
    $row = mysqli_fetch_assoc($result);  
?>
<!doctype html>
<html>
  <head>
    <title>修改會員資料</title>
    <meta charset="utf-8">
    <script type="text/javascript">
      function check_data()
      {
        if (document.myForm.password.value.length == 0)
        {
          alert("「使用者密碼」一定要填寫哦...");
          return false;
        }
        if (document.myForm.password.value.length > 10)
        {
          alert("「使用者密碼」不可以超過 10 個字元哦...");
          return false;
        }
        if (document.myForm.re_password.value.length == 0)
        {
          alert("「密碼確認」欄位忘了填哦...");
          return false;
        }
        if (document.myForm.password.value != document.myForm.re_password.value)
        {
          alert("「密碼確認」欄位與「使用者密碼」欄位一定要相同...");
          return false;
        }
        if (document.myForm.name.value.length == 0)
        {
          alert("您一定要留下真實姓名哦！");
          return false;
        }	
       myForm.submit();					
      }
    </script>			
  </head>
  <body>
    <p align="center"><img src="modify.jpg"></p>
    <form name="myForm" method="post" action="update.php" >
    <input type="hidden" name="editid001" value="<?php echo "$editid001" ?>">
    <table width="70%" border="2" align="center" bordercolor="#6666FF">
        <tr> 
          <td colspan="2" bgcolor="#6666FF" align="center"> 
            <font color="#FFFFFF">請填入下列資料 (標示「*」欄位請務必填寫)</font>
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*使用者帳號：</td>
          <td><input name="account" type="text" size="25" value="<?php echo $row{"account"} ?>">
          (同會員身分證字號)
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*使用者密碼：</td>
          <td> 
            <input name="password" type="text" size="25" value="<?php echo $row{"password"} ?>">
            (請使用英文或數字鍵，勿使用特殊字元)
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*密碼確認：</td>
          <td>
            <input name="re_password" type="text" size="25" value="<?php echo $row{"password"} ?>">
            (再輸入一次密碼，並記下您的使用者名稱與密碼)
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*姓名：</td>
          <td><input name="name" type="text" size="25" value="<?php echo $row{"name"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">*身分證字號：</td>
          <td><input name="taiwid001" type="text" size="25" value="<?php echo $row{"taiwid001"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">生日：</td>
          <td>民國 
            <input name="year" type="text" size="2" value="<?php echo $row{"year"} ?>">年 
            <input name="month" type="text" size="2" value="<?php echo $row{"month"} ?>">月 
            <input name="day" type="text" size="2" value="<?php echo $row{"day"} ?>">日
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">地址：</td>
          <td><input name="address" type="text" size="45" value="<?php echo $row{"address"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">連絡電話(住家)：</td>
          <td> 
            <input name="telephone" type="text" size="30" value="<?php echo $row{"telephone"} ?>">
            (依照 (02) 2311-3836 格式 or (04) 657-4587)
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">連絡電話(行動)：</td>
          <td> 
            <input name="cellphone" type="text" size="30" value="<?php echo $row{"cellphone"} ?>">
            (依照 (0922) 302-228 格式)
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">連絡電話(傳真)：</td>
          <td><input name="fax" type="text" size="30" value="<?php echo $row{"fax"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">E-mail 帳號：</td>
          <td><input name="email" type="text" size="50" value="<?php echo $row{"email"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">獎金匯入(行庫名稱)：</td>
          <td><input name="bname001" type="text" size="30" value="<?php echo $row{"bname001"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">獎金匯入(分行名稱)：</td>
          <td><input name="bbranch001" type="text" size="30" value="<?php echo $row{"bbranch001"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">獎金匯入(戶　　名)：</td>
          <td><input name="bowner001" type="text" size="30" value="<?php echo $row{"baccount001"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">獎金匯入(帳　　號)：</td>
          <td><input name="baccount001" type="text" size="30" value="<?php echo $row{"bowner001"} ?>">
          <br><font size="1">(郵局:局號、帳號)(銀行:分別行、科目、編號、檢查碼)</font></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">推薦人會員編號：</td>
          <td><input name="fatherid001" type="text" size="25" value="<?php echo $row{"fatherid001"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">*推薦人身份證：</td>
          <td><input name="fathertwid001" type="text" size="25" value="<?php echo $row{"fathertwid001"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">*推薦人姓　名：</td>
          <td><input name="fathername001" type="text" size="25" value="<?php echo $row{"fathername001"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">KEY單人員編號：</td>
          <td><input name="fatherid002" type="text" size="25" value="<?php echo $row{"fatherid002"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">KEY單中心：</td>
          <td><input name="fathername002" type="text" size="25" value="<?php echo $row{"fathername002"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">確認人員編號：</td>
          <td><input name="fatherid003" type="text" size="25" value="<?php echo $row{"fatherid003"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">確認中心：</td>
          <td><input name="fathername003" type="text" size="25" value="<?php echo $row{"fathername003"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">KEY單球號：</td>
          <td><input name="memberid001" type="text" size="25" value="<?php echo $row{"memberid001"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">真實球號：</td>
          <td><input name="memberid002" type="text" size="25" value="<?php echo $row{"memberid002"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">入單類別：</td>
          <td>
          <input name="qualification" type="text"  size="10" value="<?php echo $row{"qualification"} ?>">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          此為編號：<input  type="text"name="qualificationno" size="10" value="<?php echo $row{"qualificationno"} ?>"> 之
          &nbsp;&nbsp;&nbsp;&nbsp;
          <input  type="text"name="qualification2" size="10" value="<?php echo $row{"qualification2"} ?>">
         <br><font size="1">新單、銷售獎勵
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         ( 註：重銷、滿局獎勵、加購、活動贈送、轉讓 ...... )</font></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">+註冊日期：</td>
          <td><input name="date001" type="text" size="25" value="<?php echo $row{"date001"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">確認繳費日期：</td>
          <td><input name="date002" type="text" size="25" value="<?php echo $row{"date002"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">狀態：</td>
          <td><input name="luckps001"  type="text" size="25" value="<?php echo $row{"luckps001"} ?>">
            ( UNLK = 正常 )
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">備註：</td>
          <td><textarea name="rema001" rows="4" cols="45"><?php echo $row{"rema001"} ?></textarea></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td colspan="2" align="CENTER"> 
            <input type="button" value="修改資料" onClick="check_data()">
            <input type="reset" value="重新填寫">
          </td>
        </tr>
      </table>
    </form>
      <p style=text-align:center;font-size:24px;color:#c3c;>取消修改 - 請直接 <a href="javascript:window.close();">關閉視窗</a> ! 謝謝!</p>
  </body>
</html>
<?php
    //釋放資源及關閉資料連接
    mysqli_free_result($result);
    mysqli_close($link);
  }
?>