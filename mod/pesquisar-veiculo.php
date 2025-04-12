
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
        <form action="../consultar_veiculos.php" method="POST">
            <div>
                <label for="documento"><i class="bx bx-id-card icon"></i> Documento de identificação:</label>
                <input type="number" id="documento" name="documento" required>
            </div>

            <div>
                <label for="placa"><i class="bx bx-car icon"></i> Placa:</label>
                <input type="text" id="placa" name="placa" required>
            </div>

            <div>
                <input type="submit" value="Consultar">
            </div>
        </form>
        </div>
    </div>
</body>
</html>


