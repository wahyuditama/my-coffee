<?php
include '../database/koneksi.php';
include '../layout/encryp.php';
// session_start();

$queryProductPay = mysqli_query($koneksi, "SELECT user.username, orders.id as order_id, orders.* FROM orders 
left JOIN user ON orders.id_user = user.id");
$result = [];
while ($rowProductPay = mysqli_fetch_assoc($queryProductPay)) {
    $result[] = $rowProductPay;
}

//Level
$id = isset($_GET['edit']) ? decryptId($_GET['edit'], $key) : '';
$editData = mysqli_query($koneksi, "SELECT level.level_name, user.* FROM user LEFT JOIN level ON user.id_level = level.id
WHERE user.id ='$id'");


// Query Untuk Detail Pembelian
$idDetail = isset($_GET['detail']) ? $_GET['detail'] : '';
$idUser = isset($_GET['id']) ? $_GET['id'] : '';
$queryProductDetail = mysqli_query($koneksi, "SELECT category.name_category, product.product_name, 
product.price as subtotal, user.*, 
orders.*, detail_order.* FROM  detail_order 
LEFT JOIN product ON detail_order.id_product = product.id 
LEFT JOIN category ON product.id_category = category.id
LEFT JOIN orders ON detail_order.id_order = orders.id 
LEFT JOIN user ON orders.id_user = user.id
WHERE detail_order.id_order = '$idDetail' AND orders.id_user = '$idUser'");

$resultDetail = [];
while ($rowDetail = mysqli_fetch_assoc($queryProductDetail)) {
    $resultDetail[] = $rowDetail;
}

$idPay = isset($_GET['SalesDetail']) ? $_GET['SalesDetail'] : '';
$querySalesDetail = mysqli_query($koneksi, "SELECT * FROM orders WHERE id_user='$idPay'");

$resultSalesDetail = [];
while ($rowSalesDetail = mysqli_fetch_assoc($querySalesDetail)) {
    $resultSalesDetail[] = $rowSalesDetail;
}
//fuction ubah status
function changeStatus($status)
{
    switch ($status) {
        case '1':
            $badge = "<span class='btn-sm btn bg-success text-white'> Selesai Dipesan</span>";
            break;

        default:
            $badge = "<span class='btn-sm btn bg-warning text-white'> Pesanan Baru</span>";

            break;
    }
    return $badge;
}
