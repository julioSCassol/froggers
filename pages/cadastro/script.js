function togglePasswordVisibility() {
  const passwordField = document.querySelector('input[name="password"]');
  const confirmPasswordField = document.querySelector('input[name="confirm_password"]');
  const passwordToggle = document.querySelector('.password-toggle');

  if (passwordField.type === 'password') {
    passwordField.type = 'text';
    confirmPasswordField.type = 'text';
    passwordToggle.textContent = 'visibility';
  } else {
    passwordField.type = 'password';
    confirmPasswordField.type = 'password';
    passwordToggle.textContent = 'visibility_off';
  }
}

function handleFormSubmit(event) {
  const nome = document.querySelector('input[name="name"]');
  const email = document.querySelector('input[name="email"]');
  const senha = document.querySelector('input[name="password"]');
  const senhaConfirmada = document.querySelector('input[name="confirm_password"]');

  if (!nome.value || !email.value || !senha.value || !senhaConfirmada.value) {
    event.preventDefault();
    alert("Por favor preencha todos os campos");
  }
}

function generateCaptcha() {
  const num1 = Math.floor(Math.random() * 10) + 1;
  const num2 = Math.floor(Math.random() * 10) + 1;

  const captchaContainer = document.getElementById('captcha');
  const captchaResultField = document.getElementById('captcha_result');

  captchaContainer.textContent = num1 + " + " + num2 + " = ?";
  captchaResultField.value = num1 + num2;
}

function toggleCaptcha() {
  const captchaContainer = document.getElementById('captcha-container');
  const captchaCheckbox = document.getElementById('show-captcha');

  if (captchaCheckbox.checked) {
    generateCaptcha();
    captchaContainer.style.display = 'block';
  } else {
    captchaContainer.style.display = 'none';
  }
}

window.onload = function() {
  const passwordToggle = document.querySelector('.password-toggle');
  passwordToggle.addEventListener('click', togglePasswordVisibility);

  const loginForm = document.querySelector('.login-form');
  loginForm.addEventListener('submit', handleFormSubmit);

  const captchaCheckbox = document.getElementById('show-captcha');
  captchaCheckbox.addEventListener('change', toggleCaptcha);
};
