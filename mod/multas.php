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

// Consulta para listar veículos
$sql_veiculos = "SELECT id, nome_proprietario, placa FROM veiculos";
$result_veiculos = $conn->query($sql_veiculos);

// Fecha a conexão com o banco
$conn->close();
///header("Location: view-multas.php?style=" . urlencode($style));
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Multa</title>
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
            <!-- Formulário para Adicionar Multa -->
            <form action="save-multas.php" method="POST">
                
                <!-- Seletor de Veículo -->
                <label for="veiculo_id">Veículo:</label>
                <select id="veiculo_id" name="veiculo_id" required>
                    <option value="">Selecione um veiculo</option>
                    <?php while ($row = $result_veiculos->fetch_assoc()): ?>
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo $row['nome_proprietario'] . " - " . $row['placa']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>

                <!-- Seletor de Motivo da Multa -->
                <label for="motivo">Motivo:</label>
                <select id="motivo" name="motivo" required>
                    <option value="">Selecionar um motivo</option>
                    <option value="Estacionamento irregular">Estacionamento irregular</option>
                    <option value="Excesso de velocidade">Excesso de velocidade</option>
                    <option value="Condução perigosa">Condução perigosa</option>
                    <option value="Sem cinto de segurança">Sem cinto de segurança</option>
                    <option value="Documentação incompleta">Documentação incompleta</option>
                    <option value="Acidente leve">Acidente leve</option>
                    <option value="Desrespeito a via publica">Desrespeito a via publica</option>
                </select>

                <!-- Campo para Valor da Multa -->
                <label for="valor">Valor (MZN):</label>
                <input type="text" id="valor" name="valor" oninput="formatCurrency(this)" required>

                <!-- Data da Multa -->
                <label for="data">Data da Multa:</label>
                <input type="date" id="data" name="data" required>

                <!-- Seletor de Cidade -->
                <label for="cidade">Cidade:</label>
                <select id="cidade" name="cidade" required>
                    <option value="Quelimane">Quelimane</option>
                    <option value="Gilé">Gilé</option>
                    <option value="Mocuba">Mocuba</option>
                    <option value="Nicoadala">Nicoadala</option>
                    <option value="Alto Molócue">Alto Molócue</option>
                    <option value="Milange">Milange</option>
                    <option value="Gurue">Gurue</option>
                    <option value="Pebane">Pebane</option>
                    <option value="Lugela">Lugela</option>
                    <option value="Namacurra">Namacurra</option>
                    <option value="Maganja da Costa">Maganja da Costa</option>
                </select>

                <button type="submit" class="btn">Adicionar Multa</button>
            </form>
        </div>
    </div>

    <script>
    // Função para formatar o campo de valor como moeda (MZN)
    function formatCurrency(input) {
        let value = input.value.replace(/\D/g, '');  // Remove qualquer caractere que não seja número
        value = (parseFloat(value) / 100).toFixed(2); // Converte para decimal, com duas casas
        input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " MZN"; // Formata com vírgulas

        // Reposiciona o cursor no final do input
        const position = input.value.length - 4; // Posição antes de " MZN"
        input.setSelectionRange(position, position);
    }
</script>

</body>
</html>
