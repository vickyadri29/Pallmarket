<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-search</title>
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

    $keyword = $_GET["search"];

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



    <article id="kotak">
        <?php
        include "koneksi.php";
        $barang = mysqli_query($mysqli, "SELECT * FROM barang WHERE nama_barang LIKE '%$keyword%' OR kategori LIKE '%$keyword%' OR username LIKE '%$keyword%'");

        $kosong = mysqli_query($mysqli, "SELECT * FROM barang WHERE nama_barang LIKE '%$keyword%' OR kategori LIKE '%$keyword%' OR username LIKE '%$keyword%'");

        if (empty($keyword)) {
            echo "Keyword kosong";
        } else if (empty(mysqli_fetch_array($kosong))) {
            echo "pencarian tak ditemukan";
        } else {

            while ($hasil = mysqli_fetch_array($barang)) {
        ?>
                <a href="detailproduct.php?id=<?php echo $hasil['id']; ?>">
                    <div id="gallery-result">
                        <center>
                            <div class="crop">
                                <img src="fotobarang/<?php echo $hasil['foto']; ?>">
                            </div>
                        </center>
                        <label class="nama-barang"><?php echo $hasil['nama_barang']; ?></label>
                        <div class="price-category">
                            <label class="price">Rp.<?php echo number_format($hasil['harga']); ?></label>
                            <label class="result-category"><?php echo $hasil['kategori']; ?></label>
                        </div>
                </a>
                </div>
        <?php }
        } ?>
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