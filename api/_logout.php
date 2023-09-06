<?php

if (isset($_GET['filename'])) {
    session_start();

    session_unset();

    session_destroy();
    $filename = $_GET['filename'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        header('location: .././' . $filename . '?id=' . $id);
    } else {
        if ($filename === 'php-forum') {
            header('location: .././ ');
        } else {
            header('location: .././' . $filename);
        }
    }
}


exit;
