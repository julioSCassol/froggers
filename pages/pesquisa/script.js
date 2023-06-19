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
    const urlParams = new URLSearchParams(window.location.search);
    const searchTerm = urlParams.get('search');

    fetch(`produtos.php?search=${searchTerm}`)
      .then(response => response.json())
      .then(data => {
        if (!data.productsFound) {
          alert('Produto não encontrado!');
          history.back();
        } else {
          const produtos = data.products;
          const searchResults = document.getElementById("catalog");
          searchResults.innerHTML = '';

          const sortValue = sortSelect.value;
          switch (sortValue) {
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
            let modeloDir = '';
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
              <a href="/pages/produto-${imageDir}/index.php?id=${produto.id}">
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
            });
          }});
        }});
        
        
      }
    fetchAndDisplayProducts();

    sortSelect.addEventListener('change', fetchAndDisplayProducts);
  });
  function addToCart(id) {

    $.post("../add_to_cart.php", { id: id })
      .done(function(data) {
        console.log("Item added to cart");
        displayCart();
      });
  }
  
  function removeItemFromCart(id) {
    $.post("../remove_from_cart.php", { id: id })
        .done(function(data) {
            console.log("Item removed from cart");
            displayCart();
        });
  }
  
  $(document).ready(function() {
    displayCart();
  });