<?php
include '../database/koneksi.php';
session_start();
//Tambah Customer
if (isset($_POST['tambah'])) {
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    $insert = mysqli_query($koneksi, "INSERT INTO customer (customer_name, phone, address) VALUES ('$customer_name','$phone','$alamat')");
    header("location: customer.php?input=berhasil");
}
//edit data customer
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editData = mysqli_query($koneksi, "SELECT * FROM customer WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($editData);

if (isset($_POST['edit'])) {
    $customer_name   = $_POST['customer_name'];
    $phone = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $update = mysqli_query($koneksi, "UPDATE customer SET customer_name='$customer_name', phone='$phone', address='$alamat' WHERE id='$id'");
    header("location:customer.php?ubah=berhasil");
}

//Delet Data Customer

$id_hapus = isset($_GET['delete']) ? $_GET['delete'] : '';
if ($id_hapus) {
    mysqli_query($koneksi, "DELETE FROM customer WHERE id='$id_hapus'");
    header("location: customer.php?hapus=berhasil");
}
//Ambil data Customer
$queryCustomer = mysqli_query($koneksi, "SELECT * FROM customer ORDER BY id DESC");
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
                        <?php if (isset($_GET['edit']) || isset($_GET['tambah'])) : ?>
                            <div class="row">
                                <div class="card">
                                    <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Customer</div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="" class="form-label">Nama Customer</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="customer_name"
                                                        placeholder="Masukkan nama Pelanggan"
                                                        required
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['customer_name'] : '' ?>" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="" class="form-label">Nomor Telepon</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="telepon"
                                                        placeholder="Masukkan Nomor Telepon"
                                                        required
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['phone'] : '' ?>" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="" class="form-label">Alamat Pelanggan</label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="alamat"
                                                        placeholder="Masukkan Alamat"
                                                        required
                                                        value="<?php echo isset($_GET['edit']) ? $rowEdit['address'] : '' ?>" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>>
                                                </div>
                                            </div>
                                            <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>" class="btn-sm btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between">
                                                <a href="?true" class="btn btn-sm mb-3">Data Customers</a>
                                                <a href="customer.php?tambah" class="btn btn-primary btn-sm mb-3">Tambah Customer</a>
                                            </div>
                                            <?php if (isset($_GET['hapus'])): ?>
                                                <div class="alert alert-success" role="alert">
                                                    Data berhasil dihapus
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>No. Telp</th>
                                                        <th>Alamat</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    while ($rowCustomer = mysqli_fetch_assoc($queryCustomer)) { ?>
                                                        <tr>
                                                            <td><?php echo $no++ ?></td>
                                                            <td><?php echo $rowCustomer['customer_name'] ?></td>
                                                            <td><?php echo $rowCustomer['phone'] ?></td>
                                                            <td><?php echo $rowCustomer['address'] ?></td>
                                                            <td>
                                                                <a href="?edit=<?php echo $rowCustomer['id'] ?>" class="btn-sm btn-success bx bx-pencil"></a>
                                                                <a href="?delete=<?php echo $rowCustomer['id'] ?>" class="btn-sm btn-danger bx bx-trash"></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php endif ?>
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