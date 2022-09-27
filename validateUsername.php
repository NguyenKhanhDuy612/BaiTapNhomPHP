<?php
// kiểm tra xem tài khoản có bị trùng hay không
require_once("config/connect.php");
$username = $_POST['username'] ?? '';
if ($username !== '') {
    $username = strtolower($username);
    $query = "SELECT * FROM tai_khoan WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo 'false';
    } else {
        echo 'true';
    }
    mysqli_close($conn);
}
