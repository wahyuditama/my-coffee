<?php
include '../database/koneksi.php';
include '../layout/encryp.php';
session_start();

if (isset($_POST['simpan'])) {
    $namaProduk = $_POST['nama_product'];
    $deskripsi = $_POST['deskripsi'];
    $price = $_POST['price'];
    $stok = $_POST['stock'];

    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $sizefoto = $_FILES['foto']['size'];

        $ext = array('PNG', 'JPEG', 'JPG');
        $extfoto = pathinfo($foto, PATHINFO_EXTENSION);

        if (!in_array(strtoupper($extfoto), $ext)) {
            echo "Ekstensi tidak valid. Hanya PNG, JPEG, dan JPG yang diperbolehkan.";
            die();
        } else {
            move_uploaded_file($_FILES['foto']['tmp_name'], '../upload/' . $foto);
            $queryBrand = mysqli_query($koneksi, "INSERT INTO brand (product_name,description,price,stock,image) VALUES ('$namaProduk','$deskripsi','$price','$stok','$foto')");
        }
    } else {
        $queryBrand = mysqli_query($koneksi, " INSERT INTO brand (product_name,description,price,stock) VALUES ('$namaProduk','$deskripsi','$price','$stok')");
    }

    header('location: brand.php?add=success');
    exit();
}


$id  = isset($_GET['edit']) ? decryptId($_GET['edit'], $key) : '';
$queryEdit = mysqli_query($koneksi, "SELECT * FROM brand WHERE id='$id'");
$rowEdit   = mysqli_fetch_assoc($queryEdit);


// jika button edit di klik

if (isset($_POST['edit'])) {
    $namaProduk = $_POST['nama_product'];
    $deskripsi = $_POST['deskripsi'];
    $price = $_POST['price'];
    $stok = $_POST['stock'];

    $foto = $rowEdit['image'];
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png'];

        // Validasi ekstensi file
        if (!in_array($ext, $allowed_ext)) {
            $errors[] = "Ekstensi file tidak valid. Hanya JPG, JPEG, dan PNG yang diperbolehkan.";
        } else {
            $upload_dir = '../upload/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $img = uniqid() . '.' . $ext;
            $path_foto = $upload_dir . $img;

            // Upload file
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $path_foto)) {
                $errors[] = "Gagal mengunggah foto : " . $_FILES['foto']['error'];
            }
        }
    }

    $update = mysqli_query($koneksi, "UPDATE brand SET
     product_name='$namaProduk',
     description='$deskripsi',
     price='$price',
     image='$foto',
     stock='$stok'
     WHERE id='$id'");
    header("location:brand.php?change=success");
}

if (isset($_GET['delete'])) {
    $id = decryptId($_GET['delete'], $key);

    $delete = mysqli_query($koneksi, "DELETE FROM brand  WHERE id ='$id'");
    header("location:brand.php?hapus=berhasil");
}

// ambil data brand

$brand = mysqli_query($koneksi, "SELECT * FROM brand ORDER BY id DESC");

$selectBrand = [];
while ($row = mysqli_fetch_assoc($brand)) {
    $selectBrand[] = $row;
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

                    <div class="container-xl flex-grow-1 container-p-y">
                        <div class="card p-3">
                            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Icons /</span> Logo Brand</h4>
                            <?php if ($_SESSION['level_id'] == 1) : ?>
                                <p>
                                    <a href="?tambah" class="btn-sm btn-primary">add-Brand</a>
                                </p>
                            <?php endif ?>
                            <!-- Icon container -->
                            <?php if (isset($_GET['tambah']) || isset($_GET['edit'])) : ?>
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Kategori Barang</div>
                                        <div class="card-body">
                                            <?php if (isset($_GET['hapus'])): ?>
                                                <div class="alert alert-success" role="alert">
                                                    Data berhasil dihapus
                                                </div>
                                            <?php endif ?>
                                            <?php if (isset($_GET['edit']) && !isset($rowEdit['id'])) : ?>
                                                <h5 class="text-danger">Data Tidak Ditemukan</h5>
                                            <?php else : ?>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <div class="mb-3 row">
                                                        <div class="col-sm-6">
                                                            <label for="" class="form-label">Nama Produk</label>
                                                            <input type="text"
                                                                class="form-control"
                                                                name="nama_product"
                                                                placeholder="Masukkan nama barang"
                                                                required
                                                                value="<?php echo isset($_GET['edit']) ? $rowEdit['product_name'] : '' ?>" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="" class="form-label">Deskripsi Produk</label>
                                                            <textarea
                                                                class="form-control"
                                                                name="deskripsi"
                                                                placeholder="Masukkan deskripsi barang" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>><?php echo isset($_GET['edit']) ? $rowEdit['description'] : '' ?>
                                                        </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <div class="col-sm-6">
                                                            <label for="" class="form-label">Harga Product</label>
                                                            <input type="number"
                                                                class="form-control"
                                                                name="price"
                                                                placeholder="Masukkan harga barang"
                                                                value="<?php echo isset($_GET['edit']) ? $rowEdit['price'] : '' ?>" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="" class="form-label">Stok Produk</label>
                                                            <input type="number"
                                                                class="form-control"
                                                                name="stock"
                                                                placeholder="Masukkan stock barang"
                                                                value="<?php echo isset($_GET['edit']) ? $rowEdit['stock'] : '' ?>" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row">
                                                        <div class="col-sm-6">
                                                            <?php if (!isset($_GET['detail'])) : ?>
                                                                <label for="" class="form-label">Masukkan Foto Produk</label>
                                                                <input type="file"
                                                                    class="form-control"
                                                                    name="foto"
                                                                    placeholder="Masukkan foto barang"
                                                                    value="<?php echo isset($_GET['edit']) ? $rowEdit['image'] : '' ?>">
                                                            <?php endif ?>
                                                            <?php if (isset($_GET['edit'])) : ?>
                                                                <label for=""><?php echo isset($_GET['detail']) ? 'Foto Produk' : '' ?></label><br />
                                                                <img src="../upload/<?php echo $rowEdit['image'] ?>" width="100" height="auto" class="mt-2" alt="">
                                                            <?php endif ?>
                                                        </div>
                                                    </div>
                                                    <div class="my-3">
                                                        <?php if (!isset($_GET['detail'])) : ?>
                                                            <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">
                                                                Simpan
                                                            </button>
                                                        <?php endif ?>
                                                        <?php if (isset($_GET['detail'])) : ?>
                                                            <a href="../content/brand.php" class="btn-sm btn-secondary">Kembali</a>
                                                        <?php endif ?>
                                                    </div>
                                                </form>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="d-flex flex-wrap justify-content-center" id="icons-container">
                                    <?php foreach ($selectBrand as $rowBrand) : $encrypt = encryptId($rowBrand['id'], $key) ?>
                                        <div class="card icon-card cursor-pointer text-center mb-4 m-3 shadow-sm bg-body-tertiary rounded">
                                            <div class="card-body">
                                                <i class="bx bxl-adobe mb-2"></i>
                                                <p class="icon-name text-capitalize text-truncate mb-3"><?php echo $rowBrand['product_name'] ?></p>
                                                <button type="button" class="btn-sm btn-outline-primary border-top" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $rowBrand['id'] ?>">
                                                    Lihat selengkapnya
                                                </button>
                                            </div>
                                            <?php if ($_SESSION['user_id'] == 1): ?>
                                                <div class="card-title border-top pt-3">
                                                    <a href="brand.php?edit=<?php echo urlencode($encrypt) ?>" class="btn-sm btn-success">
                                                        <span class="tf-icon bx bx-pencil bx-18px "></span>
                                                    </a>
                                                    <a onclick="return confirm('Apakah anda yakin akan menghapus data ini??')"
                                                        href="brand.php?delete=<?php echo urlencode($encrypt) ?>" class="btn-sm btn-danger mx-2">
                                                        <span class="tf-icon bx bx-trash bx-18px "></span>
                                                    </a>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            <?php endif ?>
                        </div>

                    </div>
                    <!-- / Content -->

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
            href="#"
            class="btn btn-buy-now-new text-white">Welcome to MY-Coffee</a>
    </div>
    <!-- modal -->
    <?php foreach ($selectBrand as $key) : ?>
        <div class="modal fade" id="exampleModal<?php echo $key['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $key['product_name'] ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $key['description'] ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>


    <?php include '../layout/js.php' ?>
</body>

</html>