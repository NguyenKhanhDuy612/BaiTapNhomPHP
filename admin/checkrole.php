<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// Nếu người dùng chưa đăng nhập thì chuyển về lại trang index
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../');
}
// ngược lại nếu người dùng là khách hàng thì chuyển về lại trang index
else if ($_SESSION['role'] == 'user'){
	header('Location: ../');
}