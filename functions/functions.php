<?php 
function login($email, $password, $conn)
{
    $md5password = $password;

    $stmt = $conn->prepare("SELECT `id` , `email` , `first_name` FROM `users` WHERE `email` = ? and `password` = ?");
    $stmt->bind_param('ss', $email, $md5password);
    $stmt->execute();
    $result = $stmt->get_result();

    $num_rows = $result->num_rows;

    if ($num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['userId'] = $row['id'];
        $_SESSION['userEmail'] = $row['email'];
        $_SESSION['username'] = $row['first_name'];
        return true;
    } else {
        session_destroy();
        return false;
    }
}

function checkPassword($password){
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        return false;
    }else{
        return true;
    }
}
