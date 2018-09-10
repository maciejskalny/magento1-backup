function validateForm() {
    var radios = document.getElementsByName("storepoll");
    var formValid = false;

    var i = 0;
    while (!formValid && i < radios.length) {
        if (radios[i].checked) {
            formValid = true;
        }
        i++;
    }

    if (!formValid) alert("You must choose something!");
    return formValid;
}
