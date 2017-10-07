//CHECKS

document.getElementById("surname").addEventListener("blur", function (e) { //Event when leaving the input box
    var regex = /^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{1,20}$/;
    var errorMsg = "";
    if (!regex.test(e.target.value)) {
        errorMsg = "Nom invalide"
    }
    var errorSurname = document.getElementById("errorSurname");
    errorSurname.textContent = errorMsg;
    errorSurname.style.color = "red";
});