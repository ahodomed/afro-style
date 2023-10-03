 function validatePassword(password) {
  // Au moins 8 caractères
  if (password.length < 8) {
    return false;
  }

  // Au moins une lettre majuscule
  if (!/[A-Z]/.test(password)) {
    return false;
  }

  // Au moins une lettre minuscule
  if (!/[a-z]/.test(password)) {
    return false;
  }

  // Au moins un chiffre
  if (!/[0-9]/.test(password)) {
    return false;
  }

  // Au moins un caractère spécial (par exemple, !, @, #, $, etc.)
  if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password)) {
    return false;
  }

  // Le mot de passe est valide
  return true;


  }

  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('confirm-password');
  const passwordError = document.getElementById('password-error');
  const confirmPasswordError = document.getElementById('confirm-password-error');
  const registerButton = document.getElementById('register-button');

  passwordInput.addEventListener('input', function () {
    const password = this.value;

    if (validatePassword(password)) {
      passwordError.textContent = '';
    } else {
      passwordError.textContent = 'Le mot de passe doit contenir au moins 8 caractères, dont une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.';
    }
    updateRegisterButtonState();
  });

  confirmPasswordInput.addEventListener('input', function () {
    const password = passwordInput.value;
    const confirmPassword = this.value;

    if (password === confirmPassword) {
      confirmPasswordError.textContent = '';
    } else {
      confirmPasswordError.textContent = 'Les mots de passe ne correspondent pas.';
    }
    updateRegisterButtonState();
  });

  function updateRegisterButtonState() {
    const passwordIsValid = validatePassword(passwordInput.value);
    const passwordsMatch = passwordInput.value === confirmPasswordInput.value;

    if (passwordIsValid && passwordsMatch) {
      registerButton.removeAttribute('disabled');
    } else {
      registerButton.setAttribute('disabled', 'disabled');
    }
  }
