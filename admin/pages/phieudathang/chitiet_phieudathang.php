
<div id="id01" class="modal">
  
  <table>
      <thead>
		</thead>
      <tbody>
		<tr>
			<?php
				include('connect.php');
				$id=$_GET['id'];
				$row_sql="SELECT ma_phieu_dat,khach_hang.ten_kh,ngay_dat,tien_coc from phieu_dat_hang JOIN khach_hang WHERE khach_hang.ma_kh = phieu_dat_hang.ma_kh and ma_phieu_dat='$id'";
				$row_thuchien=mysqli_query($abc,$row_sql);
//                        var_dump(mysqli_fetch_array($row_thuchien));
				while($dulieu =mysqli_fetch_array($row_thuchien)){
					?>
					<tr>
						<td>Mã phiếu đặt:</td>
						<td><?php echo $dulieu['ma_phieu_dat']; ?></td>
					</tr>
					<tr>
						<td>Tên khách hàng:</td>
						<td><?php echo $dulieu['ten_kh']; ?> </td>
					</tr>
					<tr>
						<td>Ngày đặt:</td>
						<td><?php echo $dulieu['ngay_dat']; ?> </td>
					</tr>
					<tr>
						<td>Tiền cọc:</td>
						<td><?php echo $dulieu['tien_coc']; ?></td>				
			<?php 	} ?>
		</tbody>
      
    </table>
  
</div>
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>