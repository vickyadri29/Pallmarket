<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        <article id="banner">
            <div class="slider">
                <div class="slides">
                    <input type="radio" name="radio-btn" id="radio1">
                    <input type="radio" name="radio-btn" id="radio2">

                    <div class="slide first">
                        <img src="banner/1.jpg">
                    </div>
                    <div class="slide">
                        <img src="banner/2.jpg">
                    </div>

                    <div class="navigation-auto">
                        <div class="auto-btn1"></div>
                        <div class="auto-btn2"></div>
                    </div>

                </div>
                <div class="navigation-manual">
                    <label for="radio1" class="manual-btn"></label>
                    <label for="radio2" class="manual-btn"></label>
                </div>
            </div>
        </article>

        <article id="category">
            <h3>Kategori</h3>
            <div id="category-types">
                <a href="dashboard-search.php?search=elektronik">
                    <div class="card-category">
                        <img src="icon/electronic.png" width="70px">
                        <label>Elektronik</label>
                    </div>
                </a>

                <a href="dashboard-search.php?search=makanan">
                    <div class="card-category">
                        <img src="icon/food.png" width="70px">
                        <label>Makanan</label>
                    </div>
                </a>

                <a href="dashboard-search.php?search=pakaian">
                    <div class="card-category">
                        <img src="icon/fashion.png" width="70px">
                        <label>Fashion</label>
                    </div>
                </a>

                <a href="dashboard-search.php?search=game">
                    <div class="card-category">
                        <img src="icon/game.png" width="70px">
                        <label>Game</label>
                    </div>
                </a>

                <a href="dashboard-search.php?search=kosmetik">
                    <div class="card-category">
                        <img src="icon/cosmetic.png" width="70px">
                        <label>Kosmetik</label>
                    </div>
                </a>

                <a href="dashboard-search.php?search=gadget">
                    <div class="card-category">
                        <img src="icon/gadget.png" width="70px">
                        <label>Gadget</label>
                    </div>
                </a>

                <a href="dashboard-search.php?search=furnitur">
                    <div class="card-category">
                        <img src="icon/furniture.png" width="70px">
                        <label>Furnitur</label>
                    </div>
                </a>

                <a href="dashboard-search.php?search=olahraga">
                    <div class="card-category">
                        <img src="icon/instrument.png" width="70px">
                        <label>Olahraga</label>
                    </div>
                </a>

                <a href="dashboard-search.php?search=alat masak">
                    <div class="card-category">
                        <img src="icon/kitchen.png" width="70px">
                        <label>Alat Masak</label>
                    </div>
                </a>

                <a href="dashboard-search.php?search=lainnya">
                    <div class="card-category">
                        <img src="icon/more.png" width="70px">
                        <label>Lainnya</label>
                    </div>
                </a>
            </div>
        </article>

        <article id="kotak">
            <?php
            include "koneksi.php";
            $barang = mysqli_query($mysqli, "SELECT * FROM barang");

            while ($hasil = mysqli_fetch_array($barang)) {
            ?>
                <a href="detailproduct.php?id=<?php echo $hasil['id']; ?>">
                    <div id="gallery-result">
                        <center>
                            <div class="crop">
                                <img src="fotobarang/<?php echo $hasil['foto']; ?>">
                            </div>
                        </center>
                        <div class="price-category">
                            <label class="nama-barang"><?php echo $hasil['nama_barang']; ?></label>
                            <label class="result-category"><?php echo $hasil['kategori']; ?></label>
                            <label class="price"><span>Rp </span><?php echo number_format($hasil['harga']); ?></label>
                        </div>
                </a>
                </div>
            <?php } ?>
        </article>
    </main>
    <script type="text/javascript">
        var counter = 1;
        setInterval(function() {
            document.getElementById('radio' + counter).checked = true;
            counter++;
            if (counter > 2) {
                counter = 1;
            }
        }, 5000);
    </script>

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