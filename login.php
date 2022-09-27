<?php
session_start();
// bỏ bình luận cho cái sleep để xem animation
//sleep(1);
require_once("config/connect.php");
require_once("function/global.php");
if (!isset($_POST['username'], $_POST['password'])) {
    exit("false");
}
if ($stmt = $conn->prepare('SELECT user_id, password, ma_quyen FROM tai_khoan WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $password, $ma_quyen);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has logged-in!
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['role'] = $ma_quyen;
            $_SESSION['user_id'] = $user_id;
            exit("true");
        } else {
            // Incorrect password
            exit("false");
        }
    } else {
        // Incorrect username
        exit("false");
    }
    $stmt->close();
    mysqli_close($conn);
}
