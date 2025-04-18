<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Configurações básicas do documento -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>Register</title>
</head>
<body>
    <!-- Contêiner principal -->
    <div class="container">
        <div class="box form-box">

        <?php 
        // Inclui o arquivo de configuração para conexão com o banco de dados
        include("../php/config.php");

        // Verifica se o formulário foi enviado
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $age = $_POST['age'];
            $password = $_POST['password'];

            // Verifica se o email já está cadastrado no banco de dados
            $verify_query = mysqli_query($con, "SELECT Email FROM users WHERE Email='$email'");

            if (mysqli_num_rows($verify_query) != 0) {
                // Exibe mensagem de erro caso o email já esteja em uso
                echo "<div class='message'>
                          <p>Esse email já está sendo utilizado!</p>
                      </div> <br>";
                echo "<a href='../index.html'><button class='btn'>Faça login</button>";
            } else {
                // Insere os dados do novo usuário no banco de dados
                mysqli_query($con, "INSERT INTO users(Username,Email,Age,Password) VALUES('$username','$email','$age','$password')") or die("Erro ocorrido");

                // Exibe mensagem de sucesso
                echo "<div class='message-success'>
                          <p>Cadastrado com sucesso!</p>
                      </div> <br>";
                echo "<a href='../index.html'><button class='btn'>Faça login</button>";
            }
        } else {
        ?>

            <!-- Cabeçalho do formulário -->
            <header>Cadastre-se</header>
            <form action="" method="post">
                <!-- Campo para o nome de usuário -->
                <div class="field input">
                    <label for="username">Nome de usuário</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <!-- Campo para o email -->
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <!-- Campo para a idade -->
                <div class="field input">
                    <label for="age">Idade</label>
                    <input type="number" name="age" id="age" autocomplete="off" required>
                </div>

                <!-- Campo para a senha -->
                <div class="field input">
                    <label for="password">Senha</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <!-- Botão de envio do formulário -->
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Cadastre-se" required>
                </div>

                <!-- Link para a página de login -->
                <div class="links">
                    Tem uma conta? <a href="../index.html">Conecte-se</a>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
</body>
</html>