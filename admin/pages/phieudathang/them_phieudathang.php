<style type="text/css">

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}
span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 5% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 40%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
<div id="id01" class="modal">
  
  <form class="modal-content animate" action="them_phieudathang.php" method="post" enctype="multipart/form-data">
    <table bgcolor="#eeeeee" align="center" width="100%" border="0">
		<tr bgcolor="#04AA6D">
			<td colspan="2" align="center"><font color="white"><h2>THÊM PHIẾU ĐẶT HÀNG</h2></font></td>
		</tr>
		<tr>
			<td>Mã phiếu đặt hàng: </td>
			<td><input type="text" name="ma_pdh" size="20" value="<?php if(isset($_POST['ma_pdh'])) echo $_POST['ma_pdh'];?>" /></td>
		</tr>
		<tr>
			<td>Khách hàng:</td>
			<td><select name="khachhang">
					<?php 
						$query="select * from khach_hang";	//Hiển thị tên các hãng sữa
						$result=mysqli_query($conn,$query);
						if(mysqli_num_rows($result)<>0){
							while($row=mysqli_fetch_array($result)){
								$ma_kh=$row['ma_kh'];
								$ten_kh=$row['ten_kh'];
								echo "<option value='$ma_kh' "; 
										if(isset($_REQUEST['khachhang']) && ($_REQUEST['khachhang']==$ma_kh)) echo "selected='selected'";
								echo ">$ten_kh</option>";
							}
						}
						mysqli_free_result($result);
					?>								
				</select>
			</td>
		</tr>
		<tr>
			<td>Ngày đặt: </td>
			<td><input type="date" class="form-control" name="ngay_dat"></td>
		</tr>
		<tr>
			<td>Tiền cọc: </td>
			<td><input type="text" name="tien_coc" size="50" value="<?php if(isset($_POST['tien_coc'])) echo $_POST['tien_coc'];?>" /></td>
		</tr>
		<tr>
			<td>Ghi chú: </td>
			<td><input type="text" name="ghi_chu" size="50" value="<?php if(isset($_POST['ghi_chu'])) echo $_POST['ghi_chu'];?>" /></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name ="them" size="10" value="Thêm mới" /></td>
		</tr>
		</table>
  </form>
  
</div>
<?php 
	require_once('connect.php');
?>
<?php 
	if(isset($_POST['them'])){
		$errors=array(); //khởi tạo 1 mảng chứa lỗi
		//kiem tra ma sua
		if(empty($_POST['ma_pdh'])){
			$errors[]="Bạn chưa nhập mã phiếu đặt hàng";
		}
		else{
			$ma_pdh=trim($_POST['ma_pdh']);
		}
		if(empty($_POST['ngay_dat'])){
			$errors[]="Bạn chưa nhập ngày dặt";
		}
		else{
			$ngay_dat=trim($_POST['ngay_dat']);
		}
		if(empty($_POST['tien_coc'])){
			$errors[]="Bạn chưa nhập địa chỉ nhân viên";
		}
		else{
			$tien_coc=trim($_POST['tien_coc']);
		}
		if(empty($_POST['ghi_chu'])){
			$errors[]="Bạn chưa nhập ghi chú";
		}
		else{
			$ghi_chu=trim($_POST['ghi_chu']);
		}
		//cap nhat ma hang sua va ma loai sua
		$ma_kh=$_POST['khachhang'];

		if(empty($errors))//neu khong co loi xay ra
		{ 
			$query="INSERT INTO phieu_dat_hang VALUES ('$ma_pdh','$ma_kh','$ngay_dat','$tien_coc','$ghi_chu')";
			$result=mysqli_query($abc,$query);
			if(mysqli_affected_rows($abc)==1){//neu them thanh cong
				echo "<div id='mess'><h5 id='themtc'>Thêm phiếu đặt hàng thành công!</h5></div>";				
			}
			else //neu khong them duoc
			{
				echo "<p>Có lỗi, không thể thêm được</p>";
				echo "<p>".mysqli_error($abc)."<br/><br />Query: ".$query."</p>";	
			}
		}
		else
		{//neu co loi
			echo "<h2></h2><p>Có lỗi xảy ra:<br/>";
			foreach($errors as $msg)
			{
				echo "- $msg<br /><\n>";
			}
			echo "</p><p>Hãy thử lại.</p>";
		}
	}
	mysqli_close($abc);
?>
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