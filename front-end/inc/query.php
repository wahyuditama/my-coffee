<?php

include '../../admin/database/koneksi.php';

// Query For Index
$queryImages = mysqli_query($koneksi, "SELECT * FROM product");

$rowImages = [];
while ($row = mysqli_fetch_assoc($queryImages)) {
    $rowImages[] = $row;
}

//Query for about and services 
$querySuggest = mysqli_query($koneksi, "SELECT * FROM about ORDER BY id DESC");

$rowSuggest = [];
while ($row = mysqli_fetch_assoc($querySuggest)) {
    $rowSuggest[] = $row;
}

//query services

$queryServices = mysqli_query($koneksi, "SELECT * FROM services ORDER BY id DESC");

$rowServices = [];
while ($row = mysqli_fetch_assoc($queryServices)) {
    $rowServices[] = $row;
}
