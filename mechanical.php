<html>
  <head>
    <link rel="shortcut icon" href="/pics/mechanical_ico.png" type="image/x-icon">
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
      <title>
        Механика
      </title>
  </head>
<body>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <div class="main-content">

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
          ?>

          <header class="header">
            <a href="index.php" class="header-button">На главную</a>
            <a href="electrical.php" class="header-button">Электрика</a>
            <a href="mech_search.php" class="header-button">Поиск</a>
          </header>

          <div class="machine-list">
            <div class="card">
              <p class="card-name">Список оборудования</p>
            
            <form name="show_machine_list" method="POST">
              <?php
                $result = mysqli_query($link, "SELECT `machine_name` FROM `machines`");
                
                if(mysqli_num_rows($result)<=0){
                  echo ("записей не обнаружено!");
                }

                else{
                  echo ("<p class='card-info'><select  type='text' name='machine_unit'>");

                  while ($machine_option = mysqli_fetch_array($result)) {
                    echo ("<option name='machine_unit' value=\"$machine_option[machine_name]\">$machine_option[machine_name]</option>\n");
                  }

                  echo ("</select></p>");
                }
              ?>
            </div>
              <input class="show-error-button" type="submit" name="show_button" value="Показать ошибки">
            </form>
            <div class="separator"></div>
            <?php
              $unit_name=$_POST['machine_unit'];

              if (isset($_POST['show_button'])) {
                  
                $sql = mysqli_query($link, "SELECT `fault_id`, `fault_name`, `fault_description`, `fault_solve`, `fault_type` 
                FROM `faults` WHERE `unit_name` = '{$unit_name}' AND `fault_type` = 'Механика' ");

                echo "<h2>{$unit_name}</h2>" . 
                "<div class='machine_links'>";

                  while ($res = mysqli_fetch_array($sql)) {
                    $img_request = mysqli_query ($link, "SELECT `img` FROM `images` WHERE `image_id` = '{$res['fault_id']}'");
                    $pic = mysqli_fetch_array ($img_request);
                    echo           
                    "<div class='fault-content'><details>" .
                    "<p><summary>{$res['fault_name']}</summary></p>" .
                    "<div class='card'><p class='card-name'>Наименование ошибки</p>" .
                    "<div class='card-info'><div class='text-output'>{$res['fault_name']}</div></div></div>" .
                    "<div class='card'><p class='card-name'> Описание ошибки </p>" . 
                    "<div class='card-info'><div class='text-output'>{$res['fault_description']}</div></div></div>" .
                    "<div class='card'><p class='card-name'> Решение ошибки </p>" .  
                    "<div class='card-info'><div class='text-output'>{$res['fault_solve']}</div></div></div>";
                      if ($pic['img']!=""){
                        echo 
                        "<div class='card'><p class='card-name'> Изображение </p>" .
                        "<div class='card-info'><img src='/pics/{$pic['img']}' alt=''></div></div>" .
                        "</details></div>";
                      }
                      else {
                        echo
                        "<div class='card'><p class='card-name'> Изображение </p>" .
                        "<div class='card-info'><div class='text-output'>Изображение отсутствует</div></div></div>" .
                        "</details></div>";
                      }

                  }

                  echo  "</div>".
                        "<div class='separator'></div>";
              }

              else {
              echo '<p>' . mysqli_error($link) . '</p>';
              }
            ?>

          </div>

      </div>
	</body>
</html>