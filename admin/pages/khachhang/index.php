<?php
require_once('../../../config/config.php');
require_once(ROOT.'admin/checkrole.php');
require_once(ROOT.'config/connect.php');
require_once(ROOT.'function/global.php');
/* Đừng động vào những cái require với include */
include(ROOT.'admin/header.php');
?>
<!-- Ghi nội dung vào đây -->
<?php 

?>
<h1>Đây là trang khách hàng</h1>

<?php 
include(ROOT.'admin/footer.php');
?>
<script>
    document.getElementById('khachhang').classList.add('active');
</script>