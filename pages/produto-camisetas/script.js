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
        // remove the clicked class from all buttons
        document.querySelectorAll('.quadrado').forEach(function(btn) {
            btn.classList.remove('clicked');
        });
        // add the clicked class to the clicked button
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
              <div class="comprar-button" onclick="window.location.href='/pages/produto-camisetas/index.php?id=${produto.id}'">Comprar</div>
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

// Initialize Swiper carousel
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

function addToCart() {
  fetch('../cart.php');
  var productID = $("#botao-grande").data('productid');

  $.ajax({
    url: '../cart.php',
    type: 'POST',
    data: {
      productID: productID
    },
    success: function(produto) {
      var newCartItem = '<div class="cart-item">';
      newCartItem += '<div class="product-name">' + produto.nome + '</div>';
      newCartItem += '<div class="product-quantity">Quantity: 1</div>';
      newCartItem += '<div class="product-price">Price: ' + produto.preco + '</div>';
      newCartItem += '</div>';

      $(".cart-catalog").append(newCartItem);

      $('.Sapo-triste').hide();
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    }
  });
}

$(document).ready(function() {
  $.ajax({
    url: '../getCartCount.php',
    type: 'GET',
    success: function(count) {
      if(count > 0) {
        $('.Sapo-triste').hide();
      }
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    }
  });
});
