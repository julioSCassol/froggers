<?php
    $id = $_GET['id'];

    function getprodutoByID($id)
    {
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=froggers', 'ota', 'password');

            $stmt = $dbh->prepare("SELECT * FROM produtos WHERE id = :id and IDcategoria=2");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    $produto = getprodutoByID($id);

    // Check if the $produto variable is empty
    if (empty($produto)) {
        // Display an error message and exit
        echo '<script>alert("Produto não encontrado!");history.back();</script>';
        exit;
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
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">       

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
            
        <div class="imagem-camiseta">
            <div id="camisetaIMG">
                <img id="camiseta1" src="/assets/camisetas/<?=$produto['nome']?>.png" alt="camiseta">
            </div>
        
            <div class="descricao-preco">
                <div id="preco-container">

                    <p class="descricao-imagem" id="nome-produto">Camiseta <?= $produto['nome'] ?></p>
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
                <button class="descricao-imagem" id="botao-grande">Adicionar ao carrinho</button>
            </div>
        </div>
        <div class="catalog-container">
            <div class="swiper-container">
              <div class="swiper-wrapper">
                <!-- Catalog items go here -->
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