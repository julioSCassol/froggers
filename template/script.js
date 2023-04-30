document.getElementById('menu-button').addEventListener('click', function () {
    const slidingMenu = document.getElementById('sliding-menu');
    const overlay = document.getElementById('overlay');
  
    if (slidingMenu.classList.contains('menu-closed')) {
      slidingMenu.classList.remove('menu-closed');
      overlay.classList.remove('overlay-hidden');
    } else {
      slidingMenu.classList.add('menu-closed');
      overlay.classList.add('overlay-hidden');
    }
  });
  
  // Add this code to close the menu when the overlay is clicked
  document.getElementById('overlay').addEventListener('click', function () {
    const slidingMenu = document.getElementById('sliding-menu');
    const overlay = document.getElementById('overlay');
  
    slidingMenu.classList.add('menu-closed');
    overlay.classList.add('overlay-hidden');
  });
  