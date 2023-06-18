function toggleMenu() {
  const slidingMenu = document.getElementById('sliding-menu');

  if (slidingMenu.classList.contains('menu-closed')) {
    slidingMenu.classList.remove('menu-closed');
  } else {
    slidingMenu.classList.add('menu-closed');
  }
}
window.onload = function() {
  document.getElementById('show-captcha').addEventListener('change', function() {
      if (this.checked) {
          var num1 = Math.floor(Math.random() * 10) + 1;
          var num2 = Math.floor(Math.random() * 10) + 1;

          document.getElementById('captcha').textContent = num1 + " + " + num2 + " = ?";
          document.getElementById('captcha_result').value = num1 + num2;

          document.getElementById('captcha-container').style.display = 'block';
      } else {
          document.getElementById('captcha-container').style.display = 'none';
      }
  });
}



document.getElementById('menu-button').addEventListener('click', toggleMenu);
document.getElementById('continue-shopping').addEventListener('click', toggleMenu);
document.getElementById('close-menu').addEventListener('click', toggleMenu);

const pagina = document.querySelector('.pagina');
pagina.style.minHeight = window.innerHeight + 'px';
