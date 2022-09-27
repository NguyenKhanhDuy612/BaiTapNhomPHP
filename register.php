<?php
session_start();
require_once("config/connect.php");
require_once("function/global.php");
//sleep(1);
$taiKhoan = $_POST['username'] ?? '';
$matKhau = $_POST['password'] ?? '';
$email = $_POST['email'] ?? '';
$tenKH = $_POST['tenKH'] ?? '';
$ngaySinh = $_POST['ngaySinh'] ?? '';
$gioiTinh = $_POST['gioiTinh'] ?? '';
$diaChi = $_POST['diaChi'] ?? '';
$cmnd = $_POST['cmnd'] ?? '';
$soDienThoai = $_POST['soDienThoai'] ?? '';

// kiểm tra tài khoản và mật khẩu
function checkTaiKhoan(string $username)
{
    $pattern = "/[a-zA-Z0-9]{8,}$/";
    return preg_match($pattern, $username);
}

// kiểm tra cmnd và số điện thoại
function validateNumber(string $number){
    $pattern = "/[0-9]{9,12}$/";
    return preg_match($pattern, $number);
}

// kiểm tra ngày sinh
function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    /* VỪA KIỂM TRA BÊN MÁY KHÁCH VỪA KIỂM TRA BÊN MÁY CHỦ */

    $taiKhoan = trim(strtolower($taiKhoan));
    $tenKH = trim($tenKH);
    $diaChi = trim($diaChi);
    $cmnd = trim($cmnd);
    $soDienThoai = trim($soDienThoai);

    // kiểm tra xem tài khoản và email có bị trùng không
    $user_check_query = "SELECT * FROM tai_khoan WHERE username = ? OR email = ?  LIMIT 1";
    $stmt = $conn->prepare($user_check_query);
    $stmt->bind_param("ss", $taiKhoan, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        exit("duplicate email"); // YES
    }
    // nếu không bị trùng thì thực hiện validate các input
    else {
        if (!checkTaiKhoan($taiKhoan)) {
            exit("false");
        }
        if (!checkTaiKhoan($matKhau)) {
            exit("false");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            exit("false");
        }
        if (!validateDate($ngaySinh, 'Y-m-d')) {
            exit("false");
        }
        if ($diaChi == '') {
            exit("false");
        }
        if (!validateNumber($cmnd)) {
            exit("false");
        }
        if (!validateNumber($soDienThoai)) {
            exit("false");
        }

        // Sau khi thỏa hết tất cả điều kiện ở trên thì tiến hành tạo tài khoản
        $matKhau = password_hash($matKhau, PASSWORD_DEFAULT);
        // đăng ký thì tự động làm khách hàng
        // muốn làm nhân viên thì admin sẽ tạo tài khoản riêng (form đăng ký riêng)
        $query = "INSERT INTO tai_khoan (username, password, ma_quyen, email) VALUES (?, ?, 'user', ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $taiKhoan, $matKhau, $email);
        $stmt->execute();
        // Nếu tạo tài khoản thành công
        if ($conn->affected_rows == 1) {
            // Tìm user_id từ tài khoản vừa tạo
            $query = "SELECT * FROM tai_khoan WHERE username = '$taiKhoan'  LIMIT 1";
            $result = $conn->query($query);
            $user_id = $result->fetch_assoc()['user_id'];

            // Lấy mã tiếp theo cho khách hàng
            $query = "SELECT ma_kh FROM khach_hang ORDER BY ma_kh DESC LIMIT 1";
            $result = mysqli_query($conn, $query);
            $maKH = getNextID($result, 'ma_kh', 'KH', 7);

            // Thêm khách hàng
            $query = "INSERT INTO khach_hang VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssisssi", $maKH, $tenKH, $ngaySinh, $gioiTinh, $diaChi, $cmnd, $soDienThoai, $user_id);
            $stmt->execute();

            // Nếu tạo khách hàng thành công
            if ($conn->affected_rows == 1) {
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['name'] = $tenKH;
                $_SESSION['role'] = 'user';
                $_SESSION['user_id'] = $user_id;
                exit("true");
            } else {
                exit("error");
            }
        }
    }
    mysqli_close($conn);
}
