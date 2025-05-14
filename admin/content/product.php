<?php
include '../database/koneksi.php';
include '../layout/encryp.php';
session_start();

if (isset($_POST['simpan'])) {
    $id = $_POST['id_category'];
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
            $queryAddProduct = mysqli_query($koneksi, "INSERT INTO product (id_category,product_name,description,price,stock,image) VALUES ('$id','$namaProduk','$deskripsi','$price','$stok','$foto')");
        }
    } else {
        $queryAddProduct = mysqli_query($koneksi, " INSERT INTO product (id_category,product_name,description,price,stock) VALUES ('$id','$namaProduk','$deskripsi','$price','$stok')");
    }

    header('location: product.php?add=success');
    exit();
}


$id  = isset($_GET['edit']) ? decryptId($_GET['edit'], $key) : '';
$queryEdit = mysqli_query($koneksi, "SELECT category.name_category, product.* FROM product LEFT JOIN category ON product.id_category = category.id WHERE product.id ='$id'");
$rowEdit   = mysqli_fetch_assoc($queryEdit);


// jika button edit di klik

if (isset($_POST['edit'])) {
    $idCategory = $_POST['id_category'];
    $namaProduk = $_POST['nama_product'];
    $deskripsi = $_POST['deskripsi'];
    $price = $_POST['price'];
    $stok = $_POST['stock'];

    // $foto = $rowEdit['image'];
    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto']['name'];
        $ext = array('PNG', 'JPEG', 'jpg', 'png', 'jpeg', 'jpg');
        $extpath = pathinfo($foto, PATHINFO_EXTENSION);

        if (!in_array($extpath, $ext)) {
            echo "Format file gambar yang diperbolehkan hanya PNG, JPEG, atau JPG.";
            die();
        } else {
            unlink(filename: '../upload/' . $rowEdit['foto']);
            move_uploaded_file($_FILES['foto']['tmp_name'], to: '../upload/' . $foto);

            $update = $koneksi->prepare("UPDATE product SET
            id_category=?,
            product_name=?,
            description=?,
            price=?,
            image=?,
            stock=?
            WHERE id=?");
            $update->bind_param("issiisi", $idCategory, $namaProduk, $deskripsi, $price, $foto, $stok, $id);
        }
    } else {
        $update = $koneksi->prepare("UPDATE product SET
        id_category=?,
        product_name=?,
        description=?,
        price=?,
        stock=?
        WHERE id=?");
        $update->bind_param("issiis", $idCategory, $namaProduk, $deskripsi, $price, $stok, $id);
    }
    if ($update->execute()) {
        header("location: product.php?replace=success");
    }
}


// jika parameternya ada ?delete=nilai param
if (isset($_GET['delete'])) {
    $id = decryptId($_GET['delete'], $key);

    $delete = mysqli_query($koneksi, "DELETE FROM product  WHERE id ='$id'");
    header("location:product.php?hapus=berhasil");
}

// ambil data dari category dan product 
$selectCategory = mysqli_query($koneksi, "SELECT category.name_category, product.* FROM product LEFT JOIN category ON product.id_category = category.id ");
$insertCategory = mysqli_query($koneksi, "SELECT * FROM category")
?>
<!DOCTYPE html>

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
                            <?php if (isset($_GET['edit']) || isset($_GET['tambah']) || isset($_GET['detail'])) : ?>
                                <!-- Tambah & Edit Barang -->
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <a><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Kategori Barang</a>
                                            <a href="javascript:window.history.back();" class="btn btn-sm btn-secondary">kembali</a>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <?php if (isset($_GET['hapus'])): ?>
                                                <div class="alert alert-success" role="alert">
                                                    Data berhasil dihapus
                                                </div>
                                            <?php endif ?>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label for="" class="form-label">Pilih Kategori</label>
                                                        <select name="id_category" id="kategori" class="form-control" <?php echo isset($_GET['detail']) ? 'disabled' : '' ?>>
                                                            <option value="" <?php echo isset($_GET['detail']) ? 'disabled' : '' ?>><?php echo isset($_GET['edit']) ? $rowEdit['name_category'] : '--Pilih Kategori--' ?></option>
                                                            <?php while ($rowCategory = mysqli_fetch_assoc($insertCategory)) {
                                                                $select = isset($_GET['edit']) && $rowCategory['id'] == $rowEdit['id_category'] ? 'selected' : '' ?>
                                                                <option value="<?php echo $rowCategory['id'] ?>" <?php echo $select; ?>> <?php echo $rowCategory['name_category'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="" class="form-label">Nama Produk</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            name="nama_product"
                                                            placeholder="Masukkan nama barang"
                                                            required
                                                            value="<?php echo isset($_GET['edit']) ? $rowEdit['product_name'] : '' ?>" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <div class="col-sm-6">
                                                        <label for="" class="form-label">Deskripsi Produk</label>
                                                        <textarea
                                                            class="form-control"
                                                            name="deskripsi"
                                                            placeholder="Masukkan deskripsi barang" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>><?php echo isset($_GET['edit']) ? $rowEdit['description'] : '' ?>
                                                        </textarea>

                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="" class="form-label">Harga Product</label>
                                                        <input type="number"
                                                            class="form-control"
                                                            name="price"
                                                            placeholder="Masukkan harga barang"
                                                            required
                                                            value="<?php echo isset($_GET['edit']) ? $rowEdit['price'] : '' ?>" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>>
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
                                                    <div class="col-sm-6">
                                                        <label for="" class="form-label">Stok Produk</label>
                                                        <input type="number"
                                                            class="form-control"
                                                            name="stock"
                                                            placeholder="Masukkan stock barang"
                                                            required
                                                            value="<?php echo isset($_GET['edit']) ? $rowEdit['stock'] : '' ?>" <?php echo isset($_GET['detail']) ? 'readonly' : '' ?>>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <?php if (!isset($_GET['detail'])) : ?>
                                                        <button class="btn btn-sm btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">
                                                            Simpan
                                                        </button>
                                                    <?php endif ?>
                                                    <?php if (isset($_GET['detail'])) : ?>
                                                        <a href="../content/product.php" class="btn-sm btn-secondary">Kembali</a>
                                                    <?php endif ?>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <!-- Tampilkan data product -->
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header border-bottom">Kategori Coffee</div>
                                        <div class="card-body">
                                            <?php if (isset($_GET['hapus'])): ?>
                                                <div class="alert alert-success " role="alert">
                                                    Data berhasil Dihapus
                                                </div>
                                            <?php endif ?>
                                            <div align="right" class="mb-3">
                                                <a href="product.php?tambah" class="btn btn-primary mt-2">Tambah</a>
                                            </div>
                                            <table class="table table-bordered text-wrap">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kategori Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Harga Barang</th>
                                                        <th style="width:20rem;">Deskripsi Barang</th>
                                                        <th>Aksi</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    while ($rowProduct = mysqli_fetch_assoc($selectCategory)) {
                                                        $encrypt = encryptId($rowProduct['id'], $key) ?>
                                                        <tr style="text-align:justify;">
                                                            <td><?php echo $no++ ?></td>
                                                            <td><?php echo $rowProduct['name_category'] ?></td>
                                                            <td><?php echo $rowProduct['product_name'] ?></td>
                                                            <td><?php echo 'Rp. ' . number_format($rowProduct['price'], 0, ',', '.') ?></td>
                                                            <td><?php echo $rowProduct['description'] ?></td>
                                                            <td>
                                                                <a href="product.php?edit=<?php echo urldecode($encrypt) ?>&detail=<?php echo urldecode($encrypt) ?>" class="btn-sm btn-primary btn-sm">
                                                                    <span class="tf-icon bx bx-show bx-18px "></span>
                                                                </a>
                                                                <a href="product.php?edit=<?php echo urldecode($encrypt) ?>" class="btn-sm btn-success btn-sm mx-2">
                                                                    <span class="tf-icon bx bx-pencil bx-18px "></span>
                                                                </a>
                                                                <a onclick="return confirm('Apakah anda yakin akan menghapus data ini??')"
                                                                    href="product.php?delete=<?php echo urldecode($encrypt) ?>" class="btn-sm btn-danger btn-sm">
                                                                    <span class="tf-icon bx bx-trash bx-18px "></span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>

                </div>
                <!-- Footer -->
                <?php include '../layout/footer.php' ?>
                <!-- / Footer -->
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