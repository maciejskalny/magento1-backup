function validateGuestBook()
{
    var name = document.getElementById('name').value;
    var lastname = document.getElementById('lastname').value;
    var email = document.getElementById('email').value;

    if (validateSimpleText(name) && validateSimpleText(lastname) && validateEmail(email)) {
        return true;
    } else {
        alert("Something went wrong.");
        return false;
    }
}

function validateEmail(email) {
    var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(email);
}

function validateSimpleText(text) {
    var regex = /^[A-Z]{1}[a-z]{1,19}$/;
    return regex.test(text);
}
