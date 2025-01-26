<?php
include '../database/koneksi.php';
// include '../layout/helper.php';
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
if (isset($_POST['simpan'])) {
    $user = $_POST['id_user'];
    $inv = $_POST['order_code'];
    $date = $_POST['date'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $pay = $_POST['payment'];
    $return = $_POST['change'];

    //Insert ke tabel orders
    $insertOrder = mysqli_query($koneksi, "INSERT INTO orders (id_user, order_code, order_date, total_price) VALUES ('$user', '$inv', '$date', '$price')");

    //ambil data ID saat $insertOrder di klik
    if ($insertOrder) {
        $id_order = mysqli_insert_id($koneksi);

        // Cek name='id_product' akan mengirim data dalam bentuk looping
        if (isset($_POST['id_product'])) {
            foreach ($_POST['id_product'] as $product) {
                //Insert ke tabel detail_order 
                $insertDetail = mysqli_query($koneksi, "INSERT INTO detail_order (id_order, id_product, qty, price, payment, refund) VALUES ('$id_order', '$product', '$qty', '$price', '$pay', '$return')");
            }
        }
    }

    header("Location: product_pay.php?detail=" . $id_order . "&id=" . $user);
    exit();
}
// var_dump($_SESSION['idOrder']);

// print_r($result);
// die();

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
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="card p-3">
                                    <div class="row">
                                        <?php if (!empty($_SESSION['orders_id'])) :  ?>
                                            <a href="product_pay.php?detail=<?php echo $_SESSION['orders_id'] ?>&id=<?php echo $_SESSION['user_id'] ?>" class="btn-sm btn-danger">Pembelian Anda</a>
                                        <?php endif ?>
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-header">Tambah Transaksi</div>
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
                                                            <input type="hidden" name="id_user" value="<?php echo $_SESSION['user_id'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <div class="col-sm-6">
                                                            <label for="" class="form-label">No Invoice</label>
                                                            <input type="text" class="form-control" name="order_code" value="<?php echo $codeInput ?>" readonly>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="" class="form-label">Tanggal</label>
                                                            <input type="date"
                                                                class="form-control"
                                                                name="date"
                                                                placeholder="Masukkan tanggal"
                                                                value="">
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
                                                    <div class="mb-2 row">
                                                        <label class="col-sm-2 col-form-label">Tambah Product</label>
                                                        <div class="col-sm-10">
                                                            <select id="product-select" class="form-select">
                                                                <option value="" data-price="0">Pilih Product</option>
                                                                <?php foreach ($resultOrders as $value) { ?>
                                                                    <option value="<?php echo $value['id'] ?>" data-price="<?php echo $value['price'] ?>" data-id="<?php echo $value['id'] ?>">
                                                                        <?php echo $value['product_name'] ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="mb-2 row">
                                                        <label class="col-sm-2 col-form-label">Qty</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" name="qty" id="product-qty" class="form-control" value="">
                                                            <!-- <input type="hidden" name="qty" id="total-qty"> -->
                                                        </div>
                                                    </div>
                                                    <button type="button" id="add-order" name="simpan" class="btn-sm btn-primary">Tambah</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                            <!-- Data akan ditambahkan dengan JavaScript -->
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3">Total Pembayaran</td>
                                                <td id="display-total-price">0</td>
                                                <input type="hidden" name="price" id="total-price">
                                            </tr>
                                            <tr>
                                                <td colspan=" 3">
                                                    <label class="form-label">Jumlah Pembayaran</label>
                                                </td>
                                                <td>
                                                    <input type="number" id="payment-input" name="payment" class="form-control" placeholder="Masukkan jumlah pembayaran">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <label for="change" class="form-label">Kembalian</label>
                                                </td>
                                                <td>
                                                    <input type="hidden" name="change" id="change-output">
                                                    <input type="text" id="display-change" class="form-control" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <?php if (isset($_GET['pay'])) : ?>

                                                    <?php else : ?>
                                                        <button type="button" id="calculate-change" class="btn-sm btn-success">Hitung Kembalian</button>
                                                        <button type="submit" class="btn-sm btn-warning" name="simpan">Simpan Transaksi</button>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </form>
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
    <style>
        .note {
            display: none
        }
    </style>
    <script>
        let totalPay = 0;

        document.getElementById('add-order').addEventListener('click', function() {
            // Ambil nilai dari form
            const productSelect = document.getElementById('product-select');
            const productName = productSelect.options[productSelect.selectedIndex].text;
            const productPrice = parseFloat(productSelect.options[productSelect.selectedIndex].dataset.price);
            const qty = parseInt(document.getElementById('product-qty').value);
            const idProduct = parseFloat(productSelect.options[productSelect.selectedIndex].dataset.id);
            // document.getElementById('product-id').value = idProduct;

            // Validasi input
            if (!productSelect.value || qty <= 0) {
                alert('Pilih produk dan masukkan jumlah yang valid!');
                return;
            }
            //ambil ID product

            // hitung total qty
            // const valueQty = qty + qty;

            // document.getElementById('total-qty').value = valueQty;

            // Hitung subtotal dan update total pembayaran
            const subtotal = productPrice * qty;
            totalPay += subtotal;

            // Tambahkan baris ke tabel
            const tableBody = document.querySelector('#order-table tbody');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class='note'>
                    <input name='id_product[]' value='${idProduct}'>
                </td>
                <td>${productName}</td>
                <td>${productPrice.toLocaleString()}</td>
                <td>${qty}</td>
                <td>${subtotal.toLocaleString()}</td>
            `;
            tableBody.appendChild(row);

            // Update total pembayaran di tabel
            const totalPayElement = document.getElementById('display-total-price');
            const hiddenPriceInput = document.getElementById('total-price');
            totalPayElement.textContent = totalPay.toLocaleString();
            hiddenPriceInput.value = totalPay;
        });

        document.getElementById('calculate-change').addEventListener('click', function() {
            const paymentInput = parseFloat(document.getElementById('payment-input').value);

            // Validasi input pembayaran
            if (isNaN(paymentInput) || paymentInput < totalPay) {
                alert('Jumlah pembayaran tidak cukup atau tidak valid!');
                return;
            }

            // Hitung kembalian
            const change = paymentInput - totalPay;

            // Tampilkan kembalian
            document.getElementById('change-output').value = change;
            document.getElementById('display-change').value = change.toLocaleString();
        });
    </script>

    <?php include '../layout/js.php' ?>
</body>

</html>