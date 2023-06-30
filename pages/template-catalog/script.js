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

const catalogItems = [];

const iconsFolder = '/assets/icons/';

const request = new XMLHttpRequest();
request.open('GET', iconsFolder);
request.responseType = 'document';
request.onload = function() {
  const response = request.response;
  const links = response.getElementsByTagName('a');
  for (let i = 0; i < links.length; i++) {
    const link = links[i].href;
    if (link.endsWith('.png')) {
      const title = decodeURIComponent(link.substring(link.lastIndexOf('/') + 1, link.lastIndexOf('.')).replace(/[-_]/g, ' '));
      catalogItems.push({
        id: catalogItems.length + 1,
        title: `Camiseta ${title}`,
        titleOG: `${title}`,
        image: link,
        price: `R$0,00`,
      });      
    }
  }

  const catalogElement = document.getElementById('catalog');

  catalogItems.forEach(item => {
    const catalogItem = document.createElement('div');
    catalogItem.className = 'catalog-item';
    const price = item.title.includes('Camiseta') ? 'R$39.99' : item.price;
    catalogItem.innerHTML = `
      <img src="${item.image}" alt="${item.title}" class="catalog-item-img">
      <div class="title-wrapper">
        <h3 class="catalog-title">${item.title}</h3>
        <div class="comprar-button">Comprar</div>
        <span id="catalog-price">${price}</span>
      </div>
        
    `;
    catalogElement.appendChild(catalogItem);
  
    const catalogItemImage = catalogItem.querySelector('.catalog-item-img');
    catalogItem.addEventListener('mouseenter', () => {
      catalogItemImage.src = `/assets/modelo/modelo ${item.titleOG}.png`;
    });    
    catalogItem.addEventListener('mouseleave', () => {
      catalogItemImage.src = item.image;
    });
    
  });
  
};
request.send();

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
