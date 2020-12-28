<?php

    include 'config.php';

    $res = $link->query("SELECT roles From users WHERE session='".$_COOKIE['session']."'");

    $row = $res->fetch_row();
    $roles = $row[0];
?>