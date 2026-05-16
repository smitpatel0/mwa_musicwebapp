function validateForm() {
  const username = document.getElementById('username').value.trim();
  const email = document.getElementById('email').value.trim();
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirm-password').value;
  const phoneNumber = document.getElementById('phone_number').value.trim();


if (!username) {
  alert("Username is required");
  return false;
}

  if (!email) {
    alert("Email is required");
  return false;
  }
 if(!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)){
     alert("Invalid email format");
      return false;
 }

  if (!password) {
      alert("Password is required");
      return false;
  }
 if (password.length < 8 || password.length > 20) {
       alert('Password must be between 8 and 20 characters');
    return false;
 }
 
  return true;
}