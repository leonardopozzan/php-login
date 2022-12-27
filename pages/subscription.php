<?php
include_once __DIR__ . '/../personal-db/conncection.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}
session_start();
$registered = false;
$first_name = $last_name = $email = $password = "";
if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password'])){
    echo 'sono entrato nel primo if';
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    echo $first_name . " " . $last_name . " " .  $email  . " " .  $password;
    $sqlquery = "INSERT INTO users(first_name,last_name,email,password) VALUES('$first_name', '$last_name', '$email','$password')";
    $conn->query($sqlquery);
    $registered = true;
    
}



include_once __DIR__ . '/../partials/head.php';
?>

<body>
    <div class="container mt-5">
        <?php 
        if($registered){
            if ($conn->query($sqlquery) === TRUE) {
                echo "record inserted successfully";
            } else {
                echo "Error: " . $sqlquery . "<br>" . $conn->error;
            }
        }
        ?>
    
        <form action="subscription.php" method="post">
            <label for="first_name">Nome</label>
            <input type="text" name="first_name" required>

            <label for="last_name">Cognome</label>
            <input type="text" name="last_name" required>

            <label for="email">E-mail</label>
            <input type="text" name="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <button type="submit">Registrati</button>
            <button type="reset">Resetta</button>
        </form>
    </div>

</body>

</html>