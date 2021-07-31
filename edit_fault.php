<html>
    <head>
            <link href="style.css" rel="stylesheet" type="text/css">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>
                Сообщение о редактировании
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
                    

                    if(isset($_POST['change_fault_button'])){
                        $note_id = $_POST['init_fault_id'];
                        $unit_name=$_POST['add_unit_name'];
                        $fault_type=$_POST['add_fault_type'];
                        $fault_name = $_POST['add_fault_name'];
                        $fault_description = $_POST['add_fault_description'];
                        $fault_solve = $_POST['add_fault_solve'];

                        $sql = "UPDATE `faults` SET 
                        `fault_name` = '$unit_name', 
                        `fault_type` = '$fault_type', 
                        `fault_name` = '$fault_name', 
                        `fault_description` = '$fault_description', 
                        `fault_solve` = '$fault_solve' 
                        WHERE `faults`.`fault_id` = $note_id;";

                            if (mysqli_query($link, $sql)) {
                                echo "<h3 style='text-align: center;'>Успешно обновлено</h3>";
                            } 

                            else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($link);
                            }


                            $fault_id = $note_id;                     

                            // Перезапишем переменные для удобства
                            $filePath  = $_FILES['upload']['tmp_name'];
                            $errorCode = $_FILES['upload']['error'];

                            // Проверим на ошибки
                            if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

                                // Массив с названиями ошибок
                                $errorMessages = [
                                    UPLOAD_ERR_INI_SIZE   => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP',
                                    UPLOAD_ERR_FORM_SIZE  => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме',
                                    UPLOAD_ERR_PARTIAL    => 'Загружаемый файл был получен только частично.',
                                    UPLOAD_ERR_NO_FILE    => 'Файл не был загружен',
                                    UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка',
                                    UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск',
                                    UPLOAD_ERR_EXTENSION  => 'PHP-расширение остановило загрузку файла',
                                ];

                                // Зададим неизвестную ошибку
                                $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';

                                // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
                                $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;

                                // Выведем название ошибки
                                die("<h3 style='text-align: center;'>$outputMessage</h3>"."<a href='index.php'>На главную</a>");

                                
                            }
                                // Создадим ресурс FileInfo
                                $fi = finfo_open(FILEINFO_MIME_TYPE);

                                // Получим MIME-тип
                                $mime = (string) finfo_file($fi, $filePath);

                                // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
                                if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');

                                // Результат функции запишем в переменную
                                $image = getimagesize($filePath);

                                // Зададим ограничения для картинок
                                $limitBytes  = 1024 * 1024 * 10;
                                $limitWidth  = 5000;
                                $limitHeight = 5000;
                                // Проверим нужные параметры
                                if (filesize($filePath) > $limitBytes){
                                    die ("<br>Размер изображения не должен превышать 10 Мбайт.
                                            <a href='index.php'>На главную</a>");
                                }
                                if ($image[1] > $limitHeight){
                                    die ("<br>Высота изображения не должна превышать 5000 точек.
                                            <a href='index.php'>На главную</a>");
                                }
                                if ($image[0] > $limitWidth){
                                    die ("<br>Ширина изображения не должна превышать 5000 точек.
                                            <a href='index.php'>На главную</a>");
                                }

                                // Сгенерируем новое имя файла на основе MD5-хеша
                                $name = $fault_id;

                                // Сгенерируем расширение файла на основе типа картинки
                                $extension = image_type_to_extension($image[2]);

                                // Сократим .jpeg до .jpg
                                $format = str_replace('jpeg', 'jpg', $extension);

                                $img = "$name$format"; 

                                // Переместим картинку с новым именем и расширением в папку /pics
                                if (!move_uploaded_file($filePath, __DIR__ . '/pics/' . $name . $format)) {
                                    die ('<br>При записи изображения на диск произошла ошибка.');
                                }

                                else {
                                    echo "<h3 style='text-align: center;'>Изображение заменено | $img </h3>";
                                    $add_img = "INSERT INTO `images` (`image_id`,`img`) VALUES ('$fault_id','$img')";
                                    mysqli_query ($link,$add_img);
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