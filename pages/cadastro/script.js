function toggleMenu() {
  const slidingMenu = document.getElementById('sliding-menu');

  if (slidingMenu.classList.contains('menu-closed')) {
    slidingMenu.classList.remove('menu-closed');
  } else {
    slidingMenu.classList.add('menu-closed');
  }
}
window.onload = function() {
  document.getElementById('show-captcha').addEventListener('change', function() {
      if (this.checked) {
          var num1 = Math.floor(Math.random() * 10) + 1;
          var num2 = Math.floor(Math.random() * 10) + 1;

          document.getElementById('captcha').textContent = num1 + " + " + num2 + " = ?";
          document.getElementById('captcha_result').value = num1 + num2;

          document.getElementById('captcha-container').style.display = 'block';
      } else {
          document.getElementById('captcha-container').style.display = 'none';
      }
  });
}
document.querySelector('.login-form').addEventListener('submit', function(event) {
  const nome = document.querySelector('input[name="name"]');
  const email = document.querySelector('input[name="email"]');
  const senha = document.querySelector('input[name="password"]');
  const senha_confirmada = document.querySelector('input[name="confirm_password"]');

  if (!nome.value || !email.value || !senha.value || !senha_confirmada.value) {
      event.preventDefault();
      alert("Por favor preencha todos os campos");
  }
});



document.getElementById('menu-button').addEventListener('click', toggleMenu);
document.getElementById('continue-shopping').addEventListener('click', toggleMenu);
document.getElementById('close-menu').addEventListener('click', toggleMenu);

const pagina = document.querySelector('.pagina');
pagina.style.minHeight = window.innerHeight + 'px';

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