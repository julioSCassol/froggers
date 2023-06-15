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


document.addEventListener('DOMContentLoaded', (event) => {
  const sortSelect = document.getElementById('sort');
  
  function fetchAndDisplayProducts() {
    fetch('nomes.php')
      .then(response => response.json())
      .then(produtos => {
        const sortValue = sortSelect.value;
        switch(sortValue) {
          case 'name-asc':
            produtos.sort((a, b) => a.nome.localeCompare(b.nome));
            break;
          case 'name-desc':
            produtos.sort((a, b) => b.nome.localeCompare(a.nome));
            break;
        }
  
        const catalog = document.getElementById('catalog');
        catalog.innerHTML = '';

        produtos.forEach(produto => {
          const catalogItem = document.createElement('div');

          catalogItem.className = 'catalog-item';
          catalogItem.innerHTML = `
              <a href="/pages/produto-camisetas/index.php?id=${produto.id}">
                <img src="/assets/canecas/${produto.nome}.png" alt="${produto.nome}" class="catalog-item-img">
              </a>
              <div class="title-wrapper">
              <h3 class="catalog-title">${produto.nome}</h3>
              <div class="comprar-button">Comprar</div>
              <span class="catalog-price">R$${parseFloat(produto.preco).toFixed(2)}</span>
            </div>
          `;
          catalog.appendChild(catalogItem);
        });
      })
      .catch(error => console.error('Error:', error));
  }
  
  fetchAndDisplayProducts();

  sortSelect.addEventListener('change', fetchAndDisplayProducts);
});
