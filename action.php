<?php

$action = isset($_GET['action']) ? $_GET['action'] : false;


$link = mysqli_connect('localhost', 'root', '', 'moldotour');

if (mysqli_connect_error()) {
    echo 'error';
    echo mysqli_connect_error();
    return;
}

if ($action == 'signin') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT count(*) FROM `users` WHERE `username` = '{$username}'";
    $result = mysqli_query($link, $sql);
    $result = mysqli_fetch_row($result);

    if ((int)$result[0] == 0) {
        echo "Utilizator inexistent";
        return;
    }

    $sql = "SELECT count(*) FROM `users` WHERE `username` = '{$username}' AND `password` = '{$password}'";
    $result = mysqli_query($link, $sql);
    $result = mysqli_fetch_row($result);

    if ((int)$result[0] > 0) {
        echo "OK";
    } else {
        echo "Parola incorecta";
    }
} elseif ($action == 'signup') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT count(*) FROM `users` WHERE `username` = '{$username}'";
    $result = mysqli_query($link, $sql);
    $result = mysqli_fetch_row($result);

    if ((int)$result[0] > 0) {
        echo 'Nume de utilizator ocupat';
        return;
    }

    $sql = "SELECT count(*) FROM `users` WHERE `email` = '{$email}'";
    $result = mysqli_query($link, $sql);
    $result = mysqli_fetch_row($result);

    if ((int)$result[0] > 0) {
        echo 'Email deja inregistrat';
        return;
    }

    $sql = "INSERT INTO `users` (`username`, `email`, `password`) VALUES ('{$username}', '{$email}', '{$password}')";
    $result = mysqli_query($link, $sql);

    echo "OK";
} else {
    echo "NOTOK";
}