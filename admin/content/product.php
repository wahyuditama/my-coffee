<?php
include '../database/koneksi.php';
session_start();

// jika button simpan di tekan
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


$id  = isset($_GET['edit']) ? $_GET['edit'] : '';
$queryEdit = mysqli_query($koneksi, "SELECT category.name_category, product.* FROM product LEFT JOIN category ON product.id_category = category.id WHERE product.id ='$id'");
$rowEdit   = mysqli_fetch_assoc($queryEdit);


// jika button edit di klik

if (isset($_POST['edit'])) {
    $id = $_POST['id_category'];
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

    $update = mysqli_query($koneksi, "UPDATE product SET
     id_category='$id',
     product_name='$namaProduk',
     description='$deskripsi',
     price='$price',
     image='$foto',
     stock='$stok'
     WHERE id='$id'");
    header("location:product.php?change=success");
}


// jika parameternya ada ?delete=nilai param
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; //mengambil nilai params

    // query / perintah hapus
    $delete = mysqli_query($koneksi, "DELETE FROM product  WHERE id ='$id'");
    header("location:category.php?hapus=berhasil");
}

// ambil data dari category dan product untuk tampilan depan
$selectCategory = mysqli_query($koneksi, "SELECT category.name_category, product.* FROM product LEFT JOIN category ON product.id_category = category.id ");
//ambil data dari category untuk di tambah kategori
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
                                        <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Kategori Barang</div>
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
                                                        <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">
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
                                <!-- Tampilkan data level -->
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header border-bottom">Kategori Coffee</div>
                                        <div class="card-body">
                                            <?php if (isset($_GET['hapus'])): ?>
                                                <div class="alert alert-success" role="alert">

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
                                                        <th style="width:30rem;">Deskripsi Barang</th>
                                                        <th>Aksi</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    while ($rowProduct = mysqli_fetch_assoc($selectCategory)) { ?>
                                                        <tr>
                                                            <td><?php echo $no++ ?></td>
                                                            <td><?php echo $rowProduct['name_category'] ?></td>
                                                            <td><?php echo $rowProduct['product_name'] ?></td>
                                                            <td><?php echo $rowProduct['price'] ?></td>
                                                            <td><?php echo $rowProduct['description'] ?></td>
                                                            <td>
                                                                <a href="product.php?edit=<?php echo $rowProduct['id'] ?>&detail=<?php echo $rowProduct['id'] ?>" class="btn btn-primary btn-sm">
                                                                    <span class="tf-icon bx bx-show bx-18px "></span>
                                                                </a>
                                                                <a href="product.php?edit=<?php echo $rowProduct['id'] ?>" class="btn btn-success btn-sm">
                                                                    <span class="tf-icon bx bx-pencil bx-18px "></span>
                                                                </a>
                                                                <a onclick="return confirm('Apakah anda yakin akan menghapus data ini??')"
                                                                    href="product.php?delete=<?php echo $rowProduct['id'] ?>" class="btn btn-danger btn-sm">
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