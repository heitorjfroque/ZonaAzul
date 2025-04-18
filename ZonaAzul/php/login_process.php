<?php
// Inicia a sessão para armazenar dados do usuário durante a navegação
session_start();

// Inclui o arquivo de configuração para conexão com o banco de dados
include("../php/config.php");

// Verifica se o formulário foi enviado
if (isset($_POST['submit'])) {
    // Escapa caracteres especiais para evitar injeção de SQL
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Executa a consulta no banco de dados para verificar as credenciais do usuário
    $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email' AND Password='$password'") or die("Erro na consulta");

    // Obtém os dados do usuário retornados pela consulta
    $row = mysqli_fetch_assoc($result);

    // Verifica se os dados do usuário foram encontrados
    if (is_array($row) && !empty($row)) {
        // Armazena informações do usuário na sessão
        $_SESSION['valid'] = $row['Email'];
        $_SESSION['username'] = $row['Username'];
        $_SESSION['age'] = $row['Age'];
        $_SESSION['id'] = $row['Id'];
        // Redireciona o usuário para a página inicial
        header("Location: ../php/home.php");
    } else {
        // Redireciona para a página de login com uma mensagem de erro
        header("Location: ../index.html?error=Usuário ou senha incorretos");
    }
} else {
    // Redireciona para a página de login caso o formulário não tenha sido enviado
    header("Location: ../index.html");
}
?>