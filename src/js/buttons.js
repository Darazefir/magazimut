//реализация смены форм регистрации и авторизации по нажатию кнопок

let signup = document.getElementById('signup');
let login = document.getElementById('login');
let blockSignup = document.getElementById('blockSignup');
let blockLogin = document.getElementById('blockLogin');

signup.onclick = function()
{
    signup.setAttribute('class', 'unactive');
    login.removeAttribute('class', 'unactive');
    blockSignup.setAttribute("style", "display: block");
    blockLogin.setAttribute("style", "display: none");
};

login.onclick = function()
{
    login.setAttribute('class', 'unactive');
    signup.removeAttribute('class', 'unactive');
    blockLogin.setAttribute("style", "display: block");
    blockSignup.setAttribute("style", "display: none");
};