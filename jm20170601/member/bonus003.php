<?php

      //顯示欄位名稱
      echo "<table border='1' align='center' style='border-style:solid; border-collapse:collapse; border-spacing:0px;'>";
      echo "<tr style='font-size:18px;'>";	
      echo "<td colspan=11><b>直推獎金計算&nbsp;&nbsp;&nbsp; 日期:$ayear001 - $amonth001 - 05</b></td>";
      echo "</tr>";
      echo "<tr align='center' style='font-size:14px;'>";			
      echo "<td bgcolor=#cff><b>項次</td>";
      echo "<td bgcolor=#cff><b>日期</td>";
      echo "<td bgcolor=#cff><b>新加入(球號)</td>";
      echo "<td bgcolor=#cff><b>推薦人(球號)</td>";
      echo "<td bgcolor=#cff><b>請款人<br>身分證</td>";
      echo "<td bgcolor=#cff><b>連絡電話</td>";
      echo "<td bgcolor=#cff><b>匯款行庫(分行)戶名<br>帳號</td>";
      echo "<td bgcolor=#cff><b>收件中心</td>";
      echo "<td bgcolor=#cff><b>狀態</td>";
      echo "<td bgcolor=#cff><b>獎金類別</td>";
      echo "<td bgcolor=#cff><b>金額</b></td>";
      echo "</tr>";

  //取A獎金請款人
  $j = 1;
  while ($row = mysqli_fetch_row($result)){
  $sql1= "SELECT * FROM jmmember001 where id = '$row[17]'";
  $result1 = execute_sql1($link, "linyumo_wk01", $sql1);

  if (mysqli_num_rows($result1) == 0){
    //釋放 $result1 佔用的記憶體
    mysqli_free_result($result1);
    }
  else {
      //顯示記錄
      while ($row1 = mysqli_fetch_row($result1)){
        echo "<tr align='center' style='font-size:14px;'>";		
        echo "<td bgcolor=#ffc>$j</td>";	
        echo "<td>$row[28]</td>";
        echo "<td>$row[3]($row[25])</td>";
        echo "<td>$row[19]($row[17])</td>";
        echo "<td>$row1[3]<br>$row1[4]</td>";
        echo "<td>$row1[8]<br>$row1[9]</td>";
        echo "<td>$row1[13]&nbsp;($row1[14])&nbsp;$row1[16]<br>$row1[15]</td>";
        echo "<td>$row1[21]</td>";
        echo "<td>$row1[30]<br>(UNLK=正常)</td>";
        echo "<td>直推獎金</td>";
        echo "<td>$bonusa</td>";
        echo "</tr>";	
        $j++;
  }
    //釋放 $result1 佔用的記憶體
    mysqli_free_result($result1);
  }
  }
      echo "</table>" ;
			
      //釋放記憶體空間
      mysqli_free_result($result);
      mysqli_close($link);
?>