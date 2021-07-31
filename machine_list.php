<?php
header("Content-Type: text/html; charset=utf-8");
 /* Принимаем данные из формы */
 $host = 'fdb20.awardspace.net';  
 $user = '3304062_errordb';    
 $pass = '1236985a'; 
 $db_name = '3304062_errordb';   
 $link = mysqli_connect($host, $user, $pass, $db_name);
 
 $set = "SET NAMES 'utf8';"; // Установка кодировки UTF-8
 
 $result = mysql_query("SELECT `machine_name` FROM `machines`");
 if(mysql_num_rows($result)<=0)
 {echo ("записей не обнаружено!");}
  
 else{echo ("<select  type='text' name='machine_name'>");
 while ($myrow = mysql_fetch_array($result)) 
 {echo ("<option name='machine_name' value=\"$myrow[machine_name]\">$myrow[machine_name]</option>\n");}
 echo ("</select>");}
 ?>