<?php

$host = 'localhost';
$username = 'root';
$pass = '';
$db = 'mycoffee';

$koneksi = mysqli_connect($host, $username, $pass, $db);

if (!$koneksi) {
    die('data error');
}
