<?php
include '../db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['name'];
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $senha_confirmada = $_POST['confirm_password'];
    $captchaChecked = isset($_POST["show-captcha"]);

    if (!$captchaChecked) {
        echo '<script>alert("Please verify the CAPTCHA!");</script>';
    } else {
        $captchaResult = (int) $_POST["captcha_result"];
        $userCaptcha = (int) $_POST["captcha"];

        if ($userCaptcha !== $captchaResult) {
            echo '<script>alert("CAPTCHA answer is incorrect!");</script>';
        } else {
            $sql = "INSERT INTO clientes (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
            if ($conn->query($sql) === TRUE) {
                header("Location: ../login/index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
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

        <div class="form-container">
            <img src="/assets/images/logo-completa.png" alt="logo-login">
            <form class="login-form" action="./index.php" method="post">
                <input type="text" placeholder="Nome Completo" name="name">
                <input type="email" placeholder="Email" name="email">
                <div class="caixa-senha">
                    <input type="password" placeholder="Senha" name="password">
                    <input type="password" placeholder="Repetir Senha" name="confirm_password">
                    <div class="toggle-password">
                        <span class="material-icons password-toggle">visibility_off</span>
                    </div>
                </div>
                <div class="checkbox-div">
                    <label class="custom-checkbox"> 
                        <input type="checkbox" id="show-captcha" name="show-captcha">
                        <span id="CAPTCHA">CAPTCHA</span> 
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div id="captcha-container" style="display: none;">
                    <input type="hidden" name="captcha_result" id="captcha_result">
                    <div id="captcha"></div>
                    <input type="text" name="captcha" placeholder="Digite o resultado">
                </div>
                <button type="submit">Registrar</button>
                <a id=cadastrado href="/pages/login/index.php">Já é cadastrado? Clique aqui para efetuar o login!</a>
            </form>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
