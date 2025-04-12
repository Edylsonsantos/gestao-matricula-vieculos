
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
                <li><a href="../"><i class="bx bx-home-alt"></i> Início</a></li>
                <li><a href="view-veiculo.php"><i class="bx bx-car"></i> Veículos</a></li>
                <li><a href="view-multas.php"><i class="bx bx-error"></i> Multas</a></li>
                <li><a href="pesquisar-veiculo.php"><i class="bx bx-search-alt"></i> Consultar Veículo</a></li>
                <li><a href="pesquisar-multa.php"><i class="bx bx-search"></i> Consultar Multas</a></li>
                <li><a href="usuario.php"><i class="bx bx-user"></i> Usuários</a></li>
                <li><a href="../logout.php"><i class="bx bx-log-out"></i> Sair</a></li>
            </ul>
        </div>

        
        <div class="content">
            <form action="save-usuario.php" method="POST">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>

                <select id="cargo" name="cargo" required>
                    <option value="">Selecione o cargo</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Gestor">Gestor</option>
                    <option value="Comerciante">Comerciante</option>
                </select>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" required>

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>

                <button type="submit" class="btn">Registrar</button>
            </form>
        </div>
    </div>
</body>
</html>


