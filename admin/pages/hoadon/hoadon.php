<?php 
require_once('../../../config/config.php');
require_once(ROOT.'admin/checkrole.php');
	include('them_hoadon.php');
	include('xoa_hoadon.php');
?>

<!-- /.card -->
<div class="card">
  <!-- /.card-header -->
  <div class="card-body">
  	<h2 class="text-center" style="color: blue;">Danh sách hóa đơn</h2>
    <!--<a onclick="document.getElementById('id01').style.display='block'"><div class="but button-3">Thêm hóa đơn</div></a>-->
    <form method="get" id="phieudathang">
        <input name="keyword" placeholder="" value="">
        <input type="submit" value="Tìm hóa đơn">
        <div class="float-right">
	        <a href="#"><div class="button button-2"><i class="fas fa-apple-alt"></i> PDF</div></a>
	        <a href="#"><div class="button button-2"><i class="fas fa-lemon"></i> CSV</div></a>
	    </div>
    </form>
    <table id="example1" class="table table-bordered table-striped">
      <thead>
		<tr>
			<th>Mã hóa đơn</th>
			<th>Mã phiếu đặt</th>
			<th>Nhân viên</th>
			<th>Tổng tiền</th>
			<th>Ngày thanh toán</th>
			<th colspan="3">Chức năng</th>
		</tr>
		</thead>
      <tbody>
		<tr>
			<?php
				$row_sql="SELECT ma_hoa_don,phieu_dat_hang.ma_phieu_dat,nhan_vien.ten_nv,tong_tien,ngay_thanh_toan from hoa_don JOIN phieu_dat_hang JOIN nhan_vien WHERE hoa_don.ma_phieu_dat = phieu_dat_hang.ma_phieu_dat and hoa_don.ma_nv=nhan_vien.ma_nv";
                if (!empty($_GET['keyword']))
                {
                    $search = $_GET['keyword']; // mà tìm đc mỗi cái mã óa đơn, ngoài đời ai tìm theo mã đâu, nếu ko đc thì tui sửa bài ông luôn đó tui mới test phần đó, nếu dc lực qery lại thử
                    // ,phieu_dat_hang.ma_phieu_dat,nhan_vien.ten_nv cái chỗ này ông có thể viết gọn như bên sql
                    $row_sql="SELECT ma_hoa_don, pdh.ma_phieu_dat, nv.ten_nv, tong_tien, ngay_thanh_toan from hoa_don hd JOIN phieu_dat_hang pdh JOIN nhan_vien nv WHERE hd.ma_phieu_dat = pdh.ma_phieu_dat and hd.ma_nv=nv.ma_nv and ma_hoa_don like '%$search%'";                           
                }
				$row_thuchien=mysqli_query($conn,$row_sql);
//                        var_dump(mysqli_fetch_array($row_thuchien));
				while($dulieu =mysqli_fetch_array($row_thuchien)){
					?>
					<td><?php echo $dulieu['ma_hoa_don']; ?></td>
					<td><?php echo $dulieu['ma_phieu_dat']; ?> </td>
					<td><?php echo $dulieu['ten_nv']; ?> </td>
					<td><?php echo $dulieu['tong_tien']; ?></td>
					<td><?php echo $dulieu['ngay_thanh_toan']; ?></td>
					<td width="50px">
						<a onclick=" return confirm('Bạn có chắc muốn thêm không?')" href="#" id="themm" title="Sửa">
							<img src="/admin/img/sua.png" width="25px"> 
						</a> 
					</td>
					<td width="50px">
						<a onclick="document.getElementById('id02').style.display='block'"><img src='/admin/img/xoa.png' width='25px' ></a>
					</td>
					<td width="50px">
						<a onclick=" return confirm('Bạn có chắc muốn xem không?') " href="hoadon.php?id=<?php echo $dulieu['MaNV']; ?>" title="Chi tiết"><img src='/admin/img/chitiet.png' width='25px' >
						</a>
					</td>
				</tr>					
			<?php 	} ?>
		</tbody>
      
    </table>
  </div>

  <!-- /.card-body -->
</div>
<!-- /.card -->