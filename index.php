<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Veículos</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://unpkg.com/boxicons/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<?php include 'pages/header.php'; ?>

<div class="container-i">
    <div class="sidebar">
        <ul>
            <li><a href="index.php"><i class="bx bx-home-alt"></i> Início</a></li>
            <li><a href="mod/view-veiculo.php"><i class="bx bx-car"></i> Veículos</a></li>
            <li><a href="mod/view-multas.php"><i class="bx bx-error"></i> Multas</a></li>
            <li><a href="mod/pesquisar-veiculo.php"><i class="bx bx-search-alt"></i> Consultar Veículo</a></li>
            <li><a href="mod/pesquisar-multa.php"><i class="bx bx-search"></i> Consultar Multas</a></li>
            <li><a href="mod/usuario.php"><i class="bx bx-user"></i> Usuários</a></li>
            <li><a href="logout.php"><i class="bx bx-log-out"></i> Sair</a></li>
        </ul>
    </div>


    <div class="content">
        <?php
        // Conexão com o banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vieculos"; // Nome do seu banco de dados

        // Cria a conexão
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        // Obtém o total de veículos
        $sql_veiculos = "SELECT COUNT(*) AS total_veiculos FROM veiculos";
        $result_veiculos = $conn->query($sql_veiculos);
        $total_veiculos = $result_veiculos->fetch_assoc()['total_veiculos'];

        // Obtém o total de funcionários
        $sql_funcionarios = "SELECT COUNT(*) AS total_funcionarios FROM funcionarios";
        $result_funcionarios = $conn->query($sql_funcionarios);
        $total_funcionarios = $result_funcionarios->fetch_assoc()['total_funcionarios'];

        // Soma total das multas
        $sql_soma_multas = "SELECT SUM(valor) AS soma_multas FROM multas";
        $result_soma_multas = $conn->query($sql_soma_multas);
        $soma_multas = $result_soma_multas->fetch_assoc()['soma_multas'];

        // Soma total das multas pagas
        $sql_multas_pagas = "SELECT SUM(valor) AS multas_pagas FROM multas WHERE status_pagamento = 'pago'";
        $result_multas_pagas = $conn->query($sql_multas_pagas);
        $multas_pagas = $result_multas_pagas->fetch_assoc()['multas_pagas'];

        // Soma total das multas não pagas
        $sql_multas_nao_pagas = "SELECT SUM(valor) AS multas_nao_pagas FROM multas WHERE status_pagamento = 'pendente'";
        $result_multas_nao_pagas = $conn->query($sql_multas_nao_pagas);
        $multas_nao_pagas = $result_multas_nao_pagas->fetch_assoc()['multas_nao_pagas'];

        // Fecha a conexão
        $conn->close();
        ?>

        <!-- Card para Total de Veículos -->
        <div class="info-box total-veiculos">
            <div class="icon"><i class='bx bx-car'></i></div>
            <div>
                <h3>Veículos</h3>
                <div class="value"><?php echo $total_veiculos; ?></div>
            </div>
        </div>

        <!-- Card para Total de Funcionários -->
        <div class="info-box total-funcionarios">
            <div class="icon"><i class='bx bx-user'></i></div>
            <div>
                <h3>Usuarios</h3>
                <div class="value"><?php echo $total_funcionarios; ?></div>
            </div>
        </div>

        <!-- Card para Multas Pagas -->
        <div class="info-box multas-pagas">
            <div class="icon"><i class='bx bx-check-circle'></i></div>
            <div>
                <h3>Multas pagas</h3>
                <div class="value">MT <?php echo number_format($multas_pagas, 2, ',', '.'); ?></div>
            </div>
        </div>

        <!-- Card para Multas Não Pagas -->
        <div class="info-box multas-nao-pagas">
            <div class="icon"><i class='bx bx-x-circle'></i></div>
            <div>
                <h3>Multas não pagas</h3>
                <div class="value" >MT <?php echo number_format($multas_nao_pagas, 2, ',', '.'); ?></div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
