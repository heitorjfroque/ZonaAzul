<?php
// Inicia a sessão
session_start();

// Destroi a sessão para deslogar o usuário
session_destroy();

// Redireciona para a página de login
header("Location: ../index.html");
?>