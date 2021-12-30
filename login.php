<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div id="content-background">
<?php 

session_start();
$conn = mysqli_connect("localhost","root","","pallmarket");

$user = $password = $message = "";

if(isset($_POST["login"])){
    $user = $_POST["username"];
    $password = $_POST["password"];

    if(empty($user)||empty($password)){
        $message = "Username atau password kosong";
    }
    else{
        $search = mysqli_query($conn, "SELECT * FROM user WHERE username ='". $_POST["username"] ."'");
        $count = mysqli_num_rows($search);

        if($count == 0)
        {
            $message = "Username tak ditemukan";
        }
        else
        {
            $row = $search->fetch_assoc();
            if($_POST["password"] == $row["password"])
            {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $_POST["username"];
                header("Location: dashboard.php");
            }
            else
            {
                $message = "Maaf, password salah";
            } 
        }
    }
}

?>
    <header>
       <h2>Pall<span>market</ span></h2>
    </header>
    <main id="form-login">
    <div id="card">
        <h1>Selamat Datang</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukan Username" value="<?php echo $user; ?>">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukan Password" value="<?php echo $password; ?>">

            <div class="link-register">
                <p>Belum Punya Akun? <span><a href="./registration.php">Klik Disini!</span></a></p>
            </div>

            <span><?php echo $message;?></span>

            <div class="btn-login">
                <a href="#"><input type="submit" name="login" value="Login"></a>
            </div>
        </form>
    </div>
    </main>
</div>
</body>
</html>