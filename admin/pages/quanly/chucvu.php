<?php
require_once('../../../config/config.php');
require_once(ROOT.'admin/checkrole.php');
require_once(ROOT.'config/connect.php');
require_once(ROOT.'function/global.php');


include(ROOT.'admin/header.php');
?>
<!-- Ghi nội dung vào đây -->
<?php 

?>
<h1>Đây là chức vụ</h1>

<?php 
include(ROOT.'admin/footer.php');
?>
<script>
    document.getElementById('chucvu').classList.add('active');
    document.getElementById('quanly').classList.add('menu-is-opening', 'menu-open');
</script>