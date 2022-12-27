<?php
include_once __DIR__ . '/personal-db/conncection.php';
session_start();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//form accedi
// if ($_SERVER["REQUEST_METHOD"] == "POST")
if(isset($_POST['email'],$_POST['password'])) {
    // $myemail = mysqli_real_escape_string($conn, $_POST['email']);
    // $mypassword = mysqli_real_escape_string($conn, $_POST['password']);

    login($_POST['email'], $_POST['password'], $conn);
}

function login($email, $password, $conn){
    $md5password = $password;

    $stmt = $conn->prepare("SELECT `id` , `email` , `first_name` FROM `users` WHERE `email` = ? and `password` = ?");
    $stmt->bind_param('ss', $email, $md5password);
    $stmt->execute();
    $result = $stmt->get_result();

    $num_rows = $result->num_rows;

    if($num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['userId'] = $row['id'];
        $_SESSION['userEmail'] = $row['email'];
        $_SESSION['username'] = $row['first_name'];
        header("location: pages/welcome.php");
    }else{
        echo "Non sei registrato";
        session_destroy();
    }
}
// Create table query execution
// $sql = "CREATE TABLE users(
//     id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     first_name VARCHAR(30) NOT NULL,
//     last_name VARCHAR(30) NOT NULL,
//     email VARCHAR(70) NOT NULL UNIQUE,
//     password VARCHAR(50) NOT NULL
// )";
// if (mysqli_query($conn, $sql)) {
//     echo  "<script>console.log('Table created successfully')</script>";
// } else {
//     echo "<script>console.log('ERROR: Could not able to execute $sql. " . mysqli_error($link) . "')</script>";
// }

// $sqlquery = "INSERT INTO users(first_name,last_name,email,password) VALUES('John', 'Doe', 'john@example.com','my-password1')";
// if ($conn->query($sqlquery) === TRUE) {
//     echo "record inserted successfully";
// } else {
//     echo "Error: " . $sqlquery . "<br>" . $conn->error;
// }
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel='shortcut icon' href='#'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi' crossorigin='anonymous'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css' integrity='sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==' crossorigin='anonymous' referrerpolicy='no-referrer' />
    <link rel='stylesheet' href='./css/style.css'>
    <script src='https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js'></script>
    <script src='https://unpkg.com/vue@3/dist/vue.global.js'></script>
    <script src='./js/script.js' defer></script>
    <!--font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,700;1,600&display=swap" rel="stylesheet">

    <title>Document</title>
</head>

<body>
    <?php
    $pathimg = "./img/logo_site_ablp-removebg-preview.png";
    include_once __DIR__ . '/partials/header.php';
    ?>
    <main class="main-index text-yellow">
        <div class="container d-flex  align-items-center mt-5 ">
            <div class="col-6 text-center">
                <img src="<?php echo $pathimg ?>" alt="">
            </div>
            <div class="col-6 ">
                <form action="index.php" method="post">
                    <div>
                        <label for="email">Email</label>
                        <br>
                        <input type="text" class="input-text" name="email" id="email">
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <br>
                        <input type="text" name="password" id="password">
                    </div>
                    <button class="mt-5" type="submit">Accedi</button>
                </form>
                <a class="my-btn" href="./pages/subscription.php">Registrati</a>
            </div>
        </div>
    </main>

</body>

</html>