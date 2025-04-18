<?php 
// Inicia a sessão para verificar se o usuário está logado
session_start();

// Inclui o arquivo de configuração para conexão com o banco de dados
include("../php/config.php");

// Verifica se o usuário está autenticado
if (!isset($_SESSION['valid'])) {
    // Redireciona para a página de login caso não esteja autenticado
    header("Location: ../index.html");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Configurações básicas do documento -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Home</title>
</head>
<body>
    <!-- Barra de navegação -->
    <div class="nav">
        <div class="logo">
            <p><a href="home.php"><img src="../Desings/logos/zonaazulnavbar.png" alt=""></a></p>
        </div>

        <div class="right-links">
            <?php 
            // Obtém os dados do usuário logado
            $id = $_SESSION['id'];
            $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

            while ($result = mysqli_fetch_assoc($query)) {
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
                $res_Saldo = $result['Saldo']; // Obtém o saldo do usuário
                $res_id = $result['Id'];
            }

            // Link para atualizar o perfil
            echo "<a href='edit.php?Id=$res_id'>Atualizar perfil</a>";
            ?>
            <!-- Botão de logout -->
            <a href="../php/logout.php"><button class="btn">Sair</button></a>
        </div>
    </div>
    <main>
        <!-- Conteúdo principal -->
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Você está conectado como: <b><?php echo $res_Email ?></b>.</p>
                </div>
            </div>
            <div class="bottom">
                <div class="box" style="display: flex; flex-direction: column; align-items: flex-start;">
                    <p style="margin-bottom: 5px;">Olá, <b><?php echo $res_Uname ?></b>.</p>
                    <div style="display: flex; align-items: center;">
                        <p style="margin-right: 10px;">Saldo: <b>R$ <?php echo $res_Saldo ?></b></p>
                        <button class="btn-add-saldo">+</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>