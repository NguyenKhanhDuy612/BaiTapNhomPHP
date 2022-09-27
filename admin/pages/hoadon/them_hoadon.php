<?php 
require_once('../../../config/config.php');
require_once(ROOT.'admin/checkrole.php');
?>
<div id="id01" class="modal">
  <form class="modal-content animate" action="" method="post">
    <table bgcolor="#eeeeee" align="center" width="100%" border="0">
      <tr bgcolor="#04AA6D">
        <td colspan="2" align="center"><font color="white"><h2>THÊM HÓA ĐƠN</h2></font></td>
      </tr>
      <tr>
        <td>Mã hóa đơn: </td>
        <td><input type="text" name="ma_hd" size="20" value="<?php if(isset($_POST['ma_hd'])) echo $_POST['ma_hd'];?>" /></td>
      </tr>
      <tr>
        <td>Mã phiếu đặt:</td>
        <td><select name="ma_pdh">
            <?php 
              $query="select * from phieu_dat_hang";  
              $result=mysqli_query($conn,$query);
              if(mysqli_num_rows($result)<>0){
                while($row=mysqli_fetch_array($result)){
                  $ma_pdh=$row['ma_phieu_dat'];
                  echo "<option value='$ma_pdh' "; 
                      if(isset($_REQUEST['ma_pdh']) && ($_REQUEST['ma_pdh']==$ma_pdh)) echo "selected='selected'";
                  echo ">$ma_pdh</option>";
                }
              }
              mysqli_free_result($result);
            ?>                
          </select>
        </td>
      </tr>
      <tr>
        <td>Nhân viên:</td>
        <td><select name="nhanvien">
            <?php
              $ngay=date('d/m/Y');
              $query="select * from nhan_vien";  //Hiển thị tên các hãng sữa
              $result=mysqli_query($conn,$query);
              if(mysqli_num_rows($result)<>0){
                while($row=mysqli_fetch_array($result)){
                  $ma_nv=$row['ma_nv'];
                  $ten_nv=$row['ten_nv'];
                  echo "<option value='$ma_nv' "; 
                      if(isset($_REQUEST['nhanvien']) && ($_REQUEST['nhanvien']==$ma_nv)) echo "selected='selected'";
                  echo ">$ten_nv</option>";
                }
              }
              mysqli_free_result($result);
            ?>                
          </select>
        </td>
      </tr>
      <tr>
        <td>Tổng tiền: </td>
        <td><input type="text" class="form-control" name="tongtien"></td>
      </tr>
      <tr>
        <td>Ngày thanh toán: </td>
        <td><input type="date" name="ngaythanhtoan" size="50" value="<?php echo $ngay; ?>" /></td>
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
    if(empty($_POST['ma_hd'])){
      $errors[]="Bạn chưa nhập mã hóa đơn";
    }
    else{
      $ma_hd=trim($_POST['ma_hd']);
    }
    if(empty($_POST['ma_pdh'])){
      $errors[]="Bạn chưa nhập mã phiếu";
    }
    else{
      $ma_pdh=trim($_POST['ma_pdh']);
    }
    if(empty($_POST['nhanvien'])){
      $errors[]="Bạn chưa nhập nhân viên";
    }
    else{
      $nhanvien=trim($_POST['nhanvien']);
    }
    if(empty($_POST['tongtien'])){
      $errors[]="Bạn chưa nhập nhân viên";
    }
    else{
      $tongtien=trim($_POST['tongtien']);
    }
    if(empty($_POST['ngaythanhtoan'])){
      $errors[]="Bạn chưa nhập ngày thanh toán";
    }
    else{
      $ngaythanhtoan=$_POST['ngaythanhtoan'];
    }
    //cap nhat ma hang sua va ma loai sua
    $ma_pdh=$_POST['ma_pdh'];
    $ma_nv=$_POST['nhanvien'];
    if(empty($errors))//neu khong co loi xay ra
    { 
      $query="INSERT INTO hoa_don VALUES ('$ma_hd','$ma_pdh','$nhanvien','$tongtien','$ngaythanhtoan')";
      $result=mysqli_query($abc,$query);
      if(mysqli_affected_rows($abc)==1){//neu them thanh cong
        echo '<div class="alert alert-success"><strong>Success!</strong> Thêm hóa đơn thành công.</div>';
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
      echo '<button type="button" class="btn btn-default" onclick="javascript:history.go(-1)">Back</button>';
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