<?php
include_once __DIR__ . '/../personal-db/conncection.php';
// Controllo connsessione con data-base
if ($conn->connect_error) {
    die("<script>console.log('Connection failed: " . $conn->connect_error . "')</script>");
}
session_start();

//variabili che controlla che l'utente abbia eseguito la registrazione correttamente
$registered = false;
$errorMessage = false;

$first_name = $last_name = $email = $password = "";

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = strlen($first_name) >= 3 && strlen($first_name) <= 25 && preg_match("/^[a-zA-Z-' ]*$/",$first_name);
    if($check){
        $check = strlen($last_name) >= 3 && strlen($last_name) <= 25 && preg_match("/^[a-zA-Z-' ]*$/",$last_name);
        if($check){
            $check = strlen($email) <= 60 && filter_var($email, FILTER_VALIDATE_EMAIL);
            if($check){
                $check = checkPassword($password);
            }
        }
    }
    if($check){
        $sqlquery = "INSERT INTO users(first_name,last_name,email,password) VALUES('$first_name', '$last_name', '$email','$password')";
        $saved = $conn->query($sqlquery);
        $registered = true;
    }else{
        $errorMessage = true;
    }
}



include_once __DIR__ . '/../partials/head.php';
?>

<body>
    <?php
    $pathimg = "../img/logo_site_ablp-removebg-preview.png";
    include_once __DIR__ . '/../partials/header.php';
    ?>
    <main class="main-index">

        <div class="container mt-5 ">
            <div class="d-flex align-items-center">

                <div class="col-6">
                    <img src="<?php echo $pathimg  ?>" alt="">

                </div>
                <div class="col-6">

                    <?php
                    if ($registered) {
                        if ($saved) {
                            echo "record inserted successfully";
                        } else {
                            echo "Error: " . $sqlquery . "<br>" . $conn->error;
                        }
                    }
                    ?>

                    <form action="subscription.php" method="post">
                        <div>

                            <label class="text-yellow" for="first_name">Nome</label>
                            <input type="text" name="first_name" required minlength="3" maxlength="25">
                        </div>
                        <div>

                            <label class="text-yellow" for="last_name">Cognome</label>
                            <input type="text" name="last_name" required minlength="3" maxlength="25">
                        </div>
                        <div>

                            <label class="text-yellow" for="email">E-mail</label>
                            <input type="email" name="email" required maxlength="60">
                        </div>
                        <div>

                            <label class="text-yellow" for="password">Password</label>
                            <input type="password" name="password" required minlength="8" maxlength="40">
                        </div>
                        <div>

                            <button type="submit">Registrati</button>
                            <button type="reset">Resetta</button>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </main>

</body>

</html>