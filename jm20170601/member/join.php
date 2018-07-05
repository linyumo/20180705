<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE["passed"];
  $fatherid002 = $_COOKIE["aid"];
  $fathername002  = $_COOKIE["aname"];
?>
<!doctype html>
<html>
  <head>
    <title>加入會員</title>
    <meta charset="utf-8">
    <script type="text/javascript">
      function check_data()
      {
        if (document.myForm.account.value.length == 0)
        {
          alert("「使用者帳號」一定要填寫哦...");
          return false;
        }
        if (document.myForm.account.value.length > 10)
        {
          alert("「使用者帳號」不可以超過 10 個字元哦...");
          return false;
        }
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
    <p align="center"><font size="6">駿茂生物科技有限公司
    <br>入會申請暨契約書</font></p>
    <form action="addmember.php" method="post" name="myForm">
      <table width="87%" border="1" align="center" style="border-style:solid; border-collapse:collapse; border-spacing:0px;">
        <tr> 
          <td colspan="2" bgcolor="#6666FF" align="center"> 
            <font color="#FFFFFF"><b>請填入下列資料 (標示「*」欄位請務必填寫)</b></font>
          </td>
        </tr>
          <tr bgcolor="#99FF99"> 
          <td width="40%" align="right">使用者帳號 / 密碼：</td>
          <td><input name="account" type="hidden" size="50" value="sysauto">
          <font color="#990099"><b>帳號同身分證字號 / 預設密碼為 123456</b></font>
          <input name="password" type="hidden" size="50" value="123456">
          <input name="re_password" type="hidden" size="50" value="123456">
          </td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">*姓名(公司名稱既負責人姓名)：</td>
          <td><input name="name" type="text" size="50"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">*身分證字號：</td>
          <td><input name="taiwid001" type="text" size="50"></td>
        </tr>
          <tr bgcolor="#99FF99"> 
          <td align="right">生日：</td>
          <td>民國&nbsp;
            <input name="year" type="TEXT" size="4">&nbsp;年&nbsp;&nbsp;
            <input name="month" type="TEXT" size="4">&nbsp;月&nbsp;&nbsp;
            <input name="day" type="TEXT" size="4">&nbsp;日
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">地址：</td>
          <td><input name="address" type="text" size="50"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">連絡電話(住家)：</td>
          <td><input name="telephone" type="text" size="50"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">連絡電話(行動)：</td>
          <td><input name="cellphone" type="text" size="50"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">連絡電話(傳真)：</td>
          <td><input name="fax" type="text" size="50"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">EMAIL：</td>
          <td><input name="email" type="text" size="50"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">獎金匯入(行庫名稱)：</td>
          <td><input name="bname001" type="text" size="50"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">獎金匯入(分行名稱)：</td>
          <td><input name="bbranch001" type="text" size="50"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">獎金匯入(戶　　名)：</td>
          <td><input name="bowner001" type="text" size="50"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">獎金匯入(帳　　號)：</td>
          <td><input name="baccount001" type="text" size="50">
          <br><font size="1">(郵局:局號、帳號)(銀行:分別行、科目、編號、檢查碼)</font></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">*推薦人身份證字號：</td>
          <td><input name="fathertwid001" type="text" size="25">
        <!-- 取消自己推薦自己的功能
            <font color="#990099">
           <b>(&nbsp;或勾選<input type="checkbox" name="amifather1" value="yes">新人推薦自己&nbsp;)
           </b>
           </font>
         -->
        </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">收件中心：</td>
          <td>
          <input type="hidden" name="fatherid002" value="1">
          &nbsp;<input type="radio" name="fatherid0022" value="B01" checked><b>B01總公司</b>
          &nbsp;<input type="radio" name="fatherid0022" value="B02">B02台中東區
         <br>
          &nbsp;<input type="radio" name="fatherid0022" value="B03">B03台中大肚
          &nbsp;<input type="radio" name="fatherid0022" value="B04">B04台中太平
         <br>
          &nbsp;<input type="radio" name="fatherid0022" value="O01">其他
         <input name="fathername002" type="text" size="25">
         </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">入會類別：</td>
          <td>
          &nbsp;<input type="radio" name="qualification" value="新單" checked><b>新單</b>
          &nbsp;<input type="radio" name="qualification" value="銷售獎勵">銷售獎勵
         <br>
         &nbsp;&nbsp;此單為編號：<input name="qualificationno" type="text" size="10">之
         <br>
         &nbsp;<input type="radio" name="qualification2" value="一階分紅1"><b>一階</b>分紅重銷一單
         &nbsp;<input type="radio" name="qualification2" value="加購">加購
         &nbsp;<input type="radio" name="qualification2" value="季重銷">季重銷
         &nbsp;<input type="radio" name="qualification2" value="活動贈送">活動贈送
        <br>
         &nbsp;<input type="radio" name="qualification2" value="二階分紅1"><b>二階</b>分紅重銷一單
         &nbsp;<input type="radio" name="qualification2" value="二階分紅2"><b>二階</b>分紅重銷二單
         <br>
         &nbsp;<input type="radio" name="qualification2" value="三階分紅1"><b>三階</b>分紅重銷一單
         &nbsp;<input type="radio" name="qualification2" value="三階分紅2"><b>三階</b>分紅重銷二單
         &nbsp;<input type="radio" name="qualification2" value="三階分紅3"><b>三階</b>分紅重銷三單
         </td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">*註冊日期：</td>
          <td>
<?php 
$now001=date("Y-m-d");
$todaysec001=strtotime($now001);
echo "$now001"; 
?>
(系統日期)
<input name="date001" type="hidden" size="50" value="<?php echo "$now001"; ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">備註：</td>
          <td><textarea name="rema001" cols="53" rows="3" ></textarea>
<br><font size="1">說明：若是以同一帳號KEY單，請先完整KEY一次資料，按下加入會員之後，選以同一帳號KEY單，回到這個畫面時看到資料欄位都已經有資料了，請先在這裡點一下!再按下加入會員，謝謝!!</font></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="center" colspan="2"> 
            <input type="button" value="加入會員" onClick="check_data()">　
            <input type="reset" value="重新填寫">
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>