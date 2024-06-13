<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FINDING FOOD </title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container">

        <header>
            <img src="images/header.jpg" alt="">
        </header>

        <nav>
            <!-- ul>li*5>a -->
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php?page=order_input">Pemesanan</a></li>
                <li><a href="index.php?page=order_tampil">Daftar Pesanan</a></li>
                <li><a href="index.php?page=kontak">Kontak</a></li>
                <li><a href="index.php?page=about">About</a></li>
            </ul>
        </nav>

        <main>
            <?php 
                if (isset($_GET['page'])) {
                    require $_GET['page'].".php";
                }else {
                    require "main.php";
                }
            ?>
        </main>

        <footer>
                <p></p>
                    <center>Copyright &copy; 2024. KIPY-</center>
                </p>
        </footer>

    </div>
    
</body>
</html>