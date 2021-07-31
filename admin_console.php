<html>
	<head>
	<link rel="shortcut icon" href="/pics/index_ico.png" type="image/x-icon">
		<link href="console_style.css" rel="stylesheet" type="text/css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>
			Журнал ошибок
		</title>
	</head>
		<body>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <div class = main-content>
            <header class="header">
							<a href="index.php" class="header-button">На главную</a>
							<a href="mechanical.php" class="header-button">Механика</a>
							<a href="electrical.php" class="header-button">Электрика</a>
			</header>
        
            <?php 
                $host = 'fdb20.awardspace.net';  
                $user = '3304062_errordb';    
                $pass = '1236985a'; 
                $db_name = '3304062_errordb';   
                $link = mysqli_connect($host, $user, $pass, $db_name);

                $set = "SET NAMES 'utf8';"; 
						
                if (!mysqli_query ($link, $set)){
                    echo "Не удалось установить UTF-8";
                }

                if (!$link) {
                    echo 'Cant connect to DB, Error code: ' . mysqli_connect_errno() . ', Error: ' . mysqli_connect_error();
                    exit;
                }
                echo "";

                $request = "SELECT `fault_id`, `unit_name`, `fault_name`, `fault_description`, `fault_solve`, `fault_type` FROM `faults`";

                $sql = mysqli_query($link,$request);
                
                echo 
                "<table border='1' style = 'margin: 2em 0 0;'>".
                "<tr>".
                "<th class = 'id-cell'>ID</th>". 
                "<th>Название машины</th>". 
                "<th>Наименование ошибки</th>". 
                "<th>Тип ошибки</th>".
                "<th>Изменить</th>".
                "<th>Удалить</th>".  
                "</tr>";
                while ($result = mysqli_fetch_array($sql)){
                    echo
                    "<form action='change_note.php' method='post' enctype='multipart/form-data>'".
                    "<tr>".
                    "<td class = 'id-cell'><textarea class = 'cell-textarea id-cell-textarea' name = 'fault_id_cell' readonly>{$result['fault_id']}</textarea></td>". 
                    "<td style = 'display: none;'><textarea class = 'cell-textarea' name = 'fault_id_block' form = 'delete_form' readonly>{$result['fault_id']}</textarea></td>". 
                    "<td><textarea class = 'cell-textarea' name = 'unit_name_cell' readonly>{$result['unit_name']}</textarea></td>". 
                    "<td><textarea class = 'cell-textarea' name = 'fault_name_cell' readonly>{$result['fault_name']}</textarea></td>". 
                    "<td><textarea class = 'cell-textarea' name = 'fault_type_cell' readonly>{$result['fault_type']}</textarea></td>".
                    "<td style = 'display: none;'><textarea class = 'cell-textarea' name = 'fault_description_cell' readonly>{$result['fault_description']}</textarea></td>". 
                    "<td style = 'display: none;'><textarea class = 'cell-textarea' name = 'fault_solve_cell' readonly>{$result['fault_solve']}</textarea></td>".
                    "<td><input type='submit' name='change_button' class = 'btn' value='Изменить'></td>".
                    "</form>".
                    "<td><input type='submit' name='delete_button' class = 'btn delete-button ' value='Удалить'></form></td>".
                    "</tr>";

                }             

                echo "</table>";

            ?>
                <div class="popup-overlay hidden">
                    <div class="popup">
                        <div class = "popup-content-container">
                                <p class = "delete-q">Вы уверены, что хотите удалить запись</p>
                                <div class = "popup-btn-wrapper">
                                    <form action = "delete_script.php" method = "post" enctype = "multipart/form-data" id = "delete_form"> 
                                        <input type="submit" name="popup_del_btn" class = "btn popup-button" value="Удалить">
                                    </form>
                                    <input type="submit" name="back_button" class = "btn popup-button" value="Назад">
                                </div>
                        </div>
                    </div>
                </div>

            </div>
            <script src="popup.js"></script>
		</body>
</html>