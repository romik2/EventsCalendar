<?php

    include 'config.php';

    $res = $link->query("SELECT roles, id From users WHERE session='".$_COOKIE['session']."'");

    $row = $res->fetch_row();
    $roles = $row[0];
    $id = $row[1];
?>