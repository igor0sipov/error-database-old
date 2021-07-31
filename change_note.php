<html>
	<head>
		<link rel="shortcut icon" href="/pics/create_ico.png" type="image/x-icon">	
		<link href="style.css" rel="stylesheet" type="text/css">
		<meta  charset="utf-8">
				<title>
					Редактирование записи
				</title>
	</head>
		<body onload="init();">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<div class="main-content">

					<header>
						<a href="index.php" class="header-button">На главную</a>
						<a href="electrical.php" class="header-button">Электрика</a>
						<a href="mechanical.php" class="header-button">Механика</a>
					</header>

					<div class="inscribed-content">

							<?php
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

									if(isset($_POST['change_button'])){
										$fault_id = $_POST['fault_id_cell'];
										$unit_name = $_POST['unit_name_cell'];
										$fault_type = $_POST['fault_type_cell'];
										$fault_name = $_POST['fault_name_cell'];
										$fault_description = $_POST['fault_description_cell'];
										$fault_solve = $_POST['fault_solve_cell'];
									}
							?>

								<form name="edit_fault" action="edit_fault.php" method="post" enctype="multipart/form-data">

									<h2>Редактировать запись</h2>
									<div class="card"> <p class="card-name">Выберите оборудование</p>
											<?php
												$result = mysqli_query($link, "SELECT `machine_name` FROM `machines`");

												if(mysqli_num_rows($result)<=0){
													echo "записей не обнаружено!";
												}
												else{
													echo "<p class='card-info'><select  type='text' name='add_unit_name'>";
														while ($machine_option = mysqli_fetch_array($result)){
															echo "<option name='add_unit_name' value=\"$machine_option[machine_name]\">$machine_option[machine_name]</option>\n";
														}
													echo "</select></p>";
												}
											?>
									</div>

									<div class="card">
										<p class="card-name">id Ошибки</p>
										<div class="card-info"><textarea rows="1" class="input-textarea" type="text" name="init_fault_id" readonly><?php echo $fault_id; ?></textarea></div>
									</div>

									<div class="card">
										<p class="card-name">Выберите тип неисправности</p>
											<p class="card-info">
												<select name="add_fault_type">
													<option value="Механика">Механика</option>
													<option value="Электрика">Электрика</option>
												</select>
											</p>
									</div>

									<div class="card">
										<p class="card-name">Наименование неисправности</p>
										<div class="card-info"><input type="text" name="add_fault_name" size="50" value = "<?php echo $fault_name; ?>"></div>
									</div>

									<div class="card">
										<p class="card-name">Описание неисправности</p>
										<div class="card-info"><textarea rows="1" class="input-textarea" type="text" name="add_fault_description"><?php echo $fault_description; ?></textarea></div>
									</div>

									<div class="card">
										<p class="card-name">Варианты решения</p>
										<div class="card-info"><textarea rows="1" class="input-textarea" type="text" name="add_fault_solve"><?php echo $fault_solve; ?></textarea></div>
									</div>

									<div class="card">
										<p class="card-name">Добавить фото</p>
											<div class="card-info">
												<input class="hidden-input" id="hidden-input" type="file" name="upload">
												<div class="input-button" id="input-button">Выберите файл</div>
											</div>
									</div>

									<input type="submit" name="change_fault_button" value="Изменить">
										
								</form>
					</div>
				</div>
					<script src="autosize_input.js"></script>
					<script src="file_button.js"></script>
		</body>
</html>