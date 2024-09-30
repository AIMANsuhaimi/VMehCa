document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById("loginModal");
    var btn = document.getElementById("loginBtn");
    var closeBtn = document.getElementsByClassName("close")[0];
    var usernameField = document.getElementById("username");
    var passwordField = document.getElementById("password");
    var signinBtn = document.querySelector('button[name="signin"]');

    btn.onclick = function () {
        modal.style.display = "flex";
    }

    closeBtn.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Combined validation for both username and password
    signinBtn.onclick = function (event) {
        if (usernameField.value.trim() === "") {
            event.preventDefault(); // Stop the form from submitting
            alert("Please enter your username.");
            usernameField.focus(); // Focus on the username field
            return; // Exit the function if username is empty
        }

        if (passwordField.value.trim() === "") {
            event.preventDefault(); // Stop the form from submitting
            alert("Please enter your password.");
            passwordField.focus(); // Focus on the password field
            return; // Exit the function if password is empty
        }
    }
});
