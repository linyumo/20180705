<?php

      //顯示欄位名稱
      echo "<table border='1' align='center' style='border-style:solid; border-collapse:collapse; border-spacing:0px;'>";
      echo "<tr style='font-size:18px;'>";	
      echo "<td colspan=12><b>三階滿局&原始直推獎金計算&nbsp;&nbsp;&nbsp; 日期:$ayear001 - $amonth001 - 05</b></td>";
      echo "</tr>";
      echo "<tr align='center' style='font-size:14px;'>";			
      echo "<td bgcolor=#cff><b>項次</td>";
      echo "<td bgcolor=#cff><b>日期</td>";
      echo "<td bgcolor=#cff><b>新加入(球號)</td>";
      echo "<td bgcolor=#cff><b>入會資格/類別</td>";
      echo "<td bgcolor=#cff><b>推薦人(球號)</td>";
      echo "<td bgcolor=#cff><b>請款人(球號)<br>身分證</td>";
      echo "<td bgcolor=#cff><b>連絡電話</td>";
      echo "<td bgcolor=#cff><b>匯款行庫(分行)戶名<br>帳號</td>";
      echo "<td bgcolor=#cff><b>收件中心</td>";
      echo "<td bgcolor=#cff><b>狀態</td>";
      echo "<td bgcolor=#cff><b>獎金類別</td>";
      echo "<td bgcolor=#cff><b>金額</b></td>";
      echo "</tr>";

  //取71獎金請款人
  $j = 1;
  while ($row = mysqli_fetch_row($result)){
  if ($row[25] > 7 & (($row[25]-1)%7) == 0) {
  $sql1= "SELECT * FROM jmmember001 where memberid002 = (($row[25]-1)/7)";
  $result1 = execute_sql1($link, "linyumo_wk01", $sql1);

  if (mysqli_num_rows($result1) == 0){
    //釋放 $result1 佔用的記憶體
    mysqli_free_result($result1);
    }
  else {
  //顯示記錄一階分紅獎金(71)
        $row1 = mysqli_fetch_row($result1);
        echo "<tr align='center' style='font-size:14px;'>";		
        echo "<td bgcolor=#ffc>$j</td>";	
        echo "<td>$row[28]</td>";
        echo "<td>$row[3]($row[25])</td>";
        echo "<td>$row[27]/$row[33]";
        echo "<td>$row[19]($row[17])</td>";
        echo "<td>$row1[3]($row1[25])<br>$row1[4]</td>";
        echo "<td>$row1[8]<br>$row1[9]</td>";
        echo "<td>$row1[13]&nbsp;($row1[14])&nbsp;$row1[16]<br>$row1[15]</td>";
        echo "<td>$row1[21]</td>";
        echo "<td>$row1[30]<br>(UNLK=正常)</td>";
        echo "<td>一階分紅獎金</td>";
        echo "<td>$bonus71</td>";
        echo "</tr>";
        $j++;
  }
    //釋放 $result1 佔用的記憶體
    //mysqli_free_result($result1);
  }
  //一階判斷end

  //取72獎金請款人
  if ($row[25] > 27 & (($row[25]-1)%27) == 0) {
  $sql1= "SELECT * FROM jmmember001 where memberid002 = (($row[25]-1)/27)";
  $result1 = execute_sql1($link, "linyumo_wk01", $sql1);

  if (mysqli_num_rows($result1) == 0){
    //釋放 $result1 佔用的記憶體
    mysqli_free_result($result1);
    }
  else {
  //顯示記錄二階分紅獎金(72)
        $row1 = mysqli_fetch_row($result1);
        echo "<tr align='center' style='font-size:14px;'>";		
        echo "<td bgcolor=#ffc>$j</td>";	
        echo "<td>$row[28]</td>";
        echo "<td>$row[3]($row[25])</td>";
        echo "<td>$row[27]/$row[33]";
        echo "<td>$row[19]($row[17])</td>";
        echo "<td>$row1[3]($row1[25])<br>$row1[4]</td>";
        echo "<td>$row1[8]<br>$row1[9]</td>";
        echo "<td>$row1[13]&nbsp;($row1[14])&nbsp;$row1[16]<br>$row1[15]</td>";
        echo "<td>$row1[21]</td>";
        echo "<td>$row1[30]<br>(UNLK=正常)</td>";
        echo "<td>二階分紅獎金</td>";
        echo "<td>$bonus72</td>";
        echo "</tr>";
        $j++;

  //取72獎金請款人
  $fid001=$row1[17];
  $sql1= "SELECT * FROM jmmember001 where id = '$fid001'";
  $result1 = execute_sql1($link, "linyumo_wk01", $sql1);

  if (mysqli_num_rows($result1) == 0){
    //釋放 $result1 佔用的記憶體
    mysqli_free_result($result1);
    }
  else {
  //顯示記錄二階重銷原始直推獎金(72)
        $row1 = mysqli_fetch_row($result1);
        echo "<tr align='center' style='font-size:14px;'>";		
        echo "<td bgcolor=#ffc>$j</td>";	
        echo "<td>$row[28]</td>";
        echo "<td>$row[3]($row[25])</td>";
       echo "<td>$row[27]/$row[33]";
        echo "<td>$row[19]($row[17])</td>";
        echo "<td>$row1[3]($row1[25])<br>$row1[4]</td>";
        echo "<td>$row1[8]<br>$row1[9]</td>";
        echo "<td>$row1[13]&nbsp;($row1[14])&nbsp;$row1[16]<br>$row1[15]</td>";
        echo "<td>$row1[21]</td>";
        echo "<td>$row1[30]<br>(UNLK=正常)</td>";
        echo "<td><font color='#c6c' size='1'>二階分紅重銷<br>原始直推獎金</font></td>";
        echo "<td>$bonusf72</td>";
        echo "</tr>";
        $j++;
  }
  }
    //釋放 $result1 佔用的記憶體
    mysqli_free_result($result1);
  }
  //二階判斷end

  //取77獎金請款人
  if ($row[25] > 77 & (($row[25]-1)%77) == 0) {
  $sql1= "SELECT * FROM jmmember001 where memberid002 = (($row[25]-1)/77)";
  $result1 = execute_sql1($link, "linyumo_wk01", $sql1);

  if (mysqli_num_rows($result1) == 0){
    //釋放 $result1 佔用的記憶體
    mysqli_free_result($result1);
    }
  else {
  //顯示記錄三階分紅獎金(77)
        $row1 = mysqli_fetch_row($result1);
        echo "<tr align='center' style='font-size:14px;'>";		
        echo "<td bgcolor=#ffc>$j</td>";	
        echo "<td>$row[28]</td>";
        echo "<td>$row[3]($row[25])</td>";
       echo "<td>$row[27]/$row[33]";
        echo "<td>$row[19]($row[17])</td>";
        echo "<td>$row1[3]($row1[25])<br>$row1[4]</td>";
        echo "<td>$row1[8]<br>$row1[9]</td>";
        echo "<td>$row1[13]&nbsp;($row1[14])&nbsp;$row1[16]<br>$row1[15]</td>";
        echo "<td>$row1[21]</td>";
        echo "<td>$row1[30]<br>(UNLK=正常)</td>";
        echo "<td>三階分紅獎金</td>";
        echo "<td>$bonus77</td>";
        echo "</tr>";
        $j++;

  //取77獎金請款人
  $fid001=$row1[17];
  $sql1= "SELECT * FROM jmmember001 where id = '$fid001'";
  $result1 = execute_sql1($link, "linyumo_wk01", $sql1);

  if (mysqli_num_rows($result1) == 0){
    //釋放 $result1 佔用的記憶體
    mysqli_free_result($result1);
    }
  else {
  //顯示記錄三階重銷原始直推獎金(77)
        $row1 = mysqli_fetch_row($result1);
        echo "<tr align='center' style='font-size:14px;'>";		
        echo "<td bgcolor=#ffc>$j</td>";	
        echo "<td>$row[28]</td>";
        echo "<td>$row[3]($row[25])</td>";
       echo "<td>$row[27]/$row[33]";
        echo "<td>$row[19]($row[17])</td>";
        echo "<td>$row1[3]($row1[25])<br>$row1[4]</td>";
        echo "<td>$row1[8]<br>$row1[9]</td>";
        echo "<td>$row1[13]&nbsp;($row1[14])&nbsp;$row1[16]<br>$row1[15]</td>";
        echo "<td>$row1[21]</td>";
        echo "<td>$row1[30]<br>(UNLK=正常)</td>";
        echo "<td><font color='#c6c' size='1'>三階分紅重銷<br>原始直推獎金</font></td>";
        echo "<td>$bonusf77</td>";
        echo "</tr>";
        $j++;
  }
  }
    //釋放 $result1 佔用的記憶體
    mysqli_free_result($result1);
  }
  //三階判斷end

  //取7f獎金請款人
  if ($row[25] > 157 & (($row[25]-1)%157) == 0) {
  $sql1= "SELECT * FROM jmmember001 where memberid002 = (($row[25]-1)/157)";
  $result1 = execute_sql1($link, "linyumo_wk01", $sql1);

  if (mysqli_num_rows($result1) == 0){
    //釋放 $result1 佔用的記憶體
    mysqli_free_result($result1);
    }
  else {
  //顯示記錄四階分紅獎金(7f)
        $row1 = mysqli_fetch_row($result1);
        echo "<tr align='center' style='font-size:14px;'>";		
        echo "<td bgcolor=#ffc>$j</td>";	
        echo "<td>$row[28]</td>";
        echo "<td>$row[3]($row[25])</td>";
       echo "<td>$row[27]/$row[33]";
        echo "<td>$row[19]($row[17])</td>";
        echo "<td>$row1[3]($row1[25])<br>$row1[4]</td>";
        echo "<td>$row1[8]<br>$row1[9]</td>";
        echo "<td>$row1[13]&nbsp;($row1[14])&nbsp;$row1[16]<br>$row1[15]</td>";
        echo "<td>$row1[21]</td>";
        echo "<td>$row1[30]<br>(UNLK=正常)</td>";
        echo "<td>四階分紅獎金</td>";
        echo "<td>$bonus7f</td>";
        echo "</tr>";
        $j++;

  //取7f獎金請款人
  $fid001=$row1[17];
  $sql1= "SELECT * FROM jmmember001 where id = '$fid001'";
  $result1 = execute_sql1($link, "linyumo_wk01", $sql1);

  if (mysqli_num_rows($result1) == 0){
    //釋放 $result1 佔用的記憶體
    mysqli_free_result($result1);
    }
  else {
  //顯示記錄四重銷原始直推獎金(7f)
        $row1 = mysqli_fetch_row($result1);
        echo "<tr align='center' style='font-size:14px;'>";		
        echo "<td bgcolor=#ffc>$j</td>";	
        echo "<td>$row[28]</td>";
        echo "<td>$row[3]($row[25])</td>";
       echo "<td>$row[27]/$row[33]";
        echo "<td>$row[19]($row[17])</td>";
        echo "<td>$row1[3]($row1[25])<br>$row1[4]</td>";
        echo "<td>$row1[8]<br>$row1[9]</td>";
        echo "<td>$row1[13]&nbsp;($row1[14])&nbsp;$row1[16]<br>$row1[15]</td>";
        echo "<td>$row1[21]</td>";
        echo "<td>$row1[30]<br>(UNLK=正常)</td>";
        echo "<td><font color='#c6c' size='1'>四階分紅重銷<br>原始直推獎金</font></td>";
        echo "<td>$bonusf7f</td>";
        echo "</tr>";
        $j++;
  }
  }
    //釋放 $result1 佔用的記憶體
    mysqli_free_result($result1);
  }
  //四階判斷end

  }
      echo "</table>" ;
			
      //釋放記憶體空間
      mysqli_free_result($result);
      mysqli_close($link);
?>