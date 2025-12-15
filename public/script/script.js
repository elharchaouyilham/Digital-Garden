
function validateForm() {
    let username = document.forms["regForm"]["username"].value.trim();
    let password = document.forms["regForm"]["password"].value.trim();
    let confirm = document.forms["regForm"]["confirm"].value.trim();

    let errors = [];

    if (!username.match(/^[a-zA-Z0-9]{3,}$/)) {
        errors.push("Le nom d'utilisateur doit être alphanumérique et contenir au moins 3 caractères.");
    }

    if (password.length < 6) {
        errors.push("Le mot de passe doit contenir au moins 6 caractères.");
    }

    if (password !== confirm) {
        errors.push("Les mots de passe ne correspondent pas.");
    }

    if (errors.length > 0) {
        alert(errors.join("\n"));
        return false;
    }

    return true;
}
