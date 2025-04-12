
<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vieculos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$message = "";
$style = "";
$sql_consulta = "SELECT m.id, m.motivo, m.valor, m.data_multa, m.cidade, m.status_pagamento, v.placa, v.nome_proprietario
                 FROM multas m
                 JOIN veiculos v ON m.id_veiculo = v.id";

$stmt_consulta = $conn->prepare($sql_consulta);
$stmt_consulta->execute();
$consulta_result = $stmt_consulta->get_result();
$stmt_consulta->close();

$conn->close();
?>
<?php
if (isset($_GET['style'])) {
    $style = $_GET['style'];
    if ($style == "success") {
        $message = "Multa adicionada";
    } else if($style == "warning"){
        $message = "Não foi possivel adicionar essa multa";
    }else{
        $message = "Erro no registro";
    }
} else {
    $message = '';
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Multas</title>
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
            <div id="messageBox" class="message-box" style="display: block;"><p class="<?php echo $style; ?>"><?php echo $message; ?></p></div>
            <a href="multas.php" target="_blank" rel="noopener noreferrer" class="novo">Novo</a>

            <!-- Exibe as multas -->
            <?php if ($consulta_result && $consulta_result->num_rows > 0): ?>
                <h3>Multas:</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Motivo</th>
                        <th>Valor</th>
                        <th>Data da Multa</th>
                        <th>Cidade</th>
                        <th>Status de Pagamento</th>
                        <th>Proprietário</th>
                        <th>Placa</th>
                        <th>Conta</th>
                    </tr>
                    <?php while ($row = $consulta_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['motivo']; ?></td>
                            <td><?php echo number_format($row['valor'], 2, ',', '.') . ' MZN'; ?></td>
                            <td><?php echo $row['data_multa']; ?></td>
                            <td><?php echo $row['cidade']; ?></td>
                            <td><?php echo $row['status_pagamento'] == 'pendente' ? 'Pendente' : 'Pago'; ?></td>
                            <td><?php echo $row['nome_proprietario']; ?></td>
                            <td><?php echo $row['placa']; ?></td>
                            <td>
                                <?php if ($row['status_pagamento'] == 'pendente'): ?>
                                    <a href="pagar.php?id=<?php echo $row['id']; ?>" class="btn-pagar">Pagar</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p class="warning">Nenhuma multa encontrada.</p>
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
