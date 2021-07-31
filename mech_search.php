<html>
	<head>
		<link rel="shortcut icon" href="/pics/search_ico.png" type="image/x-icon">
		<link href="style.css" rel="stylesheet" type="text/css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>
			Поиск
		</title>
	</head>
		<body>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<div class="main-content">
					<div class="search-field">
					<header class="header">
						<a href="index.php" class="header-button">На главную</a>
						<a href="mechanical.php" class="header-button">Механика</a>
						<a href="electrical.php" class="header-button">Электрика</a>
					</header>
						<h2>Механика.Поиск</h2>
						<form name="fault_search" method="POST">
							<input class="search-line" type="text" name="fault_search" size="50">
							<input style="cursor:pointer;display: inline;" type="submit" name="search_button" value="Поиск">
						</form>
					</div>

				<div class="search-result">

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

						if(isset($_POST['search_button'])){
							$machine_name = $_POST['fault_search'];

							$command = "SELECT `fault_id`, `fault_name`, `fault_description`, `fault_solve`, `unit_name` FROM `faults` 
							WHERE `fault_name` LIKE '%{$_POST['fault_search']}%' AND `fault_type` LIKE 'Механика' 
							OR `fault_description` LIKE '%{$_POST['fault_search']}%' AND `fault_type` LIKE 'Механика' 
							OR `unit_name` LIKE '%{$_POST['fault_search']}%' AND `fault_type` LIKE 'Механика' 
							OR `fault_solve` LIKE '%{$_POST['fault_search']}%' AND `fault_type` LIKE 'Механика' ";

								$sql = mysqli_query($link,$command);

							echo
							"<div class='separator'></div>".
							"<h2>Результат поиска</h2>";

							if ($sql){

								while ($res= mysqli_fetch_array($sql)) {
								$img_request = mysqli_query ($link, "SELECT `img` FROM `images` WHERE `image_id` = '{$res['fault_id']}'");
								$pic = mysqli_fetch_array ($img_request);
								echo 
								"<div class='search-detail'><details>" .
								"<p><summary>{$res['fault_name']}</summary></p>" .
								"<div class='card'><p class='card-name'>Название машины</p><div class='card-info'><div class='text-output'>{$res ['unit_name']}</div></div></div>" .
								"<div class='card'><p class='card-name'>Наименование ошибки</p><div class='card-info'><div class='text-output'>{$res ['fault_name']}</div></div></div>" .
								"<div class='card'><p class='card-name'>Описание ошибки</p><div class='card-info'><div class='text-output'>{$res ['fault_description']}</div></div></div>" .
								"<div class='card'><p class='card-name'>Решение ошибки</p><div class='card-info'><div class='text-output'>{$res ['fault_solve']}</div></div></div>" .
								"<div class='card'><p class='card-name'>Изображение</p><div class='card-info'><img src='/pics/{$pic['img']}' alt=''></div></div>" .
								"</details></div>";
								}
								
								echo
								"<div class='separator'></div>";
							}
							else{
								echo "Результатов не найдено";
							}
						}
						
					?>
				</div>
			</div>
		</body>
</html>