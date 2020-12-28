<?php 

include 'session.php';
if ($roles == 'admin')
{
    include 'config.php';
    
    $res = $link->query("DELETE FROM `EventsCalendar`.`events` WHERE (`id` = '".$_GET[id]."');");
    header ('Location: /index.php');  // перенаправление на нужную страницу
    exit;
}
else
{
    echo '<html><head>
    <title>404 Not Found</title>
    </head><body>
    <h1>Not Found</h1>
    <p>The requested URL was not found on this server.</p>
    <hr>
    <address>Apache/2.4.41 (Ubuntu) Server at 192.168.0.36 Port 80</address>
    
    </body></html>';
   

}
?>