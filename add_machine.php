<?php
header("Content-Type: text/html; charset=utf-8");
 /* Принимаем данные из формы */
 $host = 'fdb20.awardspace.net';  
 $user = '3304062_errordb';    
 $pass = '1236985a'; 
 $db_name = '3304062_errordb';   
 $link = mysqli_connect($host, $user, $pass, $db_name);
 
 $set = "SET NAMES 'utf8';"; // Установка кодировки UTF-8
        
        if (!mysqli_query ($link, $set)){
            echo "Не удалось установить UTF-8";
        }

        if (!$link) {
            echo 'Cant connect to DB, Error code: ' . mysqli_connect_errno() . ', Error: ' . mysqli_connect_error();
            exit;
        }
        

        if(isset($_POST['machine_button'])){
            $machine_name = $_POST['machine_name'];
        }

$sql = "INSERT INTO machines (machine_name) VALUES ('$machine_name')";

        if (mysqli_query($link, $sql)) {
            echo "Успешно добавлено";
        } 

        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
  ?>
<script type="text/javascript">
setTimeout(() => { 
    document.location.replace("create.php");/*редирект*/
}, 2000); // Задержка оповещения

</script>