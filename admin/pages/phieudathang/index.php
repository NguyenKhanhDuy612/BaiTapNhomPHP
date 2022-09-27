<?php
require_once('../../../config/config.php');
require_once(ROOT.'admin/checkrole.php');
require_once(ROOT.'config/connect.php');
require_once(ROOT.'function/global.php');
/* Đừng động vào những cái require với include */
include(ROOT.'admin/header.php');
?>
<link rel="stylesheet" type="text/css" href="/admin/pages/phieudathang/button.css">
<link rel="stylesheet" type="text/css" href="/admin/pages/hoadon/hoadon.css">
<?php
    include('phieudathang.php'); 
?>

<?php 
include(ROOT.'admin/footer.php');
?>

<script>
    document.getElementById('phieudathang').classList.add('active');
</script>