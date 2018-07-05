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
        if (document.myForm.password.value == "123456")
        {
          alert("「使用者密碼」一定要修改哦...");
          return false;
        }
        if (document.myForm.password.value.length == 0)
        {
          alert("「使用者密碼」一定要填寫哦...");
          return false;
        }
        if (document.myForm.password.value.length > 25)
        {
          alert("「使用者密碼」不可以超過 25 個字元哦...");
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
        if (document.myForm.year.value.length == 0)
        {
          alert("您忘了填「出生年」欄位了...");
          return false;
        }
        if (document.myForm.month.value.length == 0)
        {
          alert("您忘了填「出生月」欄位了...");
          return false;
        }	
        if (document.myForm.month.value > 12 | document.myForm.month.value < 1)
        {
          alert("「出生月」應該介於 1-12 之間哦！");
          return false;
        }
        if (document.myForm.day.value.length == 0)
        {
          alert("您忘了填「出生日」欄位了...");
          return false;
        }
        if (document.myForm.month.value == 2 & document.myForm.day.value > 29)
        {
          alert("二月只有 28 天，最多 29 天");
          return false;
        }	
        if (document.myForm.month.value == 4 | document.myForm.month.value == 6
          | document.myForm.month.value == 9 | document.myForm.month.value == 11)
        {
          if (document.myForm.day.value > 30)
          {
            alert("4 月、6 月、9 月、11 月只有 30 天哦！");
            return false;					
          }
        }	
        else
        {
          if (document.myForm.day.value > 31)
          {
            alert("1 月、3 月、5 月、7 月、8 月、10 月、12 月只有 31 天哦！");
            return false;					
          }				
        }
        if (document.myForm.day.value > 31 | document.myForm.day.value < 1)
        {
          alert("出生日應該在 1-31 之間");
          return false;
        }	
        myForm.submit();					
      }
    </script>			
  </head>
  <body>
    <p align="center"><img src="modify.jpg"></p>
    <form name="myForm" method="post" action="update.php" >
      <table width="70%" border="2" align="center" bordercolor="#6666FF">
        <tr> 
          <td colspan="2" bgcolor="#6666FF" align="center"> 
            <font color="#FFFFFF">請填入下列資料 (標示「*」欄位請務必填寫)</font>
          </td>
        </tr>
        <tr bgcolor="#99FF99" width="45%"> 
          <td align="right">*使用者帳號：</td>
          <td><?php echo $row{"account"} ?></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*使用者密碼：<br><font style=color:#c00;><b>密碼一定要修改哦!</b></font></td>
          <td> 
            <input type="password" name="password" size="25" value="<?php echo $row{"password"} ?>">
            <br>(請使用英文或數字鍵，勿使用特殊字元)
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*密碼確認：</td>
          <td>
            <input type="password" name="re_password" size="25" value="<?php echo $row{"password"} ?>">
            <input type="hidden" name="luckps001" value="OK">
            <input type="hidden" name="editid001" value="<?php echo "$editid001" ?>">
            <br>(再輸入一次密碼，並記下您的密碼)
          </td>
        </tr>

        <tr bgcolor="#99FF99">
          <td align="right">姓名：</td>
          <td><?php echo $row{"name"} ?>
<input type="hidden" name="name" value="<?php echo $row{"name"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">身分證字號：</td>
          <td><?php echo $row{"taiwid001"} ?></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">出生年：</td>
          <td>民國 <?php echo $row{"year"} ?> 年
<input type="hidden" name="year" value="<?php echo $row{"year"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">出生月：</td>
          <td><?php echo $row{"month"} ?> 月
<input type="hidden" name="month" value="<?php echo $row{"month"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">出生日：</td>
          <td><?php echo $row{"day"} ?> 日
<input type="hidden" name="day" value="<?php echo $row{"day"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">住址：</td>
          <td><textarea name="comment" rows="1" cols="50"><?php echo $row{"address"} ?></textarea></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">連絡電話(住家)：</td>
          <td><input name="telephone" type="text" size="25" value="<?php echo $row{"telephone"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">連絡電話(行動)：</td>
          <td><input name="cellphone" type="text" size="25" value="<?php echo $row{"cellphone"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">連絡電話(傳真)：</td>
          <td><input name="fax" type="text" size="25" value="<?php echo $row{"fax"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">EMAIL：</td>
          <td><input name="email" type="text" size="25" value="<?php echo $row{"email"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">獎金匯入(行庫名稱)：</td>
          <td><input name="bname001" type="text" size="50" value="<?php echo $row{"bname001"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">獎金匯入(分行名稱)：</td>
          <td><input name="bbranch001" type="text" size="50" value="<?php echo $row{"bbranch001"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">獎金匯入(戶　　名)：</td>
          <td><input name="bowner001" type="text" size="50" value="<?php echo $row{"baccount001"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">獎金匯入(帳　　號)：</td>
          <td><input name="baccount001" type="text" size="50" value="<?php echo $row{"bowner001"} ?>">
          <br><font size="1">(郵局:局號、帳號)(銀行:分別行、科目、編號、檢查碼)</font></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">推薦人：</td>
          <td><?php echo $row{"fathername001"} ?></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">(系統排入)會員編號：</td>
          <td><?php echo $row{"memberid002"} ?></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">註冊日：</td>
          <td><?php echo $row{"date001"} ?></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">繳費日：</td>
          <td><?php echo $row{"date002"} ?></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">備註：</td>
          <td><?php echo $row{"rema001"} ?></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td colspan="2" align="CENTER"> 
            <input type="button" value="修改資料" onClick="check_data()">
            <input type="reset" value="重新填寫">
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>
<?php
    //釋放資源及關閉資料連接
    mysqli_free_result($result);
    mysqli_close($link);
  }
?>