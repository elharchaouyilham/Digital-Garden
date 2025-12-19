
function validateForm() {
    let valid = true;

    const form = document.forms["regForm"];
    const username = form["username"].value.trim();
    const email = form["email"].value.trim();
    const password = form["password"].value;

    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    const passwordRegex = /^.{8,}$/;

    document.getElementById("error-username").textContent = "";
    document.getElementById("error-email").textContent = "";
    document.getElementById("error-password").textContent = "";

    if (username === "") {
        document.getElementById("error-username").textContent = "Nom requis";
        valid = false;
    }

    if (!emailRegex.test(email)) {
        document.getElementById("error-email").textContent = "Email invalide";
        valid = false;
    }

    if (!passwordRegex.test(password)) {
        document.getElementById("error-password").textContent = "Minimum 8 caractères";
        valid = false;
    }

    return valid;
}

