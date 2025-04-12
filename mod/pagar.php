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

// Variáveis de mensagem
$message = ""; // Variável para armazenar a mensagem de status
$style = ""; // Variável para armazenar a mensagem de status

// Verifica se o ID da multa foi passado na URL
if (isset($_GET['id'])) {
    $multa_id = $_GET['id'];

    // Consulta para verificar se a multa existe e tem status 'pendente'
    $sql_check = "SELECT id, status_pagamento FROM multas WHERE id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $multa_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $row = $result_check->fetch_assoc();

        // Se a multa ainda não foi paga, atualize o status para 'pago'
        if ($row['status_pagamento'] == 'pendente') {
            $sql_update = "UPDATE multas SET status_pagamento = 'pago' WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("i", $multa_id);

            if ($stmt_update->execute()) {
                $message = "Multa paga com sucesso!";
                $style = "success";
            } else {
                $message = "Erro ao atualizar o status da multa.";
                $style = "error";
            }

            $stmt_update->close();
        } else {
            $message = "A multa já foi paga!";
            $style = "warning";
        }
    } else {
        $message = "Multa não encontrada.";
        $style = "error";
    }

    $stmt_check->close();
}

// Fecha a conexão com o banco
$conn->close();

// Redireciona de volta para a página de consulta com a mensagem
header("Location: view-multas.php?message=" . urlencode($message) . "&style=" . urlencode($style));
exit;
?>
