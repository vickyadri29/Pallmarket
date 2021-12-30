<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/b8eff5c106.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    session_start();
    $nama = $_SESSION['username'];
    $welcome = "Welcome, " . $nama;

    if (empty($_SESSION['loggedin'])) {
        header("location: not-login.php");
    }

    include "koneksi.php";
    $id    = $_GET['id'];
    $sql1 = mysqli_query($mysqli, "SELECT * FROM barang where id='$id'");
    $hasil = mysqli_fetch_assoc($sql1);

    $penjual = $hasil['username'];

    $sql2 = mysqli_query($mysqli, "SELECT * FROM user where username='$penjual'");
    $nomor = mysqli_fetch_assoc($sql2);
    ?>

    <header id="dashboard">
        <a href="dashboard.php">
            <h3>Pall<span class="span-home">market</span></h3>
        </a>
        <div id="nav-icon">
            <a href="#category"><i class="fas fa-th-large icon-category"></i></a>
            <form action="dashboard-search.php">
                <input type="search" id="search" name="search" placeholder="Cari Barang">
            </form>
            <i class="fas fa-search icon-search"></i>
            <a href="#kotak"><i class="fas fa-store icon-marketplace"></i></a>
        </div>
        <div class="dropdown">
            <div class="welcome">
                <p class="welcome-username"><?php echo $welcome; ?></p>
                <i class="fas fa-user-circle icon-profile"></i>
            </div>
            <div class="dropdown-child">
                <a href="data.php">Profile</a>
                <a href="#" onclick="logout()">Logout</a>
            </div>
        </div>
    </header>
    <main>
        <article id="detail-product">
            <div class="photo-detail">
                <img src="fotobarang/<?php echo $hasil['foto']; ?>" alt="...">
            </div>
            <div class="detail">
                <h1><?php echo $hasil['nama_barang']; ?></h1>
                <div class="price-kondisi">
                    <label class="price">Rp.<?php echo number_format($hasil['harga']); ?></label>
                    <?php echo $hasil['kategori'] . "&nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp" . $hasil['kondisi']; ?>
                </div>
                <p class="deskripsi"><?php echo $hasil['deskripsi']; ?></p>
                <div class="button-detail">
                    <a href="https://api.whatsapp.com/send/?phone=62<?= $nomor['whatsapp']; ?>"><input type="submit" name="pesan" value="Pesan" class="btn-order"></a>
                    <a href="./dashboard.php"><input type="submit" name="" value="Kembali" class="btn-back"></a>
                </div>
        </article>
    </main>

    <script>
        function logout() {
            var answer = confirm("Are you sure want to logout?");

            if (answer) { //user clicked ok
                //redirect to url with action as delete and id of the record to be deleted
                window.location = "logout.php";
            }
        }
    </script>
</body>

</html>