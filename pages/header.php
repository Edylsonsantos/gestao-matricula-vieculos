<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: http://localhost/matricula/login.php"); // Redireciona para login se não estiver logado
    exit();
}
$nomeUsuario = isset($_SESSION['user_nome']) ? $_SESSION['user_nome'] : "Desconhecido";
$primeiraLetra = strtoupper($nomeUsuario[0]);
?>
<header>
    <h1>Sistema de Gestão de Veículos</h1>
    <div class="user-info">
        <div class="initial-circle"><?php echo $primeiraLetra; ?></div>
        <span><?php echo $nomeUsuario; ?></span>
    </div>
</header>