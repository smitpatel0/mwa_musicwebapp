// Validation for Login Form
function validateLoginForm() {
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();

    if (!email || !password) {
        alert("Email and Password are required!");
        return false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    return true;
}

// Validation for Change Password Form
function validateChangePasswordForm() {
    const currentPassword = document.getElementById("current-password").value.trim();
    const newPassword = document.getElementById("new-password").value.trim();
    const confirmPassword = document.getElementById("confirm-password").value.trim();

    if (!currentPassword || !newPassword || !confirmPassword) {
        alert("All fields are required!");
        return false;
    }

    if (newPassword !== confirmPassword) {
        alert("New Password and Confirm Password do not match!");
        return false;
    }

    if (newPassword.length < 6) {
        alert("New Password must be at least 6 characters long.");
        return false;
    }

    return true;
}

// Toggle between forms
function showChangePassword() {
    document.getElementById("login-form").style.display = "none";
    document.getElementById("change-password-form").style.display = "block";
}

function showLoginForm() {
    document.getElementById("change-password-form").style.display = "none";
    document.getElementById("login-form").style.display = "block";
}

// Handle Login Button Click
function login() {
    if (validateLoginForm()) {
        document.querySelector("#login-form form").submit();
    }
}

// Handle Change Password Button Click
function changePassword() {
    if (validateChangePasswordForm()) {
        document.querySelector("#change-password-form form").submit();
    }
}
