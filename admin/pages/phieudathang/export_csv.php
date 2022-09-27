<?php
 
    // Database Connection
    include('connect.php');
 
    // get users list
    $query = "SELECT ma_phieu_dat,khach_hang.ten_kh,ngay_dat,tien_coc from phieu_dat_hang JOIN khach_hang WHERE khach_hang.ma_kh = phieu_dat_hang.ma_kh";
    if (!$result = mysqli_query($conn, $query)) {
        exit(mysqli_error($conn));
    }
 
    $users = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }
 
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename=phieudathang.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('Mã phiếu đặt', 'Khách hàng', 'Ngày đặt', 'Tiền cọc'));
 
    if (count($users) > 0) {
        foreach ($users as $row) {
            fputcsv($output, $row);
        }
    }
?>