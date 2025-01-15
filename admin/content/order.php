<?php
include '../database/koneksi.php';
session_start();

$queryOrder = mysqli_query($koneksi, "SELECT * FROM product");
$resultOrders = [];
while ($rowOrders = mysqli_fetch_array($queryOrder)) {
    $resultOrders[] = $rowOrders;
}

$queryInvoice = mysqli_query($koneksi, "SELECT MAX(id) AS order_code FROM `order`");
$no_unique = "INV";
$data_now = date("dmY");

if ($queryInvoice && mysqli_num_rows($queryInvoice) > 0) {
    $rowInvoice = mysqli_fetch_assoc($queryInvoice);
    $incrementPlus = (int)$rowInvoice['order_code'] + 1;
    $codeInput = $no_unique . "/" . $data_now . "/" . str_pad($incrementPlus, 3, "0", STR_PAD_LEFT);
} else {
    $codeInput = $no_unique . "/" . $data_now . "/001";
}

//Munculkan Nilai Product
// $tableData = isset($_GET['tableData']) ? $_GET['tableData'] : [];
// $totalPay = isset($_SESSION['totalPay']) ? $_SESSION['totalPay'] : 0;

// if (isset($_POST['add_orders'])) {
//     $tableData = [];
//     $totalPay = 0;
//     foreach ($_POST['id_orders'] as $key => $values) {
//         if (!empty($values) && isset($_POST['qty'][$key])) {
//             $qty = $_POST['qty'][$key];
//             $result = mysqli_query($koneksi, "SELECT * FROM product WHERE id = $values");
//             $product = mysqli_fetch_assoc($result);

//             if ($product) {
//                 $subtotal = $product['price'] * $qty;
//                 $totalPay += $subtotal;
//                 $tableData[] = [
//                     'product_name' => $product['product_name'],
//                     'price' => $product['price'],
//                     'qty' => $qty,
//                     'subtotal' => $subtotal,
//                     'totalpay' => $totalPay,
//                 ];
//             }
//         }
//     }
//     // Simpan kedua nilai ke session
//     header('Location: order.php?tableData=' . urlencode(serialize($tableData)) . '&totalPay=' . urlencode($totalPay));
//     exit();
// }

// //Munculkan Kembalian  dan Pembayaran
// if (isset($_GET['tableData']) && isset($_GET['totalPay'])) {
//     $tableData = unserialize(urldecode($_GET['tableData']));
//     $totalPay = (float) $_GET['totalPay'];
// }

// $change = null;
// if (isset($_POST['pay'])) {
//     $payment = (int)$_POST['payment'];
//     $change = $payment - $totalPrice;
// }

?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <?php include '../layout/head.php' ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include '../layout/sidebar.php' ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php include '../layout/navbar.php' ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Transaksi</div>
                                            <div class="card-body">
                                                <?php if (isset($_GET['hapus'])): ?>
                                                    <div class="alert alert-success" role="alert">
                                                        Data berhasil dihapus
                                                    </div>
                                                <?php endif ?>

                                                <div class="mb-3 row">
                                                    <div class="col-sm-12">
                                                        <label for="" class="form-label"> customer</label>
                                                        <input type="text" class="form-control" name="id_user" value="<?php echo $_SESSION['nama'] ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label for="" class="form-label">No Invoice</label>
                                                        <input type="text" class="form-control" name="order_code" value="#<?php echo $codeInput ?>" readonly>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="" class="form-label">Tanggal</label>
                                                        <input type="date"
                                                            class="form-control"
                                                            name="order_date"
                                                            placeholder="Masukkan tanggal"
                                                            value="<?php echo isset($_GET['edit']) ? $rowEdit['date'] : '' ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-12">
                                                        <label for="" class="form-label">Keterangan</label>
                                                        <input type="text"
                                                            name="keterangan"
                                                            placeholder="Tulis Keterangan atau Note disini"
                                                            class=" form-control"
                                                            id="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="col-sm-6">
                                        <div class="card mb-3">
                                            <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Silahakn' ?> Pilih Produk</div>
                                            <div class="card-body">
                                                <?php if (isset($_GET['hapus'])): ?>
                                                    <div class="alert alert-success" role="alert">
                                                        Data berhasil dihapus
                                                    </div>
                                                <?php endif ?>
                                                <form id="input-form">
                                                    <div class="mb-2 row">
                                                        <label class="col-sm-2 col-form-label">Tambah Product</label>
                                                        <div class="col-sm-10">
                                                            <select id="product-select" class="form-select">
                                                                <option value="" data-price="0">Pilih Product</option>
                                                                <?php foreach ($resultOrders as $value) { ?>
                                                                    <option value="<?php echo $value['id']; ?>" data-price="<?php echo $value['price']; ?>">
                                                                        <?php echo $value['product_name']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2 row">
                                                        <label class="col-sm-2 col-form-label">Qty</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" id="product-qty" class="form-control" value="1">
                                                        </div>
                                                    </div>
                                                    <button type="button" id="add-order" class="btn-sm btn-primary">Tambah</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row mt-3">
                            <div class="card">
                                <div class="card-header">Detail Product</div>
                                <table class="table table-bordered table-responsive" id="order-table">
                                    <thead>
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Qty</th>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data akan ditambahkan di sini oleh JavaScript -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">Total Pembayaran</td>
                                            <td id="total-pay">0</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <label for="payment" class="form-label">Jumlah Pembayaran</label>
                                            </td>
                                            <td>
                                                <input type="number" id="payment-input" class="form-control" placeholder="Masukkan jumlah pembayaran">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <label for="change" class="form-label">Kembalian</label>
                                            </td>
                                            <td>
                                                <input type="text" id="change-output" class="form-control" disabled>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <button type="button" id="calculate-change" class="btn-sm btn-success">Hitung Kembalian</button>
                                                <button type="submit" class="btn-sm btn-warning">Simpan Transaksi</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>


                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php include '../layout/footer.php' ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <div class="buy-now">
        <a
            href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
            target="_blank"
            class="btn btn-danger btn-buy-now">Welcome to MY-Coffee</a>
    </div>
    <script>
        let totalPay = 0;

        document.getElementById('add-order').addEventListener('click', function() {
            // Ambil nilai dari form
            const productSelect = document.getElementById('product-select');
            const productName = productSelect.options[productSelect.selectedIndex].text;
            const productPrice = parseFloat(productSelect.options[productSelect.selectedIndex].dataset.price);
            const qty = parseInt(document.getElementById('product-qty').value);

            // Validasi input
            if (!productSelect.value || qty <= 0) {
                alert('Pilih produk dan masukkan jumlah yang valid!');
                return;
            }

            // Hitung subtotal dan update total pembayaran
            const subtotal = productPrice * qty;
            totalPay += subtotal;

            // Tambahkan baris ke tabel
            const tableBody = document.querySelector('#order-table tbody');
            const row = document.createElement('tr');
            row.innerHTML = `
        <td>${productName}</td>
        <td>${productPrice.toLocaleString()}</td>
        <td>${qty}</td>
        <td>${subtotal.toLocaleString()}</td>
    `;
            tableBody.appendChild(row);

            // Update total pembayaran di tabel
            const totalPayElement = document.getElementById('total-pay');
            totalPayElement.textContent = totalPay.toLocaleString();
        });

        document.getElementById('calculate-change').addEventListener('click', function() {
            // Ambil jumlah pembayaran dari input
            const paymentInput = parseFloat(document.getElementById('payment-input').value);

            // Validasi input pembayaran
            if (isNaN(paymentInput) || paymentInput < totalPay) {
                alert('Jumlah pembayaran tidak cukup atau tidak valid!');
                return;
            }

            // Hitung kembalian
            const change = paymentInput - totalPay;

            // Tampilkan kembalian
            document.getElementById('change-output').value = change.toLocaleString();
        });
    </script>

    <?php include '../layout/js.php' ?>
</body>

</html>