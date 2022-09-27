<?php
require_once('../../../config/config.php');
require_once(ROOT.'admin/checkrole.php');
require_once(ROOT.'config/connect.php');
require_once(ROOT.'function/global.php');
/* Đừng động vào những cái require, include với <script> */
include(ROOT.'admin/header.php');
?>
<link rel="stylesheet" type="text/css" href="/admin/pages/phieudathang/button.css">
<link rel="stylesheet" type="text/css" href="hoadon.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Ghi nội dung vào đây -->
<?php 

?>
<?php
    include('hoadon.php');
?>

<?php 
include(ROOT.'admin/footer.php');
?>
<script>
    document.getElementById('hoadon').classList.add('active');
</script>