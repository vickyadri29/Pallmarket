<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRATION</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="content-background">
    <?php
        $user = $email = $whatsapp = $password = $confirm = $message = "";
        
        //If there is any user action
        $action = isset($_POST['action']) ? $_POST['action'] : "";

        if($action == 'regis'){  //the user submitted the form
            //include database connection
            include 'koneksi.php';

            $user = $_POST['username'];
            $email =$_POST['email'];
            $whatsapp = $_POST['whatsapp'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];
            
            if(empty($user)||empty($email)||empty($whatsapp)||empty($password)||empty($confirm)){
                $message = "kasih lengkap";
            }
            else if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($user))){
                $message = "Username hanya bisa berupa huruf, angka dan underscore";
            }
            else if(!ctype_digit($whatsapp)){
                $message = "No HP harus berupa angka";
            }
            else if(strlen($password) < 8){
                $message = "Panjang password minimal 8 karakter";
            }
            else if($confirm != $password){
                $message = "Password yang dimasukan tidak sama";
            }
            else{
                //our insert query
                $query =    "insert into user set 
                username = '".$user."',
                email = '".$email."',
                whatsapp = '".$whatsapp."',
                password = '".$password."'";

                //execute the query
                if($mysqli->query($query)){
                    //if saving success
                    echo    "<script>
                            alert('berhasil membuat akun');
                            window.location = 'login.php';
                            </script>";
                }
                else{
                    //if unable to create record
                    $message = "Gagal menambahkan data";
                }

                //close database connection
                $mysqli->close();
            }
            
        }
        
    ?>
    <header>
        <h2>Pall<span>market</span></h2>
    </header>

    <main id="form-register">
    <div id="card-register">
        <h1>Buat Akun</h1>
        <form action="#" method="POST">
                <label>Username</label><br>
                <input type="text" name="username" placeholder="Masukan Username" value="<?php echo $user; ?>"><br>
                <label>Email</label><br>
                <input type="email" name="email" placeholder="Masukan Email" value="<?php echo $email; ?>"><br>
                <label>WhatsApp</label><br>
                <input type="tel" name="whatsapp" placeholder="Contoh : 82393012995" value="<?php echo $whatsapp; ?>">
                <div class="pass"><br>
                    <div class="pass-register">
                        <label>Password</label><br>
                        <input type="password" name="password" placeholder="Masukan Password" value="<?php echo $password; ?>">
                    </div>
                    <div>
                        <label>Konfirmasi Password</label>
                        <input type="password" name="confirm" placeholder="Masukan Kembali Password" value="<?php echo $confirm; ?>">
                    </div>
                </div>

                <span><?php echo $message; ?></span>

                <div class="btn-register">
                    <input type="hidden" name="action" value="regis" />
                    <a href="#"><input type="submit" value="Daftar" /></a>
                </div>
        </form>        
    </div>
    </main>
    </div>
</body>
</html>