const form = document.querySelector("form");
const nameInput = form.querySelector('input[name="name"]')
const surnameInput = form.querySelector('input[name="surname"]')
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');

function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function nameIsNotEmpty(name) {
    return /[A-Za-z]+/.test(name);
}

function surnameIsNotEmpty(surname) {
    return /[A-Za-z]+/.test(surname);
}

function arePasswordsSame(password, confirmedPassword) {
    return password === confirmedPassword;
}

function requiredLengthOfPassword(password) {
    return password.length >= 6;
}

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

function validateEmail() {
    setTimeout(function () {
            markValidation(emailInput, isEmail(emailInput.value));
        },
        1000
    );
}

function validateName() {
    setTimeout(function () {
            markValidation(nameInput, nameIsNotEmpty(nameInput.value));
        },
        1000
    );
}

function validateSurname() {
    setTimeout(function () {
            markValidation(surnameInput, surnameIsNotEmpty(surnameInput.value));
        },
        1000
    );
}

function validatePassword() {
    setTimeout(function () {
            markValidation(passwordInput, requiredLengthOfPassword(passwordInput.value))
        },
        1000
    );
}

function validateConfirmedPassword() {
    setTimeout(function () {
            const condition = arePasswordsSame(
                confirmedPasswordInput.previousElementSibling.value,
                confirmedPasswordInput.value
            );
            markValidation(confirmedPasswordInput, condition);
        },
        1000
    );
}

emailInput.addEventListener('keyup', validateEmail);
nameInput.addEventListener('keyup', validateName);
surnameInput.addEventListener('keyup', validateSurname);
passwordInput.addEventListener('keyup', validatePassword);
confirmedPasswordInput.addEventListener('keyup', validateConfirmedPassword);
