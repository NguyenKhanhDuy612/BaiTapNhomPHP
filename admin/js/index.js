var adminLogout = document.getElementById('admin-logout');

adminLogout.addEventListener('click', logout);

// đăng xuất
function logout() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/logout.php', true);
    xhr.onload = function () {
        window.location.href = '/';
    }
    xhr.send();
};