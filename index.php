
<?php

// Get current year, month and day
list($iNowYear, $iNowMonth, $iNowDay) = explode('-', date('Y-m-d'));

// Get current year and month depending on possible GET parameters
if (isset($_GET['month'])) {
    list($iMonth, $iYear) = explode('-', $_GET['month']);
    $iMonth = (int)$iMonth;
    $iYear = (int)$iYear;
} else {
    list($iMonth, $iYear) = explode('-', date('n-Y'));
}

// Get name and number of days of specified month
$iTimestamp = mktime(0, 0, 0, $iMonth, $iNowDay, $iYear);
list($sMonthName, $iDaysInMonth) = explode('-', date('F-t', $iTimestamp));

// Get previous year and month
$iPrevYear = $iYear;
$iPrevMonth = $iMonth - 1;
if ($iPrevMonth <= 0) {
    $iPrevYear--;
    $iPrevMonth = 12; // set to December
}

// Get next year and month
$iNextYear = $iYear;
$iNextMonth = $iMonth + 1;
if ($iNextMonth > 12) {
    $iNextYear++;
    $iNextMonth = 1;
}

// Get number of days of previous month
$iPrevDaysInMonth = (int)date('t', mktime(0, 0, 0, $iPrevMonth, $iNowDay, $iPrevYear));

// Get numeric representation of the day of the week of the first day of specified (current) month
$iFirstDayDow = (int)date('w', mktime(0, 0, 0, $iMonth, 1, $iYear));

// On what day the previous month begins
$iPrevShowFrom = $iPrevDaysInMonth - $iFirstDayDow + 1;

// If previous month
$bPreviousMonth = ($iFirstDayDow > 0);

// Initial day
$iCurrentDay = ($bPreviousMonth) ? $iPrevShowFrom : 1;

$bNextMonth = false;
$sCalTblRows = '';


switch ($sMonthName) {
    case "December":
        $month = 12;
        break;
    case "January":
        $month = 1;
        break;
        case "February":
            $month = 2;
            break;
            case "March":
                $month = 3;
                break;
                case "April":
                    $month = 4;
                    break;
                    case "May":
                        $month = 5;
                        break;
                        case "June":
                            $month = 6;
                            break;
                            case "July":
                                $month = 7;
                                break;
                                case "August":
                                    $month = 8;
                                    break;
                                    case "September":
                                        $month = 9;
                                        break;
                                        case "October":
                                            $month = 10;
                                            break;
                                            case "November":
                                                $month = 11;
                                                break;
                                            }

$host = 'localhost'; //в кавчках введите адрес сервера 
$database = 'EventsCalendar'; //в кавчках введите имя базы данных
$user = 'root'; //в кавчках введите имя пользователя
$password = 'admins1N'; //в кавчках введите пароль

$link = mysqli_connect($host, $user, $password, $database) //Подключение к БД
    or die("Ошибка " . mysqli_error($link));//Проверям были ли ошибки

$link->set_charset('utf8');//Ставим кадировки UTF-8


$res = $link->query("SELECT count(date) as cont From events WHERE MONTH(date) = '".$month."' and YEAR(date) = '".$iYear."'");
        $row = $res->fetch_assoc();
        $col_z = $row['cont'];
        
// Generate rows for the calendar
for ($i = 0; $i < 6; $i++) { // 6-weeks range
    $sCalTblRows .= '<tr>';
    for ($j = 0; $j < 7; $j++) { // 7 days a week
        
        $sClass = 'daysik';
        if ($iNowYear == $iYear && $iNowMonth == $iMonth && $iNowDay == $iCurrentDay && !$bPreviousMonth && !$bNextMonth) {
            $sClass = 'today';
        } elseif (!$bPreviousMonth && !$bNextMonth) {
            $sClass = 'current';
        }
        
        if ($col_z > 0 )
        {
            $pr = 0;
            $res = $link->query("SELECT DAY(date) as days From events WHERE MONTH(date) = '".$month."' and YEAR(date) = '".$iYear."' group by date");
            $day = $iCurrentDay;
            while($rows = $res->fetch_assoc())
            {
                if ($iCurrentDay == $rows['days'] and $sClass != 'daysik')
                {
                    $sCalTblRows .= '<td class="mer"><a href="templates/event.php?date='.$iCurrentDay.'&month='.$sMonthName.'&year='.$iYear.'">'.$iCurrentDay.'</a></td>';
                    $pr = 1;
                }
            }
            if ($pr != 1 )
            {
                $sCalTblRows .= '<td class="'.$sClass.' "><a href="templates/event.php?date='.$iCurrentDay.'&month='.$sMonthName.'&year='.$iYear.'">'.$iCurrentDay.'</a></td>';
            }
        }
        else
        {
            $sCalTblRows .= '<td class="'.$sClass.' "><a href="templates/event.php?date='.$iCurrentDay.'&month='.$sMonthName.'&year='.$iYear.'">'.$iCurrentDay.'</a></td>';
        }
        // Next day
        $iCurrentDay++;
        if ($bPreviousMonth && $iCurrentDay > $iPrevDaysInMonth) {
            $bPreviousMonth = false;
            $iCurrentDay = 1;
        }
        if (!$bPreviousMonth && !$bNextMonth && $iCurrentDay > $iDaysInMonth) {
            $bNextMonth = true;
            $iCurrentDay = 1;
        }
    }
    $sCalTblRows .= '</tr>';
}

// Prepare replacement keys and generate the calendar
$aKeys = array(
    '__prev_month__' => "{$iPrevMonth}-{$iPrevYear}",
    '__next_month__' => "{$iNextMonth}-{$iNextYear}",
    '__cal_caption__' => $sMonthName . ', ' . $iYear,
    '__cal_rows__' => $sCalTblRows,
);
$sCalendarItself = strtr(file_get_contents('templates/calendar.html'), $aKeys);

// AJAX requests - return the calendar
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' && isset($_GET['month'])) {
    header('Content-Type: text/html; charset=utf-8');
    echo $sCalendarItself;
    exit;
}
if (!isset($_COOKIE['session']))
    {
        echo '<div class="navbars">
        <a href="/index.php">Главная</a>
        <a class="a-header" href="/templates/login.php">Авторизация</a>
        </div>';
    }
else if (isset($_COOKIE['session']))
{
    echo '<div class="navbars">
    <a href="/index.php">Главная</a>';
    include 'templates/api/session.php';
            if ($roles == 'admin'){
                echo ' <a href="/users_add.php">Добавить пользователя</a>
                <a class="a-header" href="event_read.php">Отчёты</a>';
            }
    echo '<a class="a-header" href="/templates/logout.php">Выйти</a>
    </div>';
}

   
    
$aVariables = array(
    '__calendar__' => $sCalendarItself,
);
echo strtr(file_get_contents('templates/index.html'), $aVariables);