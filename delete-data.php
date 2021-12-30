<?php

include "koneksi.php";

$id = $_GET['id'];
$sql = mysqli_query($mysqli, "DELETE FROM barang WHERE id ='$id'");
$mysqli->query($sql);

header("location: data.php");
?>