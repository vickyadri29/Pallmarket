<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div id="content-background">
<?php 

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo    "<script>
            window.location = 'dashboard.php';
            </script>";
}
?>
    <header>
        <h2>Pall<span>market</span></h2>

        <nav>
            <ul>
                <li><a href="about.php">About Us</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="landing-page">
            <article id="content">
                <h1>Welcome to Pallmarket</h1>
                <h2>Temukan produk yang menarik disini</h2>
                <p>Register Now! Free.</p>
                <div class="btn-content">
                    <a href="./registration.php"><input type="submit" name="signup" value="Sign Up" class="btn-signup"></a>
                    <a href="./login.php"><input type="submit" name="login" value="Login" class="btn-login"></a>
                </div>
            </article>
        
            <article id="image-cart">
                <img src="photo/2.png">
            </article>
        </div>
    </main>
    </div>
</body>
</html>