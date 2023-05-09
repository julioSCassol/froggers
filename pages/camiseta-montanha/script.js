function toggleMenu() {
    const slidingMenu = document.getElementById('sliding-menu');
  
    if (slidingMenu.classList.contains('menu-closed')) {
      slidingMenu.classList.remove('menu-closed');
    } else {
      slidingMenu.classList.add('menu-closed');
    }
  }
  
  document.getElementById('menu-button').addEventListener('click', toggleMenu);
  document.getElementById('continue-shopping').addEventListener('click', toggleMenu);
  document.getElementById('close-menu').addEventListener('click', toggleMenu);
  
  const pagina = document.querySelector('.pagina');
  pagina.style.minHeight = window.innerHeight + 'px';
  
  const quadrados = document.querySelectorAll('.quadrado');

  quadrados.forEach(quadrado => {
    quadrado.addEventListener('click', () => {
      quadrados.forEach(q => q.classList.remove('selecionado'));
      quadrado.classList.add('selecionado');
    });
  });  