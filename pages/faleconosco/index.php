<?php
session_start();
include '../db.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </head>
    <body>
        <div class="pagina">
            <div id=    "header">
                <div id="topper">
                    <a href="/pages/home/index.php">
                        <div class="logo-container">
                            <img class="logo-completa" src="/assets/images/logo-completa.png" alt="logo-completa">
                        </div>
                    </a>
                    

                    <div class="search-container">
                        <form id="search-form" action="/pages/pesquisa/" method="GET">
                            <input id="search-input" type="text" name="search" placeholder="Pesquisar...">
                            <button type="submit"> <span class="material-symbols-outlined">arrow_forward_ios</span></button>
                        </form>
                    </div>
                    
                    <div class="icones">
                        <div class="conta">
                        <a id=conta-link href="
                            <?php
                            if(isset($_SESSION['IDcliente'])) {
                                echo "/pages/cliente/index.php";
                            } else {
                                echo "/pages/login/index.php";
                            }
                            ?>
                        ">
                            <span class="material-icons">person</span>
                            <span id=username><?php echo $firstName; ?></span>
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
                            <button id="confirm-payment" style="display: none;">Confirmar Pagamento</button>
                            <button id="empty-cart" onclick="emptyCart()">Esvaziar Carrinho</button>
                        </div>
                    </div>
                </div>

                <div id="coisas-que-vende">
                    <a href="/pages/camisetas/index.php">
                        <div class="categorias">camisetas</div>
                    </a>
                    <a href="/pages/moletons/index.php">
                        <div class="categorias">moletons</div>
                    </a>
                    <a href="/pages/canecas/index.php">
                        <div class="categorias">canecas</div>
                    </a>
                </div>
            </div>
            <div class="box">
            <p class="bold-text">Fale Conosco!</p>
            <div class="contact-us">
                <h2><strong>Fale Conosco!</strong></h2>
                <p>Nós da Froggers estamos sempre prontos para atender você! Se tiver dúvidas, sugestões ou quiser conversar sobre nossos produtos, fique à vontade para nos contatar. Estamos sempre a postos para garantir a melhor experiência de compra para você.</p>
                <p>Agradecemos pelo interesse e pelo apoio. Estamos ansiosos para ouvir de você!</p>
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
            </div>
        </div>

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
                    <div class="FaleConosco">
                    <a href="/pages/faleconosco/index.php"> 
                        Fale Conosco
                    </a>
                        <span style="font-family: 'Material Icons', sans-serif;">call</span>
                    </div>
                </div>
            </div>
        </footer> 
        <div id="overlay" class="overlay-hidden"></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="script.js"></script>
    </body>   
    
</html>