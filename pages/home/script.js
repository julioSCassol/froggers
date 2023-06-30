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

const carouselItems = document.querySelectorAll('.carousel-item');
let currentIndex = 0;

function showSlide(index) {
  carouselItems.forEach(item => {
      item.classList.remove('active');
  });

  carouselItems[index].classList.add('active');
}

function nextSlide() {
  currentIndex++;
  if (currentIndex >= carouselItems.length) {
      currentIndex = 0;
  }
  showSlide(currentIndex);
}

setInterval(nextSlide, 4000); 

showSlide(currentIndex);

document.addEventListener('DOMContentLoaded', (event) => {
function fetchAndDisplayProducts() {
  fetch('produtos.php')
    .then(response => response.json())
    .then(data => {
      const produtos = data.products;
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
        <div class="all-catalog">
        <a href="/pages/produto-${imageDir}/index.php?id=${produto.id}">
            <img src="/assets/${imageDir}/${produto.nome}.png" alt="${produto.nome}" class="catalog-item-img">
          </a>
          <div class="title-wrapper">
            <h3 class="catalog-title">${produto.nome}</h3>
            <div class="comprar-button" onclick="window.location.href='/pages/produto-camisetas/index.php?id=${produto.id}'">Comprar</div>
            <span class="catalog-price">R$${parseFloat(produto.preco).toFixed(2)}</span>
          </div>
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
        }
      });
    });
}

fetchAndDisplayProducts();

const sortSelect = document.getElementById('sort-select');
sortSelect.addEventListener('change', fetchAndDisplayProducts);
});

function displayCart() {
  $.get("../display_cart.php")
    .done(function(data) {
      if (data) {
        $(".cart-catalog").html(data);
        $('#confirm-payment').show();
      } else {
        $(".cart-catalog").html("O carrinho está vazio.");
        $('#confirm-payment').hide();
      }
  });
}

$(document).ready(function() {
  displayCart();
});

$(document).ready(function() {
  displayCart();

  $('#confirm-payment').click(function() {
    window.location.href = "/pages/pagamento/index.php";
  });
});

function emptyCart() {
  $.post("../empty_cart.php")
    .done(function(data) {
      console.log("Carrinho esvaziado");
      displayCart();
    });
}
