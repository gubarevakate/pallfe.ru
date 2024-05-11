//Событие выполниться при полной загрузке страницы
document.addEventListener("DOMContentLoaded", () => {
    // alert('Страница загружена!');
 //Получаем список элементов родителя
buttons = document.querySelector('button');
//в 1 параметре - событие (щелчок по кнопке)
//во 2 - анонимная функция с контекстом вызвавшим событие
buttons.addEventListener('click', function(e) {
//метод, предотвращающий реакцию по умолчанию
e.preventDefault();
//Значение из поля e-mail
var name = document.getElementById("contact-name").value;
//Объект поля e-mail
var named = document.getElementById("contact-name");
//Если символ @ не найден в строке получаем -1

if (name === "") {
    //Добавляем подкласс об ошибке!
    named.classList.add('is-invalid');
    //Удаляем подкласс валидности!
    named.classList.remove('is-valid');
    } else {
        //Удаляем подкласс об ошибке!
        named.classList.remove('is-invalid');
        //Добавляем класс валидности
        named.classList.add('is-valid');
}

var email = document.getElementById("contact-email").value;
//Объект поля e-mail
var emailid = document.getElementById("contact-email");
//Если символ @ не найден в строке получаем -1
if (email.indexOf('@') == -1) {
    //Добавляем подкласс об ошибке!
    emailid.classList.add('is-invalid');
    //Удаляем подкласс валидности!
    emailid.classList.remove('is-valid');
    } else {
        //Удаляем подкласс об ошибке!
        emailid.classList.remove('is-invalid');
        //Добавляем класс валидности
        emailid.classList.add('is-valid');
}

var area = document.getElementById("textarea").value;
//Объект поля e-mail
var areaid = document.getElementById("textarea");
//Если символ @ не найден в строке получаем -1

if (area === "") {
    //Добавляем подкласс об ошибке!
    areaid.classList.add('is-invalid');
    //Удаляем подкласс валидности!
    named.classList.remove('is-valid');
    } else {
        //Удаляем подкласс об ошибке!
        areaid.classList.remove('is-invalid');
        //Добавляем класс валидности
        areaid.classList.add('is-valid');
}
});

//Событие выполниться при полной загрузке страницы
document.addEventListener("DOMContentLoaded", () => {
    alert("Страница загружена!");
    });
//Получаем список элементов родителя
buttons = document.querySelector('button');
//в 1 параметре - событие (щелчок по кнопке)
//во 2 - анонимная функция с контекстом вызвавшим событие
buttons.addEventListener('click', function(e) {
//метод, предотвращающий реакцию по умолчанию
e.preventDefault();
//Значение из поля e-mail
var email = document.getElementById("contact-email").value;
//Объект поля e-mail
var emailid = document.getElementById("contact-email");
//Если символ @ не найден в строке получаем -1
if (email.indexOf('@') == -1) {
//Добавляем подкласс об ошибке!
emailid.classList.add('is-invalid');
//Удаляем подкласс валидности!
emailid.classList.remove('is-valid');
} else {
//Удаляем подкласс об ошибке!
emailid.classList.remove('is-invalid');
//Добавляем класс валидности
emailid.classList.add('is-valid');
}
});
});

document.querySelector("#sign-btn").addEventListener("click", function() {
    document.querySelector("#sign-btn").style.display = "none";
    document.querySelector("#why-btn").style.display = "none";
    document.querySelector("#show-content").classList.remove("d-none");
});

document.querySelector("#out-btn").addEventListener("click", function() {
    document.querySelector("#sign-btn").style.display = "inline";
    document.querySelector("#why-btn").style.display = "inline";
    document.querySelector("#show-content").classList.add("d-none");
})