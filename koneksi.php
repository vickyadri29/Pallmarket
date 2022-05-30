<?php 

//setting variabel
$host = "localhost";
$username = "root";
$pass = "";
$database = "pallmarket";

//koneksi ke database mysql
$mysqli = new mysqli($host, $username, $pass, $database);

if(mysqli_connect_errno()){
    echo "Koneksi gagal, anda tidak bisa terhubung ke database";
}
