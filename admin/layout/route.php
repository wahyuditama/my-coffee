<?php
$url = isset($_GET['url']) ? $_GET['url'] : 'home';

switch ($url) {
    case 'level':
        require 'admin/content/level.php';
        break;
    case 'user':
        require 'admin/content/user.php';
        break;
    default:
        echo "Halaman tidak ditemukan: $url";
}
