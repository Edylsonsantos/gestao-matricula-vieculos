<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Veículos</title>
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
            <form action="consulta-multa.php" method="GET" class="consulta-form">

                <div class="form-group">
                    <label for="placa"><i class="bx bx-car icon"></i> Placa do veículo:</label><br>
                    <input type="text" id="placa" name="placa" placeholder="Digite a placa" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-consultar"><i class="bx bx-search"></i> Consultar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
