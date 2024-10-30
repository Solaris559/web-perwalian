const token = localStorage.getItem('token');
if (!token) {
    window.location.href = '../login-u/login-form.html';
}