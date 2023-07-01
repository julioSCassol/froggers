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

  function editarEmail() {
    var emailSpan = document.getElementById("email");
    var email = emailSpan.textContent;
    
    var novoEmail = prompt("Digite o novo email:", email);
 
    if (novoEmail !== null && novoEmail !== "") {
        emailSpan.textContent = novoEmail;

        fetch('atualizar_email.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ novoEmail: novoEmail })
        })
        .then(function(response) {
            if (response.ok) {
                console.log("Email atualizado com sucesso no banco de dados.");
            } else {
                console.log("Erro ao atualizar o email no banco de dados.");
            }
        });
    }
}

function editarSenha() {
    var senhaSpan = document.getElementById("senha");
    var senha = senhaSpan.textContent;
    
    var novaSenha = prompt("Digite a nova senha:");
    
    if (novaSenha !== null && novaSenha !== "") {
        senhaSpan.textContent = "*".repeat(novaSenha.length);
        
        fetch('atualizar_senha.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ novaSenha: novaSenha })
        })
        .then(function(response) {
            if (response.ok) {
                console.log("Senha atualizada com sucesso no banco de dados.");
            } else {
                console.log("Erro ao atualizar a senha no banco de dados.");
            }
        });
    }
}
  