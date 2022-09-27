/* // Nhan vien
$("#nhanvien").click(function(e){
    e.preventDefault();
    $(".content-wrapper").load("pages/nhanvien/nhanvien.php");
})

// Khach hang
$("#khachhang").click(function(e){
    e.preventDefault();
    $(".content-wrapper").load("pages/khachhang/khachhang.php");
})

// Nha cung cap
$("#nhacungcap").click(function(e){
    e.preventDefault();
    $(".content-wrapper").load("pages/nhacungcap/nhacungcap.php");
})

// Phieu dat hang
$("#phieudathang").click(function(e){
    e.preventDefault();
    $(".content-wrapper").load("pages/phieudathang/phieudathang.php");
})

// Hoa don
$("#hoadon").click(function(e){
    e.preventDefault();
    $(".content-wrapper").load("pages/hoadon/hoadon.php");
})

// quan ly
$("#taikhoan").click(function(e){
    e.preventDefault();
    $(".content-wrapper").load("pages/quanly/taikhoan.php");
})
$("#quyen").click(function(e){
    e.preventDefault();
    $(".content-wrapper").load("pages/quanly/quyen.php");
})
$("#chucvu").click(function(e){
    e.preventDefault();
    $(".content-wrapper").load("pages/quanly/chucvu.php");
})
 */

// Selected
$('ul.nav > li.nav-item > a').click(function(e) {
    e.preventDefault();
    $('ul.nav > li.nav-item > a').removeClass('active');
    $(this).addClass('active');
});