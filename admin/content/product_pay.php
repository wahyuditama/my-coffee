<?php
include '../database/koneksi.php';
include '../layout/helper.php';
session_start();


//status
if (isset($_GET['status']) && isset($_GET['cancel'])) {
    $id = $_GET['status'];
    $delete = $_GET['cancel'];

    $cancelStatus = ($delete == 1) ? 0 : 1;
    $updateStatus1 = mysqli_query($koneksi, "UPDATE orders SET status=$cancelStatus WHERE id='$id'");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM orders WHERE id='$id'");
}
// print_r($updateStatus);
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
                        <div class="row">
                            <div class="card">
                                <div class="card-body">
                                    <?php if (isset($_GET['detail']) || isset($_GET['id'])) : ?>
                                        <div class="container-xxl flex-grow-1 container-p-y">
                                            <div class="row">
                                                <div class="col-sm-12 mb-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                                    <h5 class="m-0 p-0">Transaksi Pembelian :</h5>
                                                                </div>
                                                                <div class="col-sm-6 mb-3 mb-sm-0" align="right">
                                                                    <a href="?" class="btn btn-secondary"><i class='bx bx-arrow-back'></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" col-sm-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Detail Data Transaksi</h5>
                                                        </div>
                                                        <div class="card-Body">
                                                            <table class="table table-bordered table-striped">
                                                                <tr>
                                                                    <th>No Invoice</th>
                                                                    <td><?php echo $resultDetail[0]['order_code'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Tanggal</th>
                                                                    <td><?php echo $resultDetail[0]['order_date'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Status</th>
                                                                    <td><?php echo changeStatus($resultDetail[0]['status']) ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Data Pelanggan</h5>
                                                        </div>
                                                        <div class="card-Body">
                                                            <table class="table table-bordered table-striped">
                                                                <tr>
                                                                    <th>Nama </th>
                                                                    <td><?php echo $resultDetail[0]['username'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>nomor Telepon</th>
                                                                    <td><?php echo $resultDetail[0]['phone'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Alamat</th>
                                                                    <td><?php echo $resultDetail[0]['address'] ?></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mt-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Transaksi Detail</h5>
                                                        </div>
                                                        <div class="card-Body">
                                                            <table class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>kategori Product</th>
                                                                        <th>Nama Product</th>
                                                                        <th>Qty</th>
                                                                        <th>Harga Satuan</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $no = 1;
                                                                    foreach ($resultDetail as $key => $value) : ?>
                                                                        <tr>
                                                                            <td width="50"> <?php echo $no++ ?></td>
                                                                            <td> <?php echo $value['name_category'] ?></td>
                                                                            <td> <?php echo $value['product_name'] ?></td>
                                                                            <td> <?php echo $value['qty'] ?></td>
                                                                            <td> <?php echo $value['subtotal'] ?></td>
                                                                        </tr>
                                                                    <?php endforeach ?>
                                                                    <tr>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="4">
                                                                            <span>Total Harga</span>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control" value="<?php echo $resultDetail[0]['price'] ?>" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4">
                                                                            <span>Jumlah Pembayaran</span>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control" value="<?php echo $resultDetail[0]['payment'] ?>" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4">
                                                                            <span>Jumlah Kembalian</span>
                                                                        </td>
                                                                        <td>
                                                                            <input type="text" class="form-control" value="<?php echo $resultDetail[0]['refund'] ?>" readonly>
                                                                        </td>
                                                                    </tr>
                                                                    <td colspan="5">
                                                                        <a href="print.php?id=<?php echo $result[0]['order_id'] ?>" class="btn-sm p-2 me-3 btn-success"><i class='bx bx-printer me-2'></i>Cetak Struk</a>
                                                                        <a href="print.php?id=<?php echo $result[0]['order_id'] ?>" class="btn-sm p-2 btn-secondary"><i class='bx bx-home me-2'></i>Home</a>
                                                                    </td>
                                                                </tfoot>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <table class="table table-responsive table-bordered">
                                            <thead>
                                                <tr>
                                                    <td>No.</td>
                                                    <td>No. Invoice</td>
                                                    <td>Nama Pembeli</td>
                                                    <td>Tanggal Pembelian</td>
                                                    <td>status</td>
                                                    <td>detail</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($result as $values): ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $values['order_code']; ?></td>
                                                        <td><?php echo $values['username']; ?></td>
                                                        <td><?php echo $values['order_date']; ?></td>
                                                        <td>
                                                            <a href="?status=<?php echo $values['id'] ?>&cancel=<?php echo $values['status'] ?>" class="text-white"><?php echo changeStatus($values['status']) ?></a>

                                                        </td>
                                                        <td width="150">
                                                            <a href="?detail=<?php echo $values['order_id'] ?>&id=<?php echo $values['id_user'] ?>" class="btn-sm btn-primary bx bx-show"></a>
                                                            <a href="?delete=<?php echo $values['order_id'] ?>" onclick=" return confirm('Hapus Ini ?')" class="btn-sm btn-danger bx bx-trash mx-2"></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            </tbody>
                                        </table>
                                    <?php endif ?>
                                </div>
                            </div>

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
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-responsive table-bordered">
                        <tbody>
                            <?php foreach ($filteredData  as $row): ?>
                                <tr>
                                    <td><?php echo $row['order_id']; ?></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>