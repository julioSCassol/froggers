<?php
session_start();
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_SESSION['cart'])) {
      foreach ($_SESSION['cart'] as $productId => $quantity) {
        $quantidade = $quantity['quantidade']; 
        $stmt = $conn->prepare("UPDATE produtos SET quantidade = quantidade - ? WHERE id = ?");
        $stmt->bind_param('ii', $quantidade, $productId);
        $stmt->execute();
        
      }
    }
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $id => $item) {
          unset($_SESSION['cart'][$id]);
          $stmt = $conn->prepare("DELETE FROM itens_pedido WHERE IDprodutos = ? AND IDpedidos = ?");
          $stmt->bind_param("ii", $id, $IDpedido);
          $stmt->execute();
        }
      }
      
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Froggers</title>
  <link rel="icon" type="image/png" href="/assets/images/logo.png">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet"> 
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
  <div class="pagina">
    <div id="header">
    <div id="topper">
                    <a href="/pages/home/index.php">
                        <div class="logo-container">
                            <img class="logo-completa" src="/assets/images/logo-completa.png" alt="logo-completa">
                        </div>
                    </a>
                    <div class="search-container">
                        <form id="search-form" action="/pages/pesquisa/" method="GET">
                            <input id="search-input" type="text" name="search" placeholder="Search...">
                            <button type="submit"> <span class="material-symbols-outlined">arrow_forward_ios</span></button>
                        </form>
                    </div>
                    
                    <div class="icones">
                        <div class="conta">
                            <a id=conta-link href="/pages/login/index.php">
                                <span class="material-icons">person</span>
                                <span id=username><?php echo $_SESSION['username']; ?></span>
                            </a>
                        </div>
                    
                        <span id="menu-button" class="material-icons">shopping_bag</span>
                        
                    </div>
                    <div id="sliding-menu" class="menu-closed">
                        <div id="header-menu">
                            <i id="close-menu" class="material-icons">clear</i>
                        </div>

                        <div class="cart-catalog">
                        </div>
                        <div id="menu-footer">
                            <span id="continue-shopping" class="carrinho-vazio"><u>Continuar Comprando</u></span>

                            <button id="empty-cart" onclick="emptyCart()">Esvaziar Carrinho</button>
                        </div>
                    </div>
                </div>
                    <link rel="stylesheet" type="text/css" href="style.css">
                    </head>
    </div>
    <div class="form-container">
      <form class="login-form" action="/pages/pagamento/index.php" method="post">
        <input type="text" name="nome_cartao" placeholder="Nome impresso no cartão" required>
        <input type="text" name="numero_cartao" placeholder="Número do cartão" required>
        <div class="caixa-senha">
          <input id="data_validade" type="text" name="data_validade" placeholder="MM/AAAA" required>
          <input type="text" name="codigo_seguranca" placeholder="CVV" required>
        </div>
        <div class="checkbox-div">
          <label class="custom-checkbox"> 
            <input type="checkbox" id="show-captcha" name="show-captcha">
            <span id="CAPTCHA">Aceitos os<span href=""> termos de uso</span></span> 
            <span class="checkmark"></span>
          </label>
        </div>
        <div id="captcha-container" style="display: none;">
          <input type="hidden" name="captcha_result" id="captcha_result">
          <div id="captcha"></div>
          <input type="text" name="captcha" placeholder="Digite o resultado">
        </div>
        <button type="submit">Registrar</button>
      </form>
    </div>
    <div id="footer">
    <div id="footer">
            <footer>
            <div class="Atendimento">
                Atendimento:
                <div class="Itens">
                    sac@froggers.com.br
                    <span style="font-family: 'Material Icons', sans-serif;">mail</span>
                </div>
            </div>
            <div class="redes_footer">
                Siga nossas redes:
                <div class= "imagens-divlegal">
                <a href="https://www.instagram.com/froggersoficial/">
                <img class="redes" src="/assets/images/logo-instagram.png" alt="redes">
                </a> 
                <a href="https://twitter.com/FroggersOFC">
                <img class="redes" src="/assets/images/logo-twitter.png" alt="redes">
                </a>  
                </div>
            </div>
            <div class="Ajuda">
                Ajuda:
                <div class="Itens">
                    <div class="Perguntas Frequentes">
                        Perguntas Frequentes
                        <span style="font-family: 'Material Icons', sans-serif;">help</span>
                    </div>
                    <div class="Quem Somos">
                        Quem Somos
                        <span style="font-family: 'Material Icons', sans-serif;">info</span>
                    </div>
                    <div class="Fale Conosco">
                        Fale Conosco
                        <span style="font-family: 'Material Icons', sans-serif;">call</span>
                    </div>
                </div>
            </div>
        </footer>
        </div> 
        <script src="script.js"></script>
        <script>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $("#data_validade").datepicker({
        dateFormat: "mm/yy", 
        changeMonth: true, 
        changeYear: true, 
        showButtonPanel: true, 
        onClose: function(dateText, inst) {
          $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
      });
    });
  </script>
</body>
</html>
