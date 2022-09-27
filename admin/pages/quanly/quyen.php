<?php
require_once('../../../config/config.php');
require_once(ROOT.'admin/checkrole.php');
require_once(ROOT.'config/connect.php');
require_once(ROOT.'function/global.php');



include(ROOT.'admin/header.php');
?>

<h1>Đây là quyền</h1>

<?php 
include(ROOT.'admin/footer.php');
?>
<script>
    document.getElementById('quyen').classList.add('active');
    document.getElementById('quanly').classList.add('menu-is-opening', 'menu-open');
</script>