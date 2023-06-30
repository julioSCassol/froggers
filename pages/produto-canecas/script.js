function toggleMenu() {
    const slidingMenu = document.getElementById('sliding-menu');
    $(".swiper-button-next").show();
  
    if (slidingMenu.classList.contains('menu-closed')) {
      slidingMenu.classList.remove('menu-closed');
      $(".swiper-button-next").hide();
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
    const urlParams = new URLSearchParams(window.location.search);
    const viewedProductId = urlParams.get('id');
  
    fetch('nomes.php')
      .then(response => response.json())
      .then(produtos => {
        const catalog = document.querySelector('.swiper-wrapper');
  
        produtos.forEach(produto => {
          if (produto.id === viewedProductId) {
            return;
          }
          const catalogItem = document.createElement('div');
  
          catalogItem.className = 'swiper-slide';
          catalogItem.innerHTML = `
            <div class="catalog-item">
              <a href="/pages/produto-canecas/index.php?id=${produto.id}">
                <img src="/assets/canecas/${produto.nome}.png" alt="${produto.nome}" class="catalog-item-img">
              </a>
              <div class="title-wrapper">
                <h3 class="catalog-title">${produto.nome}</h3>
                <div class="comprar-button" onclick="addToCart(${produto.id})">Comprar</div>
                <span class="catalog-price">R$${parseFloat(produto.preco).toFixed(2)}</span>
              </div>
            </div>
          `;
          catalog.appendChild(catalogItem);
  
          
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

  document.querySelector('.zoom-container').addEventListener('mousemove', function(e) {
    var x = (e.pageX - this.offsetLeft)/this.offsetWidth * 100;
    var y = (e.pageY - this.offsetTop)/this.offsetHeight * 100;

    document.querySelector('.zoom-image').style.transformOrigin = x + '% ' + y + '%';
});

document.querySelector('.zoom-container').addEventListener('mouseleave', function(e) {
    document.querySelector('.zoom-image').style.transformOrigin = 'center center';
});

function getSelectedSize() {
  let sizeElement = document.querySelector('.quadrado.clicked .letra');
  if (sizeElement) {
      return sizeElement.textContent;
  } else {
      return null;
  }
}
  
function addToCart(id) {
  let size = getSelectedSize();
  console.log(size);

  $.post("../add_to_cart.php", { id: id, size: size })
      .done(function(data) {
        console.log("Item adicionado ao carrinho");
        displayCart();
      });
}
