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

    if (novoEmail !== null && novoEmail !== "" && novoEmail.includes("@")) {
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
    } else {
        alert("Por favor, insira um endereço de email válido.")
    }
}


function editarSenha() {
    var senhaSpan = document.getElementById("senha");
    var senha = senhaSpan.textContent;
    
    var novaSenha = prompt("Digite a nova senha:");

    if (novaSenha !== null && novaSenha !== "") {
      if (!/[A-Z]/.test(novaSenha)) {
        alert("Senha deve conter ao menos uma letra maiuscula!");
    } else if (!/[0-9]/.test(novaSenha)) {
        alert("Senha deve conter ao menos um numero!");
    } else if (novaSenha.length < 6) {
        alert("A senha deve ter no mínimo 6 caracteres!");
    } else {
      
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
}
function editarNome() {
  var nomeSpan = document.getElementById("nome");
  var nome = nomeSpan.textContent;
  
  var novoNome = prompt("Digite o novo nome:", nome);

  if (novoNome !== null && novoNome !== "") {
      nomeSpan.textContent = novoNome;

      fetch('atualizar_nome.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json'
          },
          body: JSON.stringify({ novoNome: novoNome })
      })
      .then(function(response) {
          if (response.ok) {
              console.log("Nome atualizado com sucesso no banco de dados.");
          } else {
              console.log("Erro ao atualizar o nome no banco de dados.");
          }
      });
  } else {
      alert("Por favor, insira um nome válido.")
  }
}

  