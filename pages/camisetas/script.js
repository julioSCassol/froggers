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

const catalogItems = [
  {
    id: 1,
    title: "T-Shirt",
    image: "/assets/icons/camisa chorão ico1teste.png",
  },
  {
    id: 2,
    title: "Sneakers",
    image: "/assets/icons/camisa shinjo ico.png",
  },
  {
    id: 3,
    title: "Backpack",
    image: "/assets/icons/hanna ico.png",
  },
  {
    id: 4,
    title: "Smartphone",
    image: "https://via.placeholder.com/150/CC33FF/FFFFFF/?text=Smartphone",
  },
  {
      id: 5,
      title: "Headphones",
      image: "https://via.placeholder.com/150/FF33A7/FFFFFF/?text=Headphones",
  },
  {
    id: 6,
    title: "Headphones",
    image: "https://via.placeholder.com/150/FF33A7/FFFFFF/?text=Headphones",
  },
  {
    id: 7,
    title: "Headphones",
    image: "https://via.placeholder.com/150/FF33A7/FFFFFF/?text=Headphones",
  },
  {
    id: 8,
    title: "Headphones",
    image: "https://via.placeholder.com/150/FF33A7/FFFFFF/?text=Headphones",
  },
];


const catalogElement = document.getElementById('catalog');

catalogItems.forEach(item => {
  const catalogItem = document.createElement('div');
  catalogItem.className = 'catalog-item';
  catalogItem.innerHTML = `
    <img src="${item.image}" alt="${item.title}">
    <h3>${item.title}</h3>
  `;
  catalogElement.appendChild(catalogItem);
});

