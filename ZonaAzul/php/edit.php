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
    <title>Change Profile</title>
</head>
<body>
    <!-- Barra de navegação -->
    <div class="nav">
        <div class="logo">
            <p><a href="home.php"><img src="" alt=""></a></p>
        </div>
        <div class="right-links">
            <a href="#">Atualizar perfil</a>
            <a href="../php/logout.php"><button class="btn">Sair</button></a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php 
            // Verifica se o formulário foi enviado
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $age = $_POST['age'];

                $id = $_SESSION['id'];

                // Verifica se o email já está em uso por outro usuário
                $verify_query = mysqli_query($con, "SELECT * FROM users WHERE Email='$email' AND Id != $id");
                if (mysqli_num_rows($verify_query) > 0) {
                    // Exibe mensagem de erro caso o email já esteja em uso
                    echo "<div class='message'>
                              <p>Esse email já está sendo utilizado por outro usuário!</p>
                          </div><br>";
                    // Botão para voltar à página de edição
                    echo "<a href='edit.php'><button class='btn'>Voltar para editar</button></a>";
                } else {
                    // Atualiza os dados do usuário no banco de dados
                    $edit_query = mysqli_query($con, "UPDATE users SET Username='$username', Email='$email', Age='$age' WHERE Id=$id") or die("Erro ocorrido");

                    if ($edit_query) {
                        echo "<div class='message-success'>
                        <p>Perfil atualizado com sucesso!</p>
                    </div><br>";
                        // Botão para voltar à página inicial
                        echo "<a href='home.php'><button class='btn'>Voltar para a página inicial</button></a>";
                    }
                }
            } else {
                // Obtém os dados do usuário para exibir no formulário
                $id = $_SESSION['id'];
                $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");

                while ($result = mysqli_fetch_assoc($query)) {
                    $res_Uname = $result['Username'];
                    $res_Email = $result['Email'];
                    $res_Age = $result['Age'];
                }
            ?>
            <header>Atualizar perfil</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Nome de usuário</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="age">Idade</label>
                    <input type="number" name="age" id="age" value="<?php echo $res_Age; ?>" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Atualizar" required>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>