<?php
include_once __DIR__ . '/../partials/head.php';
$pathimg = "../img/logo_site_ablp-removebg-preview.png";
include_once __DIR__ . '/../partials/header.php';
session_start();
?>

<body>
    <div class="container mt-5">
        <h1 class="ciaociao">Ciao <?php echo $_SESSION['username']  ?> <br> Benvenuto nel nostro sito</h1>
    </div>
</body>

</html>