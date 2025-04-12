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

    // Consulta para obter os dados atuais do veículo
    $sql = "SELECT * FROM veiculos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o veículo existe
    if ($result->num_rows > 0) {
        $veiculo = $result->fetch_assoc();
    } else {
        $message = "Veículo não encontrado.";
        $style = "warning";
        exit();
    }
}

// Verifica se o formulário foi enviado para atualizar os dados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os valores do formulário
    $tipo = $_POST['tipo'];
    $marca = $_POST['marca'];
    $nome = $_POST['nome'];
    $documento = $_POST['documento'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $placa = $_POST['placa'];

    // Prepara a consulta para atualizar apenas os campos que foram alterados
    $sql_update = "UPDATE veiculos SET ";
    $params = [];
    $types = "";

    // Verifica e adiciona os campos modificados na consulta
    if ($tipo !== $veiculo['tipo']) {
        $sql_update .= "tipo = ?, ";
        $params[] = $tipo;
        $types .= "s";
    }
    if ($marca !== $veiculo['marca']) {
        $sql_update .= "marca = ?, ";
        $params[] = $marca;
        $types .= "s";
    }
    if ($nome !== $veiculo['nome_proprietario']) {
        $sql_update .= "nome_proprietario = ?, ";
        $params[] = $nome;
        $types .= "s";
    }
    if ($documento !== $veiculo['documento']) {
        $sql_update .= "documento = ?, ";
        $params[] = $documento;
        $types .= "s";
    }
    if ($modelo !== $veiculo['modelo']) {
        $sql_update .= "modelo = ?, ";
        $params[] = $modelo;
        $types .= "s";
    }
    if ($ano !== $veiculo['ano']) {
        $sql_update .= "ano = ?, ";
        $params[] = $ano;
        $types .= "i";
    }
    if ($placa !== $veiculo['placa']) {
        $sql_update .= "placa = ?, ";
        $params[] = $placa;
        $types .= "s";
    }

    // Remover a última vírgula
    $sql_update = rtrim($sql_update, ", ");

    // Adiciona a condição WHERE
    $sql_update .= " WHERE id = ?";

    // Adiciona o ID ao final dos parâmetros
    $params[] = $id;
    $types .= "i";

    // Prepara a consulta com os parâmetros
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param($types, ...$params);

    if ($stmt_update->execute()) {
        $message = "Veículo atualizado com sucesso!";
        $style = "success";
    } else {
        $message = "Erro ao atualizar veículo.";
        $style = "error";
    }

    $stmt_update->close();
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Veículo</title>
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
            <div id="messageBox" class="message-box" style="display: block;">
                <p class="<?php echo $style ?>"><?php echo $message ?></p>
            </div><br>

            <form action="editar.php?id=<?php echo $id; ?>" method="POST">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" required>
                    <option value="">Selecione</option>
                    <option value="Motorizada" <?php echo ($veiculo['tipo'] == 'motorizada') ? 'selected' : ''; ?>>Motorizada</option>
                    <option value="Carro" <?php echo ($veiculo['tipo'] == 'carro') ? 'selected' : ''; ?>>Carro</option>
                    <option value="Bicicleta" <?php echo ($veiculo['tipo'] == 'bicicleta') ? 'selected' : ''; ?>>Bicicleta</option>
                    <option value="Triciclo" <?php echo ($veiculo['tipo'] == 'triciclo') ? 'selected' : ''; ?>>Triciclo</option>
                </select>

                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" value="<?php echo $veiculo['marca']; ?>" required>

                <label for="nome">Nome do Proprietário:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $veiculo['nome_proprietario']; ?>" required>

                <label for="documento">Documento:</label>
                <input type="text" id="documento" name="documento" value="<?php echo $veiculo['documento']; ?>" required>

                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" value="<?php echo $veiculo['modelo']; ?>" required>

                <label for="ano">Ano:</label>
                <input type="number" id="ano" name="ano" value="<?php echo $veiculo['ano']; ?>" required>

                <label for="placa">Placa:</label>
                <input type="text" id="placa" name="placa" value="<?php echo $veiculo['placa']; ?>" required>

                <button type="submit" class="btn">Salvar Alterações</button>
            </form>
        </div>
    </div>
</body>
</html>
