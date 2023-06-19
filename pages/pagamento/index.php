<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "Dados de pagamento recebidos:<br>";
  echo "Nome no Cartão: " . $_POST['nome_cartao'] . "<br>";
  echo "Número do Cartão: " . $_POST['numero_cartao'] . "<br>";
  echo "Data de Validade: " . $_POST['data_validade'] . "<br>";
  echo "Código de Segurança: " . $_POST['codigo_seguranca'] . "<br>";
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
                            <a href="/pages/login/index.php">
                                <span class="material-icons">person</span>
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

                    <div class="form-container">
                
                <form class="login-form" action="/pages/home/index.php" method="post">
                    <input type="text" placeholder="Nome impresso no cartão" required>
                    <input type="text" placeholder="Numero do cartão" required>
                    <div class="caixa-senha">
                        <input id="data_validade" type="text" placeholder="MM/AAAA" name="data-validade" required>
                        <input type="text" placeholder="CVV" required>                       
                    </div>
                    <div class="checkbox-div">
                    <label class="custom-checkbox"> 
                    <input type="checkbox" id="show-captcha" name="show-captcha">
                        <span id="CAPTCHA">Aceitos os<span  href=""> termos de uso</span></span> 
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