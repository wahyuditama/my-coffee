<?php
include '../database/koneksi.php';
session_start();

$queryOrder = mysqli_query($koneksi, "SELECT * FROM customer");

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
                                                            required
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
                                        <div class="card">
                                            <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Detail' ?> Transaksi</div>
                                            <div class="card-body">
                                                <?php if (isset($_GET['hapus'])): ?>
                                                    <div class="alert alert-success" role="alert">
                                                        Data berhasil dihapus
                                                    </div>
                                                <?php endif ?>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-2">
                                                        <label for="" class="form-label"> Service</label>

                                                    </div>
                                                    <div class="col-sm-10">
                                                        <select data-mdb-select-init name="id_service[]" class="form-control">
                                                            <option value="">Pilih service</option>
                                                            <?php foreach ($rowService as $key => $value) { ?>
                                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['service_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-2">
                                                        <label for="" class="form-label">qty </label>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="qty[]" value="">
                                                    </div>

                                                </div>

                                                <div class="mb-3 row">
                                                    <div class="col-sm-2">
                                                        <label for="" class="form-label"> Service</label>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <select data-mdb-select-init name="id_service[]" class="form-control">
                                                            <option value="">Pilih service</option>
                                                            <?php foreach ($rowService as $key => $value) { ?>
                                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['service_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-2">
                                                        <label for="" class="form-label">qty </label>
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="qty[]" value="">
                                                    </div>

                                                </div>

                                                <div class="mb-3">
                                                    <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">
                                                        Simpan
                                                    </button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row">
                            <!-- Order Statistics -->

                            <!--/ Order Statistics -->

                            <!-- Expense Overview -->

                            <!--/ Expense Overview -->

                            <!-- Transactions -->

                            <!--/ Transactions -->
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

    <?php include '../layout/js.php' ?>
</body>

</html>