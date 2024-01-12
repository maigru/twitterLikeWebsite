function validateLogin() {
  const username = document.getElementById("username");
  const usernameErr = document.getElementById("nameErr");
  usernameErr.textContent = "";
  if (username.validity.tooLong) {
    usernameErr.textContent = "Username must be shorter than 40 characters";
    return false;
  } else if (username.validity.valueMissing) {
    usernameErr.textContent = "You must enter username";
    return false;
  } else if (username.validity.patternMismatch) {
    usernameErr.textContent =
      "Username should only contain letters, numbers and _ symbol";
    return false;
  }

  const password = document.getElementById("password");
  const passwordErr = document.getElementById("passErr");
  passwordErr.textContent = "";
  if (password.validity.tooShort) {
    passwordErr.textContent = "Password must be longer than 8 characters";
    return false;
  } else if (password.validity.tooLong) {
    passwordErr.textContent = "Password must be shorter than 255 characters";
    return false;
  } else if (password.validity.valueMissing) {
    passwordErr.textContent = "You must enter password";
    return false;
  } else if (password.validity.patternMismatch) {
    passwordErr.textContent =
      "Password should have at least one letter, one capital letter and one digit";
    return false;
  }
}

function validateSignup() {
  const name = document.getElementById("name");
  const nameErr = document.getElementById("nameErr");
  nameErr.textContent = "";
  if (name.validity.valueMissing) {
    nameErr.textContent = "You must enter name";
    return false;
  } else if (name.validity.tooLong) {
    nameErr.textContent = "Name must be shorter than 100 characters";
    return false;
  }

  const username = document.getElementById("username");
  const usernameErr = document.getElementById("usernameErr");
  usernameErr.textContent = "";
  if (username.validity.tooLong) {
    usernameErr.textContent = "Username must be shorter than 40 characters";
    return false;
  } else if (username.validity.valueMissing) {
    usernameErr.textContent = "You must enter username";
    return false;
  } else if (username.validity.patternMismatch) {
    usernameErr.textContent =
      "Username should only contain letters, numbers and _ symbol";
    return false;
  }

  const password = document.getElementById("password");
  const passwordErr = document.getElementById("passErr");
  passwordErr.textContent = "";
  if (password.validity.tooShort) {
    passwordErr.textContent = "Password must be longer than 8 characters";
    return false;
  } else if (password.validity.tooLong) {
    passwordErr.textContent = "Password must be shorter than 255 characters";
    return false;
  } else if (password.validity.valueMissing) {
    passwordErr.textContent = "You must enter password";
    return false;
  } else if (password.validity.patternMismatch) {
    passwordErr.textContent =
      "Password should have at least one letter, one capital letter and one digit";
    return false;
  }
}
