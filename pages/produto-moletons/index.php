<?php
session_start();
include '../db.php';

function getprodutoByID($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT *, quantidade FROM produtos WHERE id = ? AND IDcategoria = 1");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


$id = $_GET['id'];
$produto = getprodutoByID($id);

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
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                            <input id="search-input" type="text" name="search" placeholder="Pesquisar...">
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
            
            <div class="imagem-camiseta">
        <div id="camisetaIMG" class="zoom-container">
            <img id="camiseta1" class="zoom-image" src="/assets/moletons/<?=$produto['nome']?>.png" alt="camiseta">
        </div>
        
            <div class="descricao-preco">
                <div id="preco-container">

                <p class="descricao-imagem" id="nome-produto">Moletom <?= $produto['nome'] ?></p>
                
                </div>
                <div id="preco-container">
                    <p class="descricao-imagem" id="preco-produto">R$<?= number_format($produto['preco'], 2, '.', '') ?></p>
                </div>
                <p class="descricao-imagem" id="tamanhos-produto">TAMANHOS</p>
                <div class="quadrados-tamanho">
                    <button class="quadrado" id="quadrado-p">
                        <span class="letra">P</span>
                    </button>
                    <button class="quadrado" id="quadrado-m">
                        <span class="letra">M</span>
                    </button>
                    <button class="quadrado" id="quadrado-g">
                        <span class="letra">G</span>
                    </button>
                    <button class="quadrado" id="quadrado-gg">
                        <span class="letra">GG</span>
                    </button>
                </div>
                <button class="descricao-imagem" id="botao-grande" data-productid="<?= $produto['id'] ?>" onclick="addToCart(this.getAttribute('data-productid'))">Adicionar ao carrinho</button>
                            <p class="descricao-imagem" id="quantidade-produto">Quantidade Disponível: <?= $produto['quantidade'] ?></p>

        </div>
        </div>
        <div class="catalog-container">
            <h1 class= "produtos-relacionadostxt">Produtos Relacionados</h1>
            <div class="swiper-container">
              <div class="swiper-wrapper">
              </div>
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
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
                    <div class="Fale Conosco">
                        Fale Conosco
                        <span style="font-family: 'Material Icons', sans-serif;">call</span>
                    </div>
                </div>
            </div>

        </footer> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="script.js"></script>
    </body>
</html>
