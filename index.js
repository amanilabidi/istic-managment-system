// fun1 : login and create account traslation

document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.querySelector('.box:not(.hidden)');
    const createAccountForm = document.querySelector('.box.hidden');

    document.getElementById('create-account-link').addEventListener('click', function (e) {
        e.preventDefault();
        loginForm.classList.add('hidden');
        createAccountForm.classList.remove('hidden');
    });

    document.getElementById('goBack').addEventListener('click', function (e) {
        e.preventDefault();
        loginForm.classList.remove('hidden');
        createAccountForm.classList.add('hidden');
    });
});

// fun 2 : validate  password : 
/*function validatePassword() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm-password").value;

    if (password !== confirmPassword) {
        alert("Passwords do not match!");
    }
}*/


 