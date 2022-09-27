<?php
ob_start();
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['expire_time']) && (time() - $_SESSION['expire_time'] > 120)){
    session_destroy();
    session_start();
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Web bán trái cây</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/modal.css">
    <link rel="stylesheet" href="/css/global.css">
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="position: sticky; top: 0;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Logo</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Nothing</a>
                </li>
            </ul>
            <form class="d-flex">
                <div class="input-group">
                    <input class="form-control border-end-0 border rounded-pill" type="search" placeholder="Tìm kiếm">
                    <span class="input-group-append">
                        <button class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill my-ms-n" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <ul class="navbar-nav ms-auto">
                <?php
                if (isset($_SESSION['loggedin'])) {
                    if ($_SESSION['role'] !== 'user') {
                ?>
                        <li class="d-grid m-1">
                            <button class="btn btn-outline-warning" id="admin-button" type="button">
                                <i class="fas fa-wrench"></i>Trang quản lý
                            </button>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="d-grid m-1">
                            <button class="btn btn-outline-success" type="">
                                <i class="fas fa-cart-plus"></i> Giỏ hàng
                            </button>
                        </li>
                    <?php
                    }
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo 'Xin chào, ' . $_SESSION['name'] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="/account">Thông tin cá nhân</a></li>
                            <li><a class="dropdown-item" id="logout-button" role="button">Đăng xuất</a></li>
                        </ul>
                    </li>
                <?php
                } else {
                ?>
                    <li class="d-grid m-1">
                        <button id="show-login-modal-button" class="btn btn-outline-success">
                            <i class="fas fa-sign-in-alt"></i> Đăng nhập
                        </button>
                    </li>
                <?php
                }
                ?>

            </ul>
        </div>
    </div>
    </div>

</nav>

<?php if (!isset($_SESSION['loggedin'])) { ?>
    <div id="check-modal">
        <!-- Modal đăng nhập -->
        <div id="login-modal" class="my-modal">
            <span id="close-login" class="close" title="Close Modal">&times;</span>

            <!-- Modal Content -->
            <form name="login-form" class="my-modal-content animate rounded-3" autocomplete="off">
                <div class="container">
                    <h3>Đăng nhập</h3>
                    <hr>
                    <label for=""><b>Tài khoản</b></label>
                    <input type="text" placeholder="Nhập tài khoản" name="username" id="username-login" required>

                    <label for=""><b>Mật khẩu</b></label>
                    <input type="password" placeholder="Nhập mật khẩu" name="password" id="password-login" autocomplete="on" required>
                    <span id="login-error" class="d-flex text-danger"></span>

                    <div class="row">
                        <button type="button" class="btn btn-link col" id="show-register-modal-button">Đăng ký</button>
                        <button type="button" class="btn btn-link col" id="show-forgot-password-modal-button">Quên mật khẩu?</button>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="m-1">
                                <button type="button" id="cancel-button" class="w-100 btn btn-dark">Hủy</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="m-1">
                                <button type="button" id="login-button" class="w-100 btn btn-primary">
                                    <span id="login-status">Đăng nhập</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal đăng ký -->
        <div id="register-modal" class="my-modal">
            <span id="close-register" class="close" title="Close Modal">&times;</span>

            <!-- Modal Content -->
            <form name="register-form" class="my-modal-content animate rounded-3" autocomplete="off">
                <div class="container">
                    <h3>Đăng ký</h3>
                    <hr>
                    <label class=""><b>Tài khoản</b></label> <span id="validate-username" class=""></span>
                    <input type="text" placeholder="Tên tài khoản" id="username" name="username" required>

                    <label for=""><b>Mật khẩu</b></label><span id="pwd-error" class="my-error-text"></span>
                    <input type="password" placeholder="Mật khẩu" id="password" name="password" autocomplete="on" required>

                    <label for=""><b>Nhập lại mật khẩu</b></label><span id="re-pwd-error" class="my-error-text"></span>
                    <input type="password" placeholder="Nhập lại mật khẩu" id="password2" autocomplete="on" required>

                    <label for=""><b>Email</b></label><span id="email-error" class="my-error-text"></span>
                    <input type="text" placeholder="example@email.com" id="email" name="email" required>

                    <hr>
                    <label for=""><b>Nhập tên của bạn</b></label>
                    <input type="text" placeholder="Họ và tên" id="ten-kh" name="tenKH" required>

                    <label for=""><b>Ngày sinh</b></label>
                    <input type="date" name="ngaySinh" id="ngay-sinh" required><br>

                    <label for=""><b>Giới tính</b></label>
                    <div class="flexbox-space-evenly">
                        <label>
                            <input type="radio" name="gioiTinh" value="1" checked>
                            Nam
                        </label>
                        <label>
                            <input type="radio" name="gioiTinh" value="0">
                            Nữ
                        </label>
                    </div>

                    <label for=""><b>Địa chỉ</b></label>
                    <input type="text" placeholder="Nhập địa chỉ" id="dia-chi" name="diaChi" required>

                    <label for=""><b>Chứng minh nhân dân/Căn cước công dân</b></label><span class="my-error-text" id="cmnd-error"></span>
                    <input type="text" placeholder="CMND/CCCD" id="cmnd" name="cmnd" required>

                    <label for=""><b>Số điện thoại</b></label><span class="my-error-text" id="sdt-error"></span>
                    <input type="text" placeholder="Số điện thoại" id="sdt" name="soDienThoai" required>
                    <span class="my-error-text" id="register-error"></span>
                </div>
                <div class="my-modal-footer bg-light">
                    <hr>
                    <div class="container row">
                        <div class="col-lg-6">
                            <div class="m-1">
                                <button type="button" id="back-button" class="btn btn-dark w-100">Quay lại</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="m-1">
                                <button type="button" id="register-button" class="btn btn-primary w-100">
                                    <span id="register-status">Đăng ký</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal quên mật khẩu -->
        <div id="forgot-password-modal" class="my-modal">
            <span id="close-forgot-password-modal" class="close" title="Close Modal">&times;</span>

            <!-- Modal Content -->
            <form action="" method="POST" class="my-modal-content animate rounded-3" autocomplete="off">
                <div class="container">
                    <h3>Quên mật khẩu</h3>
                    <hr>
                    <label for=""><b>Tài khoản</b></label>
                    <div class="input-group d-flex">
                        <div class="flex-fill">
                            <input type="text" class="" placeholder="Nhập tài khoản" name="username" id="username-forgot-password">
                        </div>
                        <button class="btn btn-link rounded-pill" id="forgot-password-send-button" type="button">Gửi</button>
                    </div>
                    <label for=""><b id="countdown">Mã xác thực (bạn có 120s để nhập)</b></label>
                    <input type="text" placeholder="Mã xác nhận" name="code" id="code-forgot-password" disabled required>
                    <span id="forgot-password-code-error" class="text-danger"></span>

                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="m-1">
                                <button type="button" id="forgot-password-back-button" class="btn btn-dark w-100">Quay lại</button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="m-1">
                                <button type="button" id="forgot-password-next-button" class="btn btn-primary w-100 disabled">
                                    <span id="">Tiếp tục</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <!-- Modal đổi mật khẩu khi quên mật khẩu -->
        <div id="forgot-password-confirm-modal" class="my-modal">
            <span id="close-forgot-password-confirm-modal" class="close" title="Close Modal">&times;</span>

            <!-- Modal Content -->
            <form class="my-modal-content animate rounded-3">
                <div class="container">
                    <h3>Đổi mật khẩu</h3>
                    <hr>
                    <label class=""><b>Mật khẩu mới</b></label> <span id="forgot-password-pwd-error" class="my-error-text"></span>
                    <input type="password" placeholder="Mật khẩu mới" id="forgot-password-pwd" name="password" autocomplete="on" required>

                    <label for=""><b>Nhập lại mật khẩu</b></label><span id="forgot-password-repwd-error" class="my-error-text"></span>
                    <input type="password" placeholder="Mật khẩu" id="forgot-password-repwd" name="repassword" autocomplete="on" required>
                    <span id="forgot-password-confirm-error" class="my-error-text"></span>
                    <hr>
                    <div class="m-1">
                        <button type="button" id="forgot-password-confirm-button" class="btn btn-primary w-100">
                            <span id="forgot-password-confirm-status">Xác nhận</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>

<?php } ?>

<main role="main" class="container">