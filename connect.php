<?php
    $host = 'fdb20.awardspace.net';  
    $user = '3304062_errordb';    
    $pass = '1236985a'; 
    $db_name = '3304062_errordb';   
    $link = mysqli_connect($host, $user, $pass, $db_name);

      if (!$link) {
        echo 'Cant connect to DB, Error code: ' . mysqli_connect_errno() . ', Error: ' . mysqli_connect_error();
        exit;
      }
?>