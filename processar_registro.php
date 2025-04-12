<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /login.php"); // Redireciona para login se não estiver logado
    exit();
}

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

// Verifica se a requisição foi feita via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $tipo = $_POST['tipo'];
    $marca = $_POST['marca'];
    $nome = $_POST['nome'];
    $documento = $_POST['documento'];
    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $placa = $_POST['placa'];

    // Verifica se o veículo já está registrado com o mesmo documento ou placa
    $sql_check = "SELECT id FROM veiculos WHERE documento = ? OR placa = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ss", $documento, $placa);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // Veículo já registrado, define uma mensagem de erro
        //$message = "<p class='warning'>Este veículo já está registrado.</p>";
        $style = "warning";
    } else {
        // Veículo não encontrado, prossegue com o registro
        $sql_insert = "INSERT INTO veiculos (tipo, marca, nome_proprietario, documento, modelo, ano, placa) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("sssssis", $tipo, $marca, $nome, $documento, $modelo, $ano, $placa);

        if ($stmt_insert->execute()) {
            //$message = "<p class='success'>Veículo registrado com sucesso!</p>";
            $style = "success";
        } else {
            //$message = "<p class='error'>Erro ao registrar veículo.</p>";
            $style = "error";
        }

        $stmt_insert->close();
    }

    $stmt_check->close();
}
// Fecha a conexão com o banco
$conn->close();
header("Location: mod/view-veiculo.php?style=" . urlencode($style));
?>

