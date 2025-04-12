<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redireciona para login se não estiver logado
    exit();
}
?>
<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vieculos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$message = ""; // Variável para armazenar a mensagem de status
$style = ""; // Variável para armazenar a mensagem de status

// Lógica de consulta de veículos
$consulta_result = null;

// Se os parâmetros 'documento' ou 'placa' foram passados
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['documento']) || isset($_POST['placa']))) {
    $consulta_documento = $_POST['documento'] ?? '';
    $consulta_placa = $_POST['placa'] ?? '';

    // Consulta para verificar se existe o veículo com o documento ou placa fornecido
    $sql_consulta = "SELECT * FROM veiculos WHERE documento = ? OR placa = ?";
    $stmt_consulta = $conn->prepare($sql_consulta);
    $stmt_consulta->bind_param("ss", $consulta_documento, $consulta_placa);
    $stmt_consulta->execute();
    $consulta_result = $stmt_consulta->get_result();
    $stmt_consulta->close();
} else {
    // Consulta para obter todos os veículos da tabela 'veiculos'
    $sql_consulta = "SELECT * FROM veiculos";
    $stmt_consulta = $conn->prepare($sql_consulta);
    $stmt_consulta->execute();
    $consulta_result = $stmt_consulta->get_result();
    $stmt_consulta->close();
}

// Fecha a conexão com o banco
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Veículo</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"> 
</head>
<body>

    <?php include 'pages/header.php'; ?>

    <div class="container">
        <div class="sidebar">
            <ul>
                <li><a href="../"><i class="bx bx-home-alt"></i> Início</a></li>
                <li><a href="mod/view-veiculo.php"><i class="bx bx-car"></i> Veículos</a></li>
                <li><a href="mod/view-multas.php"><i class="bx bx-error"></i> Multas</a></li>
                <li><a href="mod/pesquisar-veiculo.php"><i class="bx bx-search-alt"></i> Consultar Veículo</a></li>
                <li><a href="mod/pesquisar-multa.php"><i class="bx bx-search"></i> Consultar Multas</a></li>
                <li><a href="mod/usuario.php"><i class="bx bx-user"></i> Usuários</a></li>
                <li><a href="logout.php"><i class="bx bx-log-out"></i> Sair</a></li>
            </ul>
        </div>
        <div class="content">
            <!-- Resultados da consulta -->
            <?php if ($consulta_result && $consulta_result->num_rows > 0): ?>
                <h3>Resultados Encontrados:</h3>
                <table>
                    <tr>
                        <th>Tipo</th>
                        <th>Marca</th>
                        <th>Nome do Proprietário</th>
                        <th>Documento</th>
                        <th>Modelo</th>
                        <th>Ano</th>
                        <th>Placa</th>
                        <th>Atualização</th>
                    </tr>
                    <?php while ($row = $consulta_result->fetch_assoc()): ?>
                        <tr>                           <td><?php echo $row['tipo']; ?></td>
                            <td><?php echo $row['marca']; ?></td>
                            <td><?php echo $row['nome_proprietario']; ?></td>
                            <td><?php echo $row['documento']; ?></td>
                            <td><?php echo $row['modelo']; ?></td>
                            <td><?php echo $row['ano']; ?></td>
                            <td><?php echo $row['placa']; ?></td>
                            <td>
                            <!-- Ícones de ação -->
                            <a href="mod/editar.php?id=<?php echo $row['id']; ?>" title="Editar">
                                <i class="bx bx-edit"></i> <!-- Ícone de editar -->
                            </a>
                            <a href="mod/excluir.php?id=<?php echo $row['id']; ?>" title="Excluir">
                                <i class="bx bx-trash"></i> <!-- Ícone de excluir -->
                            </a>
                        </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php elseif ($consulta_result && $consulta_result->num_rows == 0): ?>
                <p class="warning">Nenhum veículo encontrado com o documento ou placa fornecidos.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
