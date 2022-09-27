// Get the modal
var loginModal = document.getElementById('login-modal');
var registerModal = document.getElementById('register-modal');
var forgotPasswordModal = document.getElementById('forgot-password-modal');
var forgotPasswordConfirmModal = document.getElementById('forgot-password-confirm-modal');

// nút hiển thị modal đăng nhập
var showLoginModalButton = document.getElementById('show-login-modal-button');
// nút hiển thị modal đăng ký
var showRegisterModalButton = document.getElementById('show-register-modal-button');
// nút hiển thị modal quên mật khẩu
var showForgotPasswordModalButton = document.getElementById('show-forgot-password-modal-button');

/* Các input của form đăng ký */
var password = document.getElementById('password');                 // mật khẩu của form đăng ký
var password2 = document.getElementById('password2');               // mật khẩu nhập lại
var username = document.getElementById('username');                 // để kiểm tra xem username có trùng hay không
var email = document.getElementById('email');                       // để kiểm tra email có hợp lệ
var cmnd = document.getElementById('cmnd');                         // để kiểm tra cmnd có hợp lệ
var soDienThoai = document.getElementById('sdt');                   // để kiểm tra số điện thoại có hợp lệ

/*  */
var forgotPasswordPwd = document.getElementById('forgot-password-pwd');
var forgotPasswordrePwd = document.getElementById('forgot-password-repwd');

/* Thông báo lỗi */
var passwordError = document.getElementById('pwd-error');
var rePasswordError = document.getElementById('re-pwd-error');      // lỗi hiển thị khi 2 mật khẩu không khớp
var emailError = document.getElementById('email-error');
var cmndError = document.getElementById('cmnd-error');
var sdtError = document.getElementById('sdt-error');
var loginError = document.getElementById('login-error');
var forgotPasswordCodeError = document.getElementById('forgot-password-code-error');
var forgotPasswordPwdError = document.getElementById('forgot-password-pwd-error');
var forgotPasswordrePwdError = document.getElementById('forgot-password-repwd-error');
var forgotPasswordConfirmError = document.getElementById('forgot-password-confirm-error');

/* Các nút xử lý */
var logoutButton = document.getElementById('logout-button');        // nút đăng xuất
var cancelButton = document.getElementById('cancel-button');        // nút hủy để tắt modal đăng nhập
var backButton = document.getElementById('back-button');            // nút quay lại modal đăng nhập từ modal đăng ký
var closeLoginModal = document.getElementById('close-login');       // nút X tắt modal đăng nhập
var closeRegisterModal = document.getElementById('close-register'); // nút X tắt modal đăng ký
var registerButton = document.getElementById('register-button');    // nút đăng ký của form đăng ký
var loginButton = document.getElementById('login-button');
var adminButton = document.getElementById('admin-button');
var accountButton = document.getElementById('account-button');

// Các nút trên modal quên mật khẩu
var closeForgotPasswordModal = document.getElementById('close-forgot-password-modal');
var forgotPasswordBackButton = document.getElementById('forgot-password-back-button');
var forgotPasswordSendButton = document.getElementById('forgot-password-send-button');
var forgotPasswordNextButton = document.getElementById('forgot-password-next-button');
var closeForgotPasswordConfirmModal = document.getElementById('close-forgot-password-confirm-modal');
var forgotPasswordConfirmButton = document.getElementById('forgot-password-confirm-button');

/*  */
var checkModal = document.getElementById('check-modal');

/* Thêm sự kiện cho các input và button trong modal */
if (checkModal) {
    password.addEventListener('keyup', validatePassword);
    password2.addEventListener('keyup', validatePassword);
    username.addEventListener('keyup', validateUsername);
    email.addEventListener('keyup', validateEmail);
    cmnd.addEventListener('keyup', validateCMND);
    soDienThoai.addEventListener('keyup', validateSoDienThoai);
    loginButton.addEventListener('click', xuLyDangNhap);
    registerButton.addEventListener('click', xuLyDangKy);

    // modal quên mật khẩu
    forgotPasswordSendButton.addEventListener('click', sendCode);
    forgotPasswordNextButton.addEventListener('click', confirmCode);
    forgotPasswordPwd.addEventListener('keyup', validateForgotPassword);
    forgotPasswordrePwd.addEventListener('keyup', validateForgotPassword);
    forgotPasswordConfirmButton.addEventListener('click', xuLyDoiMatKhauQuen);
}

// đăng xuất
if (logoutButton != null) {
    logoutButton.addEventListener('click', logout);
}
// mở giao diện quản trị
if (adminButton != null) {
    adminButton.addEventListener(
        'click',
        function () { location.href = "/admin"; }
    );
}
// mở giao diện thông tin cá nhân
if (accountButton != null) {
    accountButton.addEventListener(
        'click',
        function () { location.href = "/account"; }
    );
}
// giỏ hàng sẽ cần kiểm tra null


/* ============= */
/* Sự kiện modal */
/* ============= */
if (checkModal) {
    // hiện modal đăn nhập
    showLoginModalButton.addEventListener(
        'click',
        function () { showModal(loginModal.id) }
    );
    // tắt modal đăng nhập khi bấm nút hủy
    cancelButton.addEventListener(
        'click',
        function () { hideModal('login-modal') }
    );

    // tắt modal đăng nhập và hiển thị modal đăng ký khi bấm vào link đăng ký
    showRegisterModalButton.addEventListener(
        'click',
        function () {
            hideModal(loginModal.id);
            showModal(registerModal.id);
        }
    )

    // tắt modal đăng ký và hiển thị lại modal đăng nhập khi bấm nút quay lại
    backButton.addEventListener(
        'click',
        function () {
            hideModal(registerModal.id);
            showModal(loginModal.id);
        }
    )

    // tắt modal đăng nhập và hiện modal quên mật khẩu
    showForgotPasswordModalButton.addEventListener(
        'click',
        function () {
            hideModal(loginModal.id);
            showModal(forgotPasswordModal.id);
        }
    )

    forgotPasswordBackButton.addEventListener(
        'click',
        function () {
            hideModal(forgotPasswordModal.id);
            showModal(loginModal.id);
        }
    )

    closeLoginModal.addEventListener(
        'click',
        function () {
            hideModal(loginModal.id);
        }
    )

    closeRegisterModal.addEventListener(
        'click',
        function () {
            hideModal(registerModal.id);
        }
    )

    closeForgotPasswordModal.addEventListener(
        'click',
        function () {
            hideModal(forgotPasswordModal.id);
        }
    )

    closeForgotPasswordConfirmModal.addEventListener(
        'click',
        function () {
            hideModal(forgotPasswordConfirmModal.id);
        }
    )
}
// Khi click vào vùng bên ngoài của model sẽ tự động đóng modal
window.onclick = function (event) {
    if (event.target == loginModal) {
        hideModal(loginModal.id)
    }
    if (event.target == registerModal) {
        hideModal(registerModal.id);
    }
    if (event.target == forgotPasswordModal) {
        hideModal(forgotPasswordModal.id)
    }
}
/* ============= */
/* Các hàm xử lý */
/* ============= */
function showModal(id) {
    document.getElementById(id).style.display = 'block';
}

function hideModal(id) {
    document.getElementById(id).style.display = 'none';

}

// đăng xuất
function logout() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/logout.php', true);
    xhr.onload = function () {
        window.location.href = window.location.href;
    }
    xhr.send();
};

// kiểm tra xem tên tài khoản hoặc mật khẩu có hợp lệ hay không
// regex: các ký tự a-z, A-Z, 0-9, 8 ký tự trở lên
function checkAccountInput(username) {
    var nameRegex = /^[a-zA-Z0-9]{8,}$/;
    var validInput = username.match(nameRegex);
    if (validInput == null) {
        return false;
    }
    return true;
}

// kiểm tra email
// https://emailregex.com/
function checkEmail(email) {
    var mailRegex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var validEmail = email.match(mailRegex);
    if (validEmail == null) {
        return false;
    }
    return true;
}

// kiểm tra chứng minh nhân dân và số điện thoại
function checkNumber(number) {
    var numberRegex = /^[0-9]{9,12}$/;
    var validNumber = number.match(numberRegex);
    if (validNumber == null) {
        return false;
    }
    return true;
}

/* =============================================================================== */
/* Những hàm validate sẽ phản hồi trực tiếp cho người dùng mà không cần bấm submit */
/* =============================================================================== */

// kiểm tra username đã tồn tại hay chưa
function validateUsername() {
    var username = document.getElementById('username').value;
    var usernameError = document.getElementById('validate-username');
    usernameError.innerHTML = '';
    // chỉ thực hiện validate khi username hợp lệ
    if (checkAccountInput(username)) {
        // tạo ra vòng loading
        usernameError.classList.add('spinner-border', 'spinner-border-sm');
        var data = new FormData();
        data.append('username', username);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'validateUsername.php', true);
        // khi request hoàn thành
        xhr.onload = function () {
            // xóa vòng loading
            usernameError.classList.remove('spinner-border', 'spinner-border-sm');
            //
            if (this.responseText == 'true') {
                usernameError.style.color = 'green';
                usernameError.innerHTML = ' (bạn có thể dùng tài khoản này)';
                registerButton.disabled = false;
            }// nếu tài khoản đã tồn tài thì disable nút đăng ký
            else {
                usernameError.style.color = 'red';
                usernameError.innerHTML = ' (tài khoản đã tồn tại)';
                registerButton.disabled = true;
            }
        };
        xhr.send(data);
    }
    else {
        usernameError.style.color = 'red';
        usernameError.innerHTML = ' (sử dụng 8 ký tự trở lên gồm chữ cái, chữ số)';
        registerButton.disabled = true;
    }
}

// kiểm tra mật khẩu nhập có hợp lệ và kiểm tra xem mật khẩu có khớp với mật khẩu nhập lại
function validatePassword() {
    if (checkAccountInput(password.value)) {
        passwordError.innerHTML = '';
        if (password2.value !== password.value) {
            rePasswordError.innerHTML = " (mật khẩu không khớp)";
            registerButton.disabled = true;
        } else {
            rePasswordError.innerHTML = "";
            registerButton.disabled = false;
        }
    }
    else {
        passwordError.innerHTML = ' (sử dụng 8 ký tự trở lên gồm chữ cái, chữ số)';
        registerButton.disabled = true;
    }
}

function validateForgotPassword() {
    if (checkAccountInput(forgotPasswordPwd.value)) {
        forgotPasswordPwdError.innerHTML = '';
        if (forgotPasswordrePwd.value !== forgotPasswordPwd.value) {
            forgotPasswordrePwdError.innerHTML = " (mật khẩu không khớp)";
            forgotPasswordConfirmButton.disabled = true;
        } else {
            forgotPasswordrePwdError.innerHTML = "";
            forgotPasswordConfirmButton.disabled = false;
        }
    }
    else {
        forgotPasswordPwdError.innerHTML = ' (sử dụng 8 ký tự trở lên gồm chữ cái, chữ số)';
        forgotPasswordConfirmButton.disabled = true;
    }
}


/* Nếu input khác trống và không hợp lệ thì báo lỗi */
function validateEmail() {
    if (email.value != '') {
        if (checkEmail(email.value)) {
            emailError.innerHTML = '';
            registerButton.disabled = false;
        }
        else {
            emailError.innerHTML = ' (email không hợp lệ)';
            registerButton.disabled = true;
        }
    }
    else {
        emailError.innerHTML = '';
    }
}

function validateCMND() {
    if (cmnd.value != '') {
        if (checkNumber(cmnd.value)) {
            cmndError.innerHTML = '';
            registerButton.disabled = false;
        }
        else {
            cmndError.innerHTML = ' (CMND/CCCD không hợp lệ)';
            registerButton.disabled = true;
        }
    }
    else {
        cmndError.innerHTML = '';
    }
}

function validateSoDienThoai() {
    if (soDienThoai.value != '') {
        if (checkNumber(soDienThoai.value)) {
            sdtError.innerHTML = '';
            registerButton.disabled = false;
        }
        else {
            sdtError.innerHTML = ' (số điện thoại không hợp lệ)';
            registerButton.disabled = true;
        }
    }
    else {
        sdtError.innerHTML = '';
    }
}

// xử lý đăng nhập
function xuLyDangNhap() {
    var usernameLogin = document.getElementById('username-login').value;
    var passwordLogin = document.getElementById('password-login').value;
    var loginStatus = document.getElementById('login-status');  //  id của đoạn text trong nút đăng nhập
    loginError.innerHTML = '';
    // disable nút Đăng nhập và thay nội dung bằng vòng loading
    loginButton.classList.add('disabled');
    loginStatus.innerHTML = '';
    loginStatus.classList.add('spinner-border', 'spinner-border-sm');

    var data = new FormData();
    data.append('username', usernameLogin);
    data.append('password', passwordLogin);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/login.php', true);
    // khi hoàn thành request thì xóa vòng loading, ghi lại nội dung nút đăng nhập
    xhr.onload = function () {
        loginButton.classList.remove('disabled');
        loginStatus.classList.remove('spinner-border', 'spinner-border-sm');
        loginStatus.innerHTML = 'Đăng nhập';
        // đăng nhập thành công thì reload lại trang
        if (this.responseText == 'true') {
            location.reload();
        }
        else {
            loginError.innerHTML = 'Sai tài khoản hoặc mật khẩu';
        }
    }
    xhr.send(data);
}

// xử lý đăng ký
function xuLyDangKy() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var email = document.getElementById('email').value;
    var tenKH = document.getElementById('ten-kh').value;
    var ngaySinh = document.getElementById('ngay-sinh').value;
    var gioiTinh = document.querySelector('input[name="gioiTinh"]:checked').value;
    var diaChi = document.getElementById('dia-chi').value;
    var cmnd = document.getElementById('cmnd').value;
    var soDienThoai = document.getElementById('sdt').value;

    var registerError = document.getElementById('register-error');
    var registerStatus = document.getElementById('register-status');
    registerError.innerHTML = '';

    // disable nút Đăng ký và thay nội dung bằng vòng loading
    registerButton.classList.add('disabled');
    registerStatus.innerHTML = '';
    registerStatus.classList.add('spinner-border', 'spinner-border-sm');

    var data = new FormData();
    data.append('username', username);
    data.append('password', password);
    data.append('email', email);
    data.append('tenKH', tenKH);
    data.append('ngaySinh', ngaySinh);
    data.append('gioiTinh', gioiTinh);
    data.append('diaChi', diaChi);
    data.append('cmnd', cmnd);
    data.append('soDienThoai', soDienThoai);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/register.php', true);
    // khi hoàn thành request thì xóa vòng loading, ghi lại nội dung nút đăng nhập
    xhr.onload = function () {
        registerButton.classList.remove('disabled');
        registerStatus.classList.remove('spinner-border', 'spinner-border-sm');
        registerStatus.innerHTML = 'Đăng Ký';
        // đăng ký thành công thì reload lại trang
        if (this.responseText == 'true') {
            location.reload();
        }
        else if (this.responseText == 'duplicate email') {
            registerError.innerHTML = 'Email đã có người sử dụng';
        }
        else if (this.responseText == 'error') {
            registerError.innerHTML = 'Có lỗi xảy ra';
        }
        else {
            registerError.innerHTML = 'Vui lòng nhập đầy đủ thông tin';
        }
    }
    xhr.send(data);
}

function demNguoc() {
    var timeleft = 120;
    var sendTimer = setInterval(function () {
        timeleft--;
        document.getElementById('countdown').innerHTML = 'Mã xác thực (bạn có ' + timeleft + 's để nhập)';
        if (timeleft <= 0) {
            document.getElementById('countdown').innerHTML = 'Mã xác thực đã hết hạn, hãy thử lại';
            clearInterval(sendTimer);
        }
    }, 1000);
}

// xử lý gửi mã xác thực
function sendCode() {
    var username = document.getElementById('username-forgot-password');
    forgotPasswordCodeError.innerHTML = '';
    if (username.value !== '') {
        forgotPasswordSendButton.classList.add('disabled');
        forgotPasswordCodeError.innerHTML = 'Vui lòng chờ...';
        var code = document.getElementById('code-forgot-password');
        var data = new FormData();
        data.append('username', username.value);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/guiMaXacThuc.php', true);
        xhr.onload = function () {
            forgotPasswordSendButton.classList.add('disabled');
            if (JSON.parse(this.responseText)[0] == 'true') {
                username.disabled = true;
                code.disabled = false;
                forgotPasswordNextButton.classList.remove('disabled');
                demNguoc();
                setTimeout(function () {
                    forgotPasswordSendButton.classList.remove('disabled');
                    forgotPasswordNextButton.classList.add('disabled');
                    code.disabled = true;
                    username.disabled = false;
                }, 120000);
                forgotPasswordCodeError.innerHTML = JSON.parse(this.responseText)[1];
            }
            else {
                forgotPasswordSendButton.classList.remove('disabled');
                forgotPasswordCodeError.innerHTML = JSON.parse(this.responseText)[0];
            }
        }
        xhr.send(data);
    }
    else {
        forgotPasswordCodeError.innerHTML = 'Vui lòng nhập vào tài khoản';
    }
}

// xử lý xác nhận mã xác thực
function confirmCode() {
    var username = document.getElementById('username-forgot-password').value;
    var code = document.getElementById('code-forgot-password').value;
    if (code != '') {
        var data = new FormData();
        data.append('username', username);
        data.append('code', code);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/checkMaXacThuc.php', true);
        xhr.onload = function () {
            if (this.responseText == 'true') {
                forgotPasswordCodeError.innerHTML = 'ok';
                hideModal(forgotPasswordModal.id);
                showModal(forgotPasswordConfirmModal.id);
            }
            else {
                forgotPasswordCodeError.innerHTML = this.responseText;
            }
        }
        xhr.send(data);
    }
    else {
        forgotPasswordCodeError.innerHTML = 'Vui lòng nhập mã xác thực'
    }
}

function xuLyDoiMatKhauQuen() {
    if (checkAccountInput(forgotPasswordPwd.value)){
        if (forgotPasswordPwd.value === forgotPasswordrePwd.value){
            var username = document.getElementById('username-forgot-password').value;
            var code = document.getElementById('code-forgot-password').value;
            var data = new FormData();
            data.append('username', username);
            data.append('code', code);
            data.append('password', forgotPasswordPwd.value);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/quenMatKhau.php', true);
            xhr.onload = function () {
                if (this.responseText == 'true'){
                    alert('Đổi mật khẩu thành công');
                    location.reload();
                }
                else {
                    forgotPasswordConfirmError.innerHTML = this.responseText;
                }
            }
            xhr.send(data);
        }
    }
    else {
        forgotPasswordConfirmError.innerHTML = 'Vui lòng nhập vào mật khẩu';
    }
}