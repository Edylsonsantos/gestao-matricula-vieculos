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

// Processa o formulário ao enviar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $veiculo_id = $_POST['veiculo_id'];
    $motivo = $_POST['motivo'];
    $valor = $_POST['valor'];
    $data = $_POST['data'];
    $cidade = $_POST['cidade'];
    // Insere a multa no banco de dados
    $sql_insert = "INSERT INTO multas (id_veiculo, motivo, valor, data_multa, cidade) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    
    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt) {
        $stmt->bind_param("isdds", $veiculo_id, $motivo, $valor, $data, $cidade);

        if ($stmt->execute()) {
            $message = "Multa adicionada com sucesso!";
            $style = "success";
        } else {
            $message = "Erro ao adicionar multa.";
            $style = "error";
        }

        $stmt->close();
    } else {
        $message = "Erro ao preparar a consulta SQL.";
        $style = "error";
    }
}

// Fecha a conexão com o banco
$conn->close();
header("Location: view-multas.php?style=" . urlencode($style));
?>

