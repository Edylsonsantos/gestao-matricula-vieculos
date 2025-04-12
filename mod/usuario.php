
<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vieculos"; // Altere para o nome do seu banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Consulta para obter todos os funcionários
$sql = "SELECT * FROM funcionarios";
$result = $conn->query($sql);

// Verifica se foi passado o status na URL (success ou error)
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Fecha a conexão com o banco
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Funcionários</title>
    <link rel="stylesheet" href="../css/styles.css">
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
            <!-- Exibe a mensagem de sucesso ou erro -->
            <div id="messageBox" class="message-box" style="display: block;">
                <?php
                    if (isset($_GET['status'])) {
                        $status = $_GET['status'];
                        if ($status == 'success') {
                            echo '<p class="success">Usuario registado com sucesso!</p>';
                        } elseif ($status == 'error') {
                            echo '<p class="error">Ocorreu um erro ao registrar usuario.</p>';
                        } elseif ($status == 'invalid_email') {
                            echo '<p class="warning">Por favor, insira um email válido.</p>';
                        } elseif ($status == 'email_exists') {
                            echo '<p  class="warning">Este email já está registado. Por favor, use outro.</p>';
                        }
                        if (isset($_GET['error'])) {
                            echo '<p  class="error">Erro: ' . htmlspecialchars($_GET['error']) . '</p>';
                        }
                    }
                ?>
                <?php
                    // Exibe mensagens de status, se houver
                    if (isset($_GET['message'])) {
                        if ($_GET['message'] == 'success') {
                            echo '<p class="success">Usuario excluído com sucesso!</p>';
                        } elseif ($_GET['message'] == 'error') {
                            echo '<p class="error">Erro ao excluir o usuario.</p>';
                        } elseif ($_GET['message'] == 'not_found') {
                            echo '<p class="warning">Usuario não encontrado.</p>';
                        }
                    }
                ?>
            </div>
            <!-- Exibe a tabela com os funcionários -->
            
            <a href="registrar-usuario.php" target="_blank" rel="noopener noreferrer" class="novo">Novo</a>
            <h3>Usuários:</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Apagar</th>
                </tr>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['cargo']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['telefone']; ?></td>
                            <td>
                                <a href="excluir-usuario.php?id=<?php echo $row['id']; ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="7">Nenhum usuario registado.</td></tr>
                <?php endif; ?>
            </table>
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
