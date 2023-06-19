<?php
session_start();
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
                        <input type="text" placeholder="Search...">
                        <button type="submit"> <span class="material-symbols-outlined">arrow_forward_ios</span></button>
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
                            <span class="carrinho-vazio">Seu carrinho está vazio!</span>
                            <i id="close-menu" class="material-icons">clear</i>
                        </div>
                        <div class="Sapo-triste">
                            <img src="/assets/images/Sapo-triste.png" alt="Sapo-triste">
                            </div>
                        <span><?php echo $_SESSION['username']; ?></span>
                        <span id="continue-shopping" class="carrinho-vazio"><u>Continuar Comprando</u></span>
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
        </div>
        
        <div id="carousel">
    <div class="carousel-item">
        <img src="\assets\banners\banner inicial 1920.png" alt="Imagem 1">
    </div>
    <div class="carousel-item">
        <img src="\assets\banners\banner 1.png" alt="Imagem 2">
    </div>
</div>

<div class="destaques">
  <p class="destaques-texto">DESTAQUES</p>
  <div class="destaque-imagem">
    <img src="\assets\banners\banner pqn inicial.png" alt="banner-destaque">
  </div>
</div> 

        <div class="catalog-container">
                <div class="catalog" id="catalog">
                    
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
                <img class="redes" src="/assets/images/redes.png" alt="redes">
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
        <script src="script.js"></script>
    </body>   
    
</html>