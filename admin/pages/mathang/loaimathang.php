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
<h1>Đây là trang loại mặt hàng</h1>

<?php 
include(ROOT.'admin/footer.php');
?>

<script>
    document.getElementById('loaimathang').classList.add('active');
    document.getElementById('hanghoa').classList.add('menu-is-opening', 'menu-open')
</script>