<?php

    if(isset($_POST['report_user']))
    {
        // Подключаем класс для работы с excel
        require_once('Classes/PHPExcel.php');
        // Подключаем класс для вывода данных в формате excel
        require_once('Classes/PHPExcel/Writer/Excel5.php');

        // Создаем объект класса PHPExcel
        $xls = new PHPExcel();
        // Устанавливаем индекс активного листа
        $xls->setActiveSheetIndex(0);
        // Получаем активный лист
        $sheet = $xls->getActiveSheet();
        // Подписываем лист
        $sheet->setTitle('Отчёт по пользователям');

        // Вставляем текст в ячейку A1
        $sheet->setCellValue("A1", 'Отчёт по пользователям');
        $sheet->getStyle('A1')->getFill()->setFillType(
            PHPExcel_Style_Fill::FILL_SOLID);
      
        // Объединяем ячейки
        $sheet->mergeCells('A1:G1');
        // Выравнивание текста
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(
            PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            include 'api/config.php';
            $res = $link->query("SELECT id, firstname, name, patronomyc, login, password, roles From users");
            $sheet->setCellValue("A2", "№");
            $sheet->setCellValue("B2", "Фамилия"); 
            $sheet->setCellValue("C2", "Имя"); 
            $sheet->setCellValue("D2", "Отчество"); 
            $sheet->setCellValue("E2", "Логин"); 
            $sheet->setCellValue("F2", "Пароль"); 
            $sheet->setCellValue("G2", "Права доступа");  

                $sheet->getStyle('A2')->getAlignment()->
                setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('B2')->getAlignment()->
                setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('C2')->getAlignment()->
                setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('D2')->getAlignment()->
                setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('E2')->getAlignment()->
                setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('F2')->getAlignment()->
                setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('G2')->getAlignment()->
                setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $xls->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);// Устанавливаем автоматическую ширину колонки
                $xls->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);// Устанавливаем автоматическую ширину колонки
                $xls->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);// Устанавливаем автоматическую ширину колонки
                $xls->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);// Устанавливаем автоматическую ширину колонки
                $xls->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);// Устанавливаем автоматическую ширину колонки
                $xls->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);// Устанавливаем автоматическую ширину колонки
                $xls->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);// Устанавливаем автоматическую ширину колонки
            $i = 3;
            $number = 1;
        while($row = $res->fetch_assoc()) {
            $sheet->setCellValue("A".$i, $number);
            $sheet->setCellValue("B".$i, $row['firstname']); 
            $sheet->setCellValue("C".$i, $row['name']); 
            $sheet->setCellValue("D".$i, $row['patronomyc']); 
            $sheet->setCellValue("E".$i, $row['login']); 
            $sheet->setCellValue("F".$i, $row['password']);
            if($row['roles'] == "admin") 
            {
                $sheet->setCellValue("G".$i, "Администратор");
            }
            else if($row['roles'] == "user") 
            {
                $sheet->setCellValue("G".$i, "Пользователь");
            }
            else if($row['roles'] == "moder") 
            {
                $sheet->setCellValue("G".$i, "Модератор");
            }
            
            $i++;
            $number++;
        }
        // Выводим HTTP-заголовки
        header ( "Expires: Mon, 1 Apr 2021 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header ( "Content-type: application/vnd.ms-excel" );
        header ( "Content-Disposition: attachment; filename=users.xls" );

        // Выводим содержимое файла
        $objWriter = new PHPExcel_Writer_Excel5($xls);
        $objWriter->save('php://output');
    }
    
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta name="author" content="Script Tutorials" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Календарь мероприятий</title>

    <!-- add styles and scripts -->
    <link href="css/event_add.css" rel="stylesheet" type="text/css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
</head>
<body>
<?php if (!isset($_COOKIE['session'])):?>


<div class="navbar">
<a href="/index.php">Главная</a>
<a class="a-header" href="login.php">Авторизация</a>
</div>


<?php endif; if(isset($_COOKIE['session'])):?>


    <div class="navbar">
<a href="/index.php">Главная</a>

<a class="a-header" href="logout.php">Выйти</a>
</div>


    <?php endif;?>
<div id="range2">

<div class="outer">
  <div class="middle">
    <div class="inner">

        <div class="login-wr">
          <h2>Отчёты</h2>
          <!-- Тип кодирования данных, enctype, ДОЛЖЕН БЫТЬ указан ИМЕННО так -->

          <form class="form" action="" method="POST">
        
          <button name="report_user"> Отчёт по пользователям </button>
          <button name="report_event"> Отчёт по мероприятиям </button>
          </form>
        </div>

    </div>
  </div>
</div>

</div>
</body>
</html>