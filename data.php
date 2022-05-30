<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
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

    $sql = mysqli_query($mysqli, "SELECT * FROM barang where username = '$nama'");
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
        <article id="add-item">
            <a href="./add-data.php"><input type="submit" name="addbarang" value="Tambah Barang" class="btn-add-item"></a>
        </article>
        <article class="data">
            <table border=2 class="tabledata">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th width="200px">Nama barang</th>
                    <th>Kategori</th>
                    <th width="150px">Kondisi</th>
                    <th width="120px">Harga</th>
                    <th width="300px">Deskripsi</th>
                    <th width="200px">Action</th>
                </tr>
                <?php
                $no = 1;
                while ($hasil = mysqli_fetch_assoc($sql)) {
                    $id = $hasil['id'];
                    $tambah = $no++;
                ?>
                    <td class="td-center"><?= $tambah; ?></td>
                    <td class="td-center"><img src="fotobarang/<?= $hasil['foto']; ?>" width="150"></td>
                    <td><?= $hasil['nama_barang']; ?></td>
                    <td><?= $hasil['kategori']; ?></td>
                    <td><?= $hasil['kondisi']; ?></td>
                    <td>Rp.<?php echo number_format($hasil['harga']); ?></td>
                    <td width="300"><?= $hasil['deskripsi']; ?></td>
                    <div class="btn-action">
                        <td class="td-center">
                            <a href="./edit-data.php?id=<?= $id; ?>"><input type="submit" name="edit" value="Edit" class="btn-edit"></a>
                            <a href="#" onclick='delete_data(<?= $id; ?>)'><input type="submit" name="delete" value="Hapus" class="btn-delete"></a>
                        </td>
                    </div>
                    </tr>
                    </div>
                <?php } ?>
            </table>
        </article>
    </main>
</body>
<script>
    function delete_data(id) {
        var answer = confirm("Are you sure?");
        if (answer) { //user clicked ok
            window.location = "delete-data.php?id=" + id;
        }
    }
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

</html>