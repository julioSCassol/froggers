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

document.querySelectorAll('.quadrado').forEach(function(button) {
  button.addEventListener('click', function() {
    document.querySelectorAll('.quadrado').forEach(function(btn) {
      btn.classList.remove('clicked');
    });
    this.classList.add('clicked');
  });
});

function fetchAndDisplayProducts() {
  fetch('nomes.php')
    .then(response => response.json())
    .then(produtos => {
      const catalog = document.querySelector('.swiper-wrapper');

      produtos.forEach(produto => {
        const catalogItem = document.createElement('div');

        catalogItem.className = 'swiper-slide';
        catalogItem.innerHTML = `
          <div class="catalog-item">
            <a href="/pages/produto-camisetas/index.php?id=${produto.id}">
              <img src="/assets/camisetas/${produto.nome}.png" alt="${produto.nome}" class="catalog-item-img">
            </a>
            <div class="title-wrapper">
              <h3 class="catalog-title">${produto.nome}</h3>
              <div class="comprar-button" onclick="addToCart(${produto.id})">Comprar</div>
              <span class="catalog-price">R$${parseFloat(produto.preco).toFixed(2)}</span>
            </div>
          </div>
        `;
        catalog.appendChild(catalogItem);

        const catalogItemImage = catalogItem.querySelector('.catalog-item-img');
        catalogItem.addEventListener('mouseenter', () => {
          catalogItemImage.src = `/assets/modelo/modelo ${produto.nome}.png`;
        });
        catalogItem.addEventListener('mouseleave', () => {
          catalogItemImage.src = `/assets/camisetas/${produto.nome}.png`;
        });
      });

      new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 20,
        slidesOffsetAfter: 0,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
        breakpoints: {
          640: {
            slidesPerView: 2
          },
          768: {
            slidesPerView: 3
          },
          1024: {
            slidesPerView: 4
          }
        }
      });

    })
    .catch(error => console.error('Error:', error));
}

fetchAndDisplayProducts();

function displayCart() {
  $.get("../display_cart.php")
    .done(function(data) {
      $(".cart-catalog").html(data);
    });
}

function addToCart(id) {
  $('.Sapo-triste').hide();
  $.post("../add_to_cart.php", { id: id })
    .done(function(data) {
      console.log("Item added to cart");
      displayCart();
    });
}

// Call displayCart() when the page is loaded to display initial cart items
$(document).ready(function() {
  displayCart();
});
