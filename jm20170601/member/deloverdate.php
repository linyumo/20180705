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
    $delid001 = stripslashes($_GET[delid]);
		
    //建立資料連接
    $link = create_connection();
				
    //執行 SELECT 陳述式取得使用者資料
    $sql = "SELECT * FROM jmmember001 Where id = $delid001";
    $result = execute_sql($link, "linyumo_wk01", $sql);
    $row = mysqli_fetch_assoc($result);  
?>
<!doctype html>
<html>
  <head>
    <title>刪除會員資料</title>
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
    <form name="myForm" method="post" action="deloverdate2.php" >
    <input type="hidden" name="delid001" value="<?php echo "$delid001" ?>">
    <table width="70%" border="2" align="center" bordercolor="#6666FF">
        <tr> 
          <td colspan="2" bgcolor="#6666FF" align="center"> 
            <font color="#FFFFFF">請確認要刪除此筆資料(系統將另外保留刪除記錄備查)</font>
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*使用者帳號：</td>
          <td><?php echo $row{"account"} ?>
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">*使用者密碼：</td>
          <td><?php echo $row{"password"} ?>">
          </td>
        </tr>
          <tr bgcolor="#99FF99"> 
          <td align="right">*姓名：</td>
          <td><?php echo $row{"name"} ?></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">*身分證字號：</td>
          <td><?php echo $row{"taiwid001"} ?></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">推薦人會員(編號)身份證-姓名：</td>
          <td>(<?php echo $row{"fatherid001"} ?>)
          <?php echo $row{"fathertwid001"} ?>-
          <?php echo $row{"fathername001"} ?></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">KEY單人員(編號)中心：</td>
          <td>(<?php echo $row{"fatherid002"} ?>)<?php echo $row{"fathername002"} ?></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">KEY單球號：</td>
          <td><?php echo $row{"memberid001"} ?></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">入單類別：</td>
          <td><?php echo $row{"qualification"} ?>
          &nbsp;&nbsp;&nbsp;&nbsp;
          此為編號：<?php echo $row{"qualificationno"} ?> 之
          &nbsp;&nbsp;&nbsp;&nbsp;
          <?php echo $row{"qualification2"} ?></td>
        </tr>
        <tr bgcolor="#99FF99">
          <td align="right">+註冊日期：</td>
          <td><?php echo $row{"date001"} ?></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td align="right">備註：</td>
          <td><textarea name="rema001" rows="4" cols="45"><?php echo $row{"rema001"} ?></textarea></td>
        </tr>
        <tr bgcolor="#99FF99"> 
          <td colspan="2" align="CENTER"> 
            <input type="button" value="確認刪除" onClick="check_data()">
          </td>
        </tr>
      </table>
    </form>
      <p style=text-align:center;font-size:24px;color:#c3c;>取消刪除 - 請直接 <a href="javascript:window.close();">關閉視窗</a> ! 謝謝!</p>
  </body>
</html>
<?php
    //釋放資源及關閉資料連接
    mysqli_free_result($result);
    mysqli_close($link);
  }
?>