
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
            <form id="vehicleForm"  action="../processar_registro.php" method="POST">
                <label for="tipo">Tipo de Veículo:</label>
                <select id="tipo" name="tipo" required>
                    <option value="">Selecione</option>
                    <option value="Motorizada">Motorizada</option>
                    <option value="Carro">Carro</option>
                    <option value="Bicicleta">Bicicleta</option>
                    <option value="Triciclo">Triciclo</option>
                </select>

                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" required>

                <label for="nome">Nome do proprietário:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="documento">Documento de identificação:</label>
                <input type="number" id="documento" name="documento" required>

                <label for="modelo">Modelo:</label>
                <input type="text" id="modelo" name="modelo" required>

                <label for="ano">Ano de Fabricação:</label>
                <input type="number" id="ano" name="ano" required min="1900" max="<?php echo date('Y'); ?>">

                <label for="placa">Placa:</label>
                <input type="text" id="placa" name="placa">

                <input type="submit" value="Registrar veículo">
            </form>
        </div>
    </div>
</body>
</html>


