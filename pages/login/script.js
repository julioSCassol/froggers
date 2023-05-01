function toggleMenu() {
  const slidingMenu = document.getElementById('sliding-menu');
  const overlay = document.getElementById('overlay');

  if (slidingMenu.classList.contains('menu-closed')) {
    slidingMenu.classList.remove('menu-closed');
    overlay.classList.remove('overlay-hidden');
  } else {
    slidingMenu.classList.add('menu-closed');
    overlay.classList.add('overlay-hidden');
  }
}

document.getElementById('menu-button').addEventListener('click', toggleMenu);
document.getElementById('continue-shopping').addEventListener('click', toggleMenu);

document.getElementById('overlay').addEventListener('click', function () {
  const slidingMenu = document.getElementById('sliding-menu');
  const overlay = document.getElementById('overlay');

  slidingMenu.classList.add('menu-closed');
  overlay.classList.add('overlay-hidden');
});

const pagina = document.querySelector('.pagina');
pagina.style.minHeight = window.innerHeight + 'px';
