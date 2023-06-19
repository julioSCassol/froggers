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
  
  function addToCart(id) {
  
    $.post("../add_to_cart.php", { id: id })
      .done(function(data) {
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
  