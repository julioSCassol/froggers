<?php

session_start();
include '../db.php';

$nome = $_SESSION['nome'];
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
        <div class="cliente-info">
            <h2>Informações do Cliente</h2>
            <p>Nome: <span id="nome"><?php echo $fullName; ?></span> <button id="button-edit" onclick="editarNome()">Editar</button></p>
            <p>Email: <span id="email"><?php echo $emailEpico; ?></span> <button id="button-edit" onclick="editarEmail()">Editar</button></p>
            <p>Senha: <span id="senha"><?php echo str_repeat('*', strlen($senha)); ?></span> <button id="button-edit" onclick="editarSenha()">Editar</button></p>
            <div class="itens-comprados">
    <h2 class="meus-pedidos">Meus Pedidos</h2>
    <?php
        $clienteID = $_SESSION['IDcliente'];

        $stmt = $conn->prepare("
            SELECT 
                c.nome AS ClienteNome, 
                p.id AS PedidoID, 
                p.total AS TotalPedido,
                pr.nome AS ProdutoNome, 
                ip.quantidade AS Quantidade, 
                ip.precoUn AS PrecoUnidade,
                ip.tamanho AS Tamanho
            FROM 
                clientes c 
            JOIN 
                pedidos p ON c.id = p.IDcliente
            JOIN 
                itens_pedido ip ON p.id = ip.IDpedidos
            JOIN 
                produtos pr ON ip.IDprodutos = pr.id
            WHERE 
                c.id = ?
        ");

        $stmt->bind_param('i', $clienteID);

        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            echo "<p>Nome do Cliente: " . $row['ClienteNome'] .
            " | Produto: " . $row['ProdutoNome'] .
            " | Quantidade: " . $row['Quantidade'] . 
            " | Preço por unidade: " . $row['PrecoUnidade'] . 
            " | Tamanho: " . $row['Tamanho'] ."</p>"; 
        }
    ?>
    <form method="post" action="apagar_pedidos.php">
    <button class="apagarPedidos" type="submit">Apagar Pedidos</button>
</form>
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
                    <div class="FaleConosco">
                    <a href="/pages/faleconosco/index.php"> 
                        Fale Conosco
                    </a>
                        <span style="font-family: 'Material Icons', sans-serif;">call</span>
                    </div>
                </div>
            </div>
        </footer> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="script.js"></script>
    </body>   
    
</html>