document.getElementById("logout").addEventListener("submit", function(event){
    event.preventDefault();

    localStorage.removeItem('token');
    localStorage.removeItem('id');
    window.location.href = "../login-u/login-form.html";
});