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
    $paid001 = stripslashes($_GET[paid]);
    $fatherid003 = $_COOKIE{"aid"};
    $fathername003  = $_COOKIE{"aname"};
		
    //建立資料連接
    $link = create_connection();
				
    //執行 SELECT 陳述式取得使用者資料
    $sql = "SELECT * FROM jmmember001 Where id = $paid001";
    $result = execute_sql($link, "linyumo_wk01", $sql);
    $row = mysqli_fetch_assoc($result);  
?>
<!doctype html>
<html>
  <head>
    <title>確認會員繳費</title>
    <meta charset="utf-8">
    <script type="text/javascript">
      function check_data()
      {
       myForm.submit();					
      }
    </script>			
  </head>
  <body>
    <p align="center"><img src="modify.jpg"></p>
    <form name="myForm" method="post" action="updatepaid2.php" >
    <input type="hidden" name="paid001" value="<?php echo "$paid001" ?>">
    <table width="70%" border="2" align="center" bordercolor="#6666FF">
        <tr> 
          <td colspan="2" bgcolor="#6666FF" align="center"> 
            <font color="#FFFFFF">繳費確認</font>
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*姓名：</td>
          <td><b><?php echo $row{"name"} ?></b></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">*身分證字號：</td>
          <td><b><?php echo $row{"taiwid001"} ?></b></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">KEY(人員)中心：</td>
          <td><b>(<?php echo $row{"fatherid002"} ?>)<?php echo $row{"fathername002"} ?></b></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">確認人員編號：</td>
          <td><input name="fatherid003" type="text" size="25" value="<?php echo $fatherid003 ?>"></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">(請選擇)確認中心：</td>
          <td>
          &nbsp;<input type="radio" name="fathername003" value="<?php echo $row{"fathername002"} ?>" checked>
         &nbsp;<b>同KEY單中心</b>(<?php echo $row{"fathername002"} ?>)
          <br>&nbsp;<input type="radio" name="fathername003" value="B01總公司">B01總公司
          &nbsp;<input type="radio" name="fathername003" value="B02台中東區">B02台中東區
          &nbsp;<input type="radio" name="fathername003" value="B03台中大肚">B03台中大肚
          <br>&nbsp;<input type="radio" name="fathername003" value="B04台中太平">B04台中太平
          &nbsp;<input type="radio" name="fathername003" value="O01其他">O01其他
</td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">KEY單球號：</td>
          <td><b><?php echo $row{"memberid001"} ?></b></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">真實球號：</td>
          <td><input name="memberid002" type="text" size="25" value="<?php echo $row{"memberid001"} ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">入單類別：</td>
          <td>
          <b>[<?php echo $row{"qualification"} ?>]
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          此為編號：[<?php echo $row{"qualificationno"} ?>] 之
          &nbsp;&nbsp;&nbsp;&nbsp;
          [<?php echo $row{"qualification2"} ?>]</b>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">+註冊日期：</td>
          <td><b><?php echo $row{"date001"} ?></b></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">確認繳費日期：</td>
          <td><input name="date002" type="text" size="25" value="<?php echo date("Y-m-d") ?>"></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">狀態：</td>
          <td><input name="luckps001"  type="text" size="25" value="UNLK">
            ( UNLK = 正常 )
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">備註：</td>
          <td><textarea name="rema001" rows="4" cols="45"><?php echo $row{"rema001"} ?></textarea></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td colspan="2" align="CENTER"> 
            <input type="button" value="繳費確認" onClick="check_data()">
            <input type="reset" value="重新填寫">
          </td>
        </tr>
      </table>
    </form>
      <p style=text-align:center;font-size:24px;color:#c3c;>取消確認 - 請直接 <a href="javascript:window.close();">關閉視窗</a> ! 謝謝!</p>
  </body>
</html>
<?php
    //釋放資源及關閉資料連接
    mysqli_free_result($result);
    mysqli_close($link);
  }
?>