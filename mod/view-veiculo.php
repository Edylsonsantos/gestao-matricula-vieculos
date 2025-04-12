
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

// Consulta para obter todos os veículos da tabela 'veiculos'
$sql_consulta = "SELECT * FROM veiculos";
$stmt_consulta = $conn->prepare($sql_consulta);
$stmt_consulta->execute();
$consulta_result = $stmt_consulta->get_result();

$stmt_consulta->close();

// Fecha a conexão com o banco
$conn->close();
?>
<?php
if (isset($_GET['style'])) {
    $style = $_GET['style'];
    if ($style == "success") {
        $message = "Veiculo registado";
    } else if($style == "warning"){
        $message = "Este veiculo ja se encontra registado";
    }else{
        $message = "Erro no registro";

    }
} else {
    $message = '';
    $style = '';
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Veículo</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"> 
</head>
<body>

    <?php include '../pages/header.php'; ?>

    <div class="container">
    <div class="sidebar">
            <ul>
                <li><a href="../">Início</a></li>
                <li><a href="view-veiculo.php"><i class="bx bx-car"></i> Veículos</a></li>
                <li><a href="view-multas.php"><i class="bx bx-error"></i> Multas</a></li>
                <li><a href="pesquisar-veiculo.php"><i class="bx bx-search-alt"></i> Consultar Veículo</a></li>
                <li><a href="pesquisar-multa.php"><i class="bx bx-search"></i> Consultar Multas</a></li>
                <li><a href="usuario.php"><i class="bx bx-user"></i> Usuários</a></li>
                <li><a href="../logout.php"><i class="bx bx-log-out"></i> Sair</a></li>
            </ul>
        </div>
        <div class="content">
            <!-- Resultados da consulta -->
            <div id="messageBox" class="message-box" style="display: block;"><p class="<?php echo $style; ?>"><?php echo $message; ?></p></div>
            <a href="registrar.php" target="_blank" rel="noopener noreferrer" class="novo">Novo</a>
            <?php if ($consulta_result && $consulta_result->num_rows > 0): ?>
                <h3>Veiculos:</h3>
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
                        <tr>
                            <td><?php echo $row['tipo']; ?></td>
                            <td><?php echo $row['marca']; ?></td>
                            <td><?php echo $row['nome_proprietario']; ?></td>
                            <td><?php echo $row['documento']; ?></td>
                            <td><?php echo $row['modelo']; ?></td>
                            <td><?php echo $row['ano']; ?></td>
                            <td><?php echo $row['placa']; ?></td>
                            <td>
                            <!-- Ícones de ação -->
                            <a href="editar.php?id=<?php echo $row['id']; ?>" title="Editar">
                                <i class="bx bx-edit"></i> <!-- Ícone de editar -->
                            </a>
                            <a href="excluir.php?id=<?php echo $row['id']; ?>" title="Excluir">
                                <i class="bx bx-trash"></i> <!-- Ícone de excluir -->
                            </a>
                        </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php elseif ($consulta_result): ?>
                <p class="warning">Nenhum veículo encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
    <script>
        // Função para esconder a message-box após 10 segundos
        setTimeout(function() {
            const messageBox = document.querySelector('.message-box');
            if (messageBox) {
                messageBox.style.display = 'none';
            }
            
            // Limpa o parâmetro da URL após 10 segundos
            const currentUrl = window.location.href;
            const newUrl = currentUrl.split('?')[0];  // Remove qualquer query string
            window.history.replaceState({}, document.title, newUrl); // Atualiza a URL sem recarregar a página
        }, 10000); // 10000ms = 10 segundos
    </script>

</body>
</html>
