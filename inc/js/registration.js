//CHECKS

document.getElementById("surname").addEventListener("blur", function (e) { //Event when leaving the input box
    var regex = /^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{1,20}$/;
    var errorMsg = "";
    if (!regex.test(e.target.value)) {
        errorMsg = " Nom invalide"
    }
    var nameError = document.getElementById("nameError");
    nameError.textContent = errorMsg;
    nameError.style.color = "red";
});

document.getElementById("name").addEventListener("blur", function (e) { //Event when leaving the input box
    var regex = /^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{1,20}$/;
    var errorMsg = "";
    if (!regex.test(e.target.value)) {
        errorMsg = " Prénom invalide"
    }
    var nameError = document.getElementById("nameError");
    nameError.textContent = errorMsg;
    nameError.style.color = "red";
});

document.getElementById("email").addEventListener("blur", function (e) { //Event when leaving the input box
    var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var errorMsg = "";
    if (!regex.test(e.target.value)) {
        errorMsg = " Format de l'adresse mail invalide.";
    }
    var emailError = document.getElementById("emailError");
    emailError.textContent = errorMsg;
    emailError.style.color = "red";
});

document.getElementById("phone").addEventListener("blur", function (e) { //Event when leaving the input box
    var regex = /^[0-9]{9,11}$/;
    var errorMsg = "";
    if (!regex.test(e.target.value)) {
        errorMsg = " Téléphone invalide"
    }
    var nameError = document.getElementById("phoneError");
    phoneError.textContent = errorMsg;
    phoneError.style.color = "red";
});

// Password and Email validation
var form = document.querySelector("form"); //Saving the form into the variable form;

// Password Check
document.getElementById("passCheck").addEventListener("blur", function (e) {
    var password = form.elements.password.value; //Saving the typed password
    var passCheck = form.elements.passCheck.value; //Saving the typed passCheck
    var passError = document.getElementById("passwordError"); //Getting the passwordError span
    var errorMsg = " Mots de passe identiques !";
    var errorMsgColor = "green";
    if (password === passCheck)
    {
        if (password.length <= 6) {
            errorMsg = " Erreur : la longueur minimale du mot de passe est de 6 caractères";
            errorMsgColor ="red";
        }
    } else {
        errorMsg = " Erreur : les mots de passe saisis sont différents";
        errorMsgColor ="red";
    }
    passError.textContent = errorMsg;
    passError.style.color = errorMsgColor;
});

// Email Check
document.getElementById("emailCheck").addEventListener("blur", function (e) {
    var email = form.elements.email.value; //Saving the typed email
    var emailCheck = form.elements.emailCheck.value; //Saving the typed emailCheck
    var emailError = document.getElementById("emailError"); //Getting the passwordError span
    var errorMsg = " Mots de passe identiques !";
    var errorMsgColor = "green";
    if (email !== emailCheck)
    {
        errorMsg = " Erreur : les emails saisis sont différents";
        errorMsgColor ="red";
    }
    emailError.textContent = errorMsg;
    emailError.style.color = errorMsgColor;
});