
var editAccountButton = document.getElementById('edit-account-button');
var editAccountBackButton = document.getElementById('edit-account-back-button');
var editAccountBackButton2 = document.getElementById('edit-account-back-button-2'); // YES
var changePasswordButton = document.getElementById('change-password-button');

var eDiaChi = document.getElementById('edit-diachi');
var eCmnd = document.getElementById('edit-cmnd');
var eSoDienThoai = document.getElementById('edit-sdt');
var oldPassword = document.getElementById('old-password');
var newPassword = document.getElementById('new-password');
var reNewPassword = document.getElementById('re-new-password');

var eErrorText = document.getElementById('edit-account-error');
var changePasswordError = document.getElementById('change-password-error');
var editStatus = document.getElementById('edit-status');
var changePasswordStatus = document.getElementById('change-password-status');

newPassword.addEventListener('keyup', validateChangePassword);
reNewPassword.addEventListener('keyup', validateChangePassword);

editAccountBackButton.addEventListener(
    'click',
    function () {
        location.href = '/';
    }
)

editAccountBackButton2.addEventListener(
    'click',
    function () {
        location.href = '/';
    }
)

editAccountButton.addEventListener('click', editAccount);
changePasswordButton.addEventListener('click', changePassword);

// kiểm tra mật khẩu nhập có hợp lệ và kiểm tra xem mật khẩu có khớp với mật khẩu nhập lại
function validateChangePassword() {
    changePasswordError.style.color = 'red';
    if (checkAccountInput(newPassword.value)) {
        changePasswordError.innerHTML = '';
        if (newPassword.value !== reNewPassword.value) {
            changePasswordError.innerHTML = " (mật khẩu không khớp)";
            changePasswordButton.disabled = true;
        } else {
            changePasswordError.innerHTML = '';
            changePasswordButton.disabled = false;
        }
    }
    else {
        changePasswordError.innerHTML = ' (sử dụng 8 ký tự trở lên gồm chữ cái, chữ số)';
        changePasswordButton.disabled = true;
    }
}

function editAccount() {
    eErrorText.style.color = 'red';
    eErrorText.innerHTML = '';
    if (checkNumber(eCmnd.value) && checkNumber(eSoDienThoai.value) && (eDiaChi.value.length > 0)) {
        editAccountButton.classList.add('disabled');
        editStatus.innerHTML = '';
        editStatus.classList.add('spinner-border', 'spinner-border-sm');

        var data = new FormData();
        data.append('diaChi', eDiaChi.value);
        data.append('soDienThoai', eSoDienThoai.value);
        data.append('cmnd', eCmnd.value);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'editaccount.php', true);
        xhr.onload = function () {
            editAccountButton.classList.remove('disabled');
            editStatus.classList.remove('spinner-border', 'spinner-border-sm');
            editStatus.innerHTML = 'Lưu';
            if (this.responseText == 'true') {
                eErrorText.style.color = 'green';
                eErrorText.innerHTML = 'Cập nhật thông tin thành công';
            }
            else if (this.responseText == 'nochange') {
                eErrorText.innerHTML = 'Không có gì thay đổi';
            }
            else {
                eErrorText.innerHTML = 'Vui lòng nhập chính xác thông tin';
            }
        }
        xhr.send(data);
    }
    else {
        eErrorText.innerHTML = 'Vui lòng nhập chính xác thông tin';
    }
}

function changePassword() {
    changePasswordError.style.color = 'red';
    if (oldPassword.value != '') {
        changePasswordButton.classList.add('disabled');
        changePasswordStatus.innerHTML = '';
        changePasswordStatus.classList.add('spinner-border', 'spinner-border-sm');

        var data = new FormData();
        data.append('password', oldPassword.value);
        data.append('newPassword', newPassword.value);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'changepassword.php', true);
        xhr.onload = function () {
            changePasswordButton.classList.remove('disabled');
            changePasswordStatus.classList.remove('spinner-border', 'spinner-border-sm');
            changePasswordStatus.innerHTML = 'Lưu';
            
            changePasswordError.innerHTML = this.responseText;
            if (this.responseText == 'true') {
                changePasswordError.style.color = 'green';
                changePasswordError.innerHTML = 'Đổi mật khẩu thành công';
            }
            else {
                changePasswordError.innerHTML = this.responseText;
            }
        }
        xhr.send(data);
    } else {
        changePasswordError.innerHTML = 'Chưa nhập mật khẩu cũ';
    }
}