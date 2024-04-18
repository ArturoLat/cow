function checkEmail() {
    var email = document.getElementById('client-email').value;
    var errorDiv = document.getElementById('email-error');
    if (!email) {
        errorDiv.innerHTML = '';
        return;
    }
    // Verificar si el email tiene un formato válido
    if (!validateEmail(email)) {
        errorDiv.innerHTML = 'Please enter a valid email address.';
        errorDiv.style.color = 'red';
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'servidor.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            if (response.exists) {
                errorDiv.innerHTML = 'Email is already registered.';
                errorDiv.style.color = 'red'; // Red for error
            } else {
                errorDiv.innerHTML = 'Email is available.';
                errorDiv.style.color = 'green'; // Green for success
            }
        }
    };
    xhr.send('action=checkEmail&email=' + encodeURIComponent(email));
}

function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}
