<?php
include_once __DIR__ . '/personal-db/conncection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

//form accedi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);
}


//Create table query execution
// $sql = "CREATE TABLE users(
//     id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
//     first_name VARCHAR(30) NOT NULL,
//     last_name VARCHAR(30) NOT NULL,
//     email VARCHAR(70) NOT NULL UNIQUE,
//     password VARCHAR(50) NOT NULL
// )";
// if(mysqli_query($conn, $sql)){
//     echo  "<script>console.log('Table created successfully')</script>";
// } else{
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
    <title>Document</title>
</head>

<body>
    <div class="container mt-5">
        <form>
            <div>
                <label for="email">email</label>
                <input type="text" name="email" id="email">
            </div>
            <div>
                <label for="password">password</label>
                <input type="text" name="password" id="password">
            </div>
            <button type="submit">Accedi</button>
        </form>
        <a href="./pages/subscription.php">Registrati</a>
    </div>
</body>
</html>