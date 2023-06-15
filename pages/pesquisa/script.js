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

document.getElementById("search-form").addEventListener("submit", function(e) {
  e.preventDefault();
  fetchAndDisplayProducts();
});

function fetchAndDisplayProducts() {
  const searchTerm = document.getElementById("search-input").value;
  
  fetch(`produtos.php?search=${searchTerm}`)
    .then(response => response.json())
    .then(produtos => {
      const searchResults = document.getElementById("catalog");
      // Clear the existing products
      searchResults.innerHTML = '';
      
      produtos.forEach(produto => {
        let imageDir = '';
        switch (produto.IDcategoria) {
          case '1':
            imageDir = 'moletons';
            break;
          case '2':
            imageDir = 'camisetas';
            break;
          case '3':
            imageDir = 'canecas';
            break;
        }
        let modeloDir = ';'
        switch (produto.IDcategoria) {
          case '1':
            modeloDir = 'modeloM';
            break;
          case '2':
            modeloDir = 'modelo';
            break;
        }
        const catalogItem = document.createElement('div');
        catalogItem.className = 'catalog-item';
        catalogItem.innerHTML = `
          <a href="/pages/produto-camisetas/index.php?id=${produto.id}">
            <img src="/assets/${imageDir}/${produto.nome}.png" alt="${produto.nome}" class="catalog-item-img">
          </a>  
          <div class="title-wrapper">
            <h3 class="catalog-title">${produto.nome}</h3>
            <div class="comprar-button" onclick="window.location.href='/pages/produto-camisetas/index.php?id=${produto.id}'">Comprar</div>
            <span class="catalog-price">R$${parseFloat(produto.preco).toFixed(2)}</span>
          </div>
        `;
        catalog.appendChild(catalogItem);
        if(produto.IDcategoria != '3'){
        const catalogItemImage = catalogItem.querySelector('.catalog-item-img');
        catalogItem.addEventListener('mouseenter', () => {
          catalogItemImage.src = `/assets/${modeloDir}/modelo ${produto.nome}.png`;
        });    
        catalogItem.addEventListener('mouseleave', () => {
          catalogItemImage.src = `/assets/${imageDir}/${produto.nome}.png`;
        });}
      });
    });
}