
<style type="text/css">
	#mess{
		background-color: #49bd90;
		height: 30px;
	}
	#xoatc{
		color: white;
		text-align: center;
		padding: 8px;
	}
</style>
<?php
	include_once('connect.php');
	if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
	$id=$_GET['id'];
	$sql = "DELETE FROM nhan_vien WHERE MaNV='$id'";
	if ($abc->query($sql) === TRUE) {
	echo "<div id='mess'><h5 id='xoatc'>Xoá thành công!</h5></div>";
	include('index_nhanvien.php');
	} else {
	echo "Error updating record: " . $abc->error;
	}

	$abc->close();
	}
?>
<a href="javascript:window.history.back(-1);">Quay lại</a>
