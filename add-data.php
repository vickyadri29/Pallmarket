<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    $nama_barang = $kategori = $kondisi = $foto = $harga = $deskripsi = $message = "";

    include "koneksi.php";

    $sql = mysqli_query($mysqli, "SELECT * FROM barang where username = '$nama'");

    $action = isset($_POST['action']) ? $_POST['action'] : "";
    if ($action == 'tambah') {  //the user submitted the form

        //include database connection
        include 'koneksi.php';

        $nama_barang = $_POST['nama_barang'];
        $kategori = $_POST['kategori'];
        $kondisi = $_POST['kondisi'];
        $foto = $_FILES['foto']['size'];
        $harga = $_POST['harga'];
        $deskripsi = $_POST['deskripsi'];

        if (empty($nama_barang) || empty($harga) || empty($deskripsi)) {
            $message = "Kasih lengkap";
        } else if ($kategori == "pilih kategori") {
            $message = "Kategori barang belum di pilih";
        } else if ($kondisi == "pilih Kondisi barang") {
            $message = "Kondisi barang belum di pilih";
        } else if ($foto == 0) {
            $message = "Foto belum di upload";
        } else if (!ctype_digit($harga)) {
            $message = "Harga harus berupa angka";
        } else {
            $folder = "./fotobarang/";
            $name = $_FILES['foto']['name'];
            $rename = date('dHis') . $name;
            $sumber = $_FILES['foto']['tmp_name'];
            move_uploaded_file($sumber, $folder . $rename);

            //our insert query
            $query =    "insert into barang set 
                        username = '" . $nama . "',
                        nama_barang = '" . $nama_barang . "',
                        kategori = '" . $kategori . "',
                        kondisi = '" . $kondisi . "',
                        foto = '" . $rename . "',
                        harga = '" . $harga . "',
                        deskripsi = '" . $deskripsi . "'";

            //execute the query
            if ($mysqli->query($query)) {
                //if saving success
                $message = "Berhasil menambah data";
            } else {
                //if unable to create record
                $message = "Gagal menambahkan data";
            }

            //close database connection
            $mysqli->close();
        }
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
        <div id="input">
            <h2>JUAL BARANG</h2>
            <div id="penginputan">
                <form method="POST" enctype="multipart/form-data" class="inputdata">
                    <table>
                        <tr>
                            <td>Nama Barang</td>
                            <td>:   </td>
                            <td><input type="text" name="nama_barang" placeholder="Masukan Nama Barang" value="<?php echo $nama_barang; ?>"></td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>:   </td>
                            <td><select name="kategori">
                                    <option value="pilih kategori" <?php if ($kategori == '') echo ' selected="selected"'; ?>disabled selected hidden>Pilih Kategori</option>
                                    <option value="elektronik" <?php if ($kategori == 'elektronik') echo ' selected="selected"'; ?>>Elektronik</option>
                                    <option value="gadget" <?php if ($kategori == 'gadget') echo ' selected="selected"'; ?>>Gadget</option>
                                    <option value="furnitur" <?php if ($kategori == 'furnitur') echo ' selected="selected"'; ?>>Furnitur</option>
                                    <option value="pakaian" <?php if ($kategori == 'pakaian') echo ' selected="selected"'; ?>>Pakaian</option>
                                    <option value="game" <?php if ($kategori == 'game') echo ' selected="selected"'; ?>>Game</option>
                                    <option value="makanan" <?php if ($kategori == 'makanan') echo ' selected="selected"'; ?>>Makanan</option>
                                    <option value="kosmetik" <?php if ($kategori == 'kosmetik') echo ' selected="selected"'; ?>>Kosmetik</option>
                                    <option value="alat masak" <?php if ($kategori == 'alat masak') echo ' selected="selected"'; ?>>Alat Masak</option>
                                    <option value="olahraga" <?php if ($kategori == 'olahraga') echo ' selected="selected"'; ?>>Olahraga</option>
                                    <option value="lainnya" <?php if ($kategori == 'lainnya') echo ' selected="selected"'; ?>>Lainnya</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Kondisi</td>
                            <td>:   </td>
                            <td><select name="kondisi">
                                    <option value="pilih kondisi barang" <?php if ($kondisi == '') echo ' selected="selected"'; ?>disabled selected hidden>Pilih Kondisi Barang</option>
                                    <option value="baru" <?php if ($kondisi == 'baru') echo ' selected="selected"'; ?>>Baru</option>
                                    <option value="like-new" <?php if ($kondisi == 'like-new') echo ' selected="selected"'; ?>>Bekas - Seperti Baru</option>
                                    <option value="second" <?php if ($kondisi == 'second') echo ' selected="selected"'; ?>>Bekas</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Foto</td>
                            <td>:   </td>
                            <td><input type="file" name="foto"></td>
                        </tr>
                        <tr>
                        <tr>
                            <td>Harga</td>
                            <td>:   </td>
                            <td><input type="text" name="harga" value="<?php echo $harga; ?>"></td>
                        </tr>
                    </table>
                    <td><textarea name="deskripsi" cols="5" rows="10" placeholder="Deskripsi"><?php echo $deskripsi; ?></textarea></td>
                    </tr><br>
                    <span><?php echo $message; ?></span>
                    <div class="btn">
                        <tr>
                            <td>
                                <input type="hidden" name="action" value="tambah" />
                                <a href="#"><input type="submit" value="Posting" /></a>
                                <a href="./data.php"><input type="button" value="Kembali" /></a>
                            </td>
                        </tr>
                </form>
            </div>
            <div class="img-data">
                <img src="icon/add-data.png">
            </div>
        </div>
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