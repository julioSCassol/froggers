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


function displayCart() {
  $.get("../display_cart.php")
    .done(function(data) {
      if (data) {
        console.log(data);
        $(".cart-catalog").html(data);
      } else {
        $(".cart-catalog").html("O carrinho está vazio.");
      }
    });
}