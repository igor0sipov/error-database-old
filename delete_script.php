<html>
    <head>
            <link href="style.css" rel="stylesheet" type="text/css">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>
                Сообщение о загрузке
            </title>
        </head>

    <body>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <div class = "main-content">
            <?php
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
                        
                    if(isset($_POST['popup_del_btn'])){

                        $fault_id = $_POST['fault_id_block'];
                        $request = "DELETE FROM `faults` WHERE `faults`.`fault_id` = $fault_id";
                        
                        if(mysqli_query($link,$request)){
                            echo "<h3 style='text-align: center;'>Запись №{$fault_id} удалена.</h3>";
                        }

                        else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($link);
                        }
                        
                    }
            ?>
            
                <script type="text/javascript">

                setTimeout(() => { 
                    document.location.replace("admin_console.php");/*редирект*/
                }, 3000); // Задержка оповещения

                </script>
        </div>
    </body>
</html>