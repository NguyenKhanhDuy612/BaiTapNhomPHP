<head>
	<link rel="stylesheet" type="text/css" href="/admin/pages/phieudathang/button.css">
</head>
<style type="text/css">
	.div{
		color: #fff;
	}
</style>
<?php 
	//include('../../../config/connect.php');ui
	include('../hoadon/them_hoadon.php');
?>
<!-- /.card -->
<div class="card">
  <!-- /.card-header -->
  <div class="card-body">
  	<h2 class="text-center" style="color: blue;">Danh sách phiếu đặt hàng</h2>
  	<a onclick="document.getElementById('id01').style.display='block'"><div class="but button-3">Thêm hóa đơn</div></a>	
    <form method="get" id="phieudathang">
        <input name="keyword" placeholder="" value="">
        <input type="submit" value="Tìm phiếu đặt hàng">
        <div class="float-right">
	        <a href="pages/phieudathang/export_pdf.php"><div class="button button-2"><i class="fas fa-apple-alt"></i> PDF</div></a>
	        <a href="pages/phieudathang/export_csv.php"><div class="button button-2"><i class="fas fa-lemon"></i> CSV</div></a>
	    </div>
    </form>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
		<tr>
			<th>Mã phiếu đặt hàng</th>
			<th>Khách hàng</th>
			<th>Ngày đặt</th>
			<th>Tiền cọc</th>
			<th>Ghi chú</th>
		</tr>
		</thead>
      <tbody>
		<tr>
			<?php
				$row_sql="SELECT ma_phieu_dat,khach_hang.ten_kh,ngay_dat,tien_coc,ghi_chu from phieu_dat_hang JOIN khach_hang WHERE khach_hang.ma_kh = phieu_dat_hang.ma_kh";
				
                if (!empty($_GET['keyword']))
                {
                    $search=$_GET['keyword'];
                    $row_sql="SELECT ma_phieu_dat,khach_hang.ten_kh,ngay_dat,tien_coc,ghi_chu from phieu_dat_hang JOIN khach_hang WHERE khach_hang.ma_kh = phieu_dat_hang.ma_kh and ma_phieu_dat like '%$search%'";                           
                }
				$row_thuchien=mysqli_query($conn,$row_sql);
//                        var_dump(mysqli_fetch_array($row_thuchien));
				while($dulieu =mysqli_fetch_array($row_thuchien)){
					?>
					<td><?php echo $dulieu['ma_phieu_dat']; ?></td>
					<td><?php echo $dulieu['ten_kh']; ?> </td>
					<td><?php echo $dulieu['ngay_dat']; ?> </td>
					<td><?php echo $dulieu['tien_coc']; ?></td>
					<td><?php echo $dulieu['ghi_chu']; ?></td>
				</tr>					
			<?php 	} ?>
		</tbody>
    </table>
  </div>

  <!-- /.card-body -->
</div>
<!-- /.card -->
