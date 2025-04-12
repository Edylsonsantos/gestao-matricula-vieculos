<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vieculos";
$message = "";
$style = "none";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o ID foi passado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Exclui o veículo do banco de dados
    $sql_delete = "DELETE FROM veiculos WHERE id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "Veículo excluído com sucesso!";
        $style = "success";
    } else {
        $message = "Não pode excluir este usuario porque tem historico de multas";
        $style = "error";
    }
    $stmt->close();
} else {
    $message = "ID do veículo não fornecido.";
    $style = "warning";
}

// Fecha a conexão com o banco
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusão de Veículo</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"> 
</head>
<body>

    <?php include '../pages/header.php'; ?>

    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="../"><i class="bx bx-home-alt"></i> Início</a></li>
                <li><a href="view-veiculo.php"><i class="bx bx-car"></i> Veículos</a></li>
                <li><a href="view-multas.php"><i class="bx bx-error"></i> Multas</a></li>
                <li><a href="pesquisar-veiculo.php"><i class="bx bx-search-alt"></i> Consultar Veículo</a></li>
                <li><a href="pesquisar-multa.php"><i class="bx bx-search"></i> Consultar Multas</a></li>
                <li><a href="usuario.php"><i class="bx bx-user"></i> Usuários</a></li>
                <li><a href="../logout.php"><i class="bx bx-log-out"></i> Sair</a></li>
            </ul>
        </div>

        <!-- fi -->
        <div class="content">
            <!-- Caixa de Mensagem -->
            <div id="messageBox" class="message-box" style="display: block;">
                <p class="<?php echo $style ?>"><?php echo $message ?></p>
            </div>
        </div>
    </div>
</body>
</html>
