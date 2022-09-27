<?php 
require_once('../../../config/config.php');
require_once(ROOT.'admin/checkrole.php');
?>
<link rel="stylesheet" type="text/css" href="hoadon.css">
<div id="id02" class="modal">
  <form class="modal-content animate" action="" method="post">
    <table bgcolor="#eeeeee" align="center" width="100%" border="0">
      <tr bgcolor="#04AA6D">
        <td colspan="2" align="center"><font color="white"><h3>Bạn có muốn xóa không?</h3></font></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name ="xoa" size="10" value="Xóa" /></td>
      </tr>
    </table>
  </form>
</div>
<?php
	include('connect.php');
	if(isset($_POST['xoa']))
	{	echo '<div class="alert alert-success"><strong>Success!</strong> Xóa thành công.</div>';
		if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
		$id=$_GET['id'];
		$sql = "DELETE FROM hoa_don WHERE ma_hoa_don='$id'";
		if ($abc->query($sql) === TRUE) {
		echo '<div class="alert alert-success"><strong>Success!</strong> Xóa thành công.</div>';
		} else {
		echo "Error updating record: " . $abc->error;
		}

		$abc->close();
		}
	}
?>
<script>
// Get the modal
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>