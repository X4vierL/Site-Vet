<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <style>
      
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('bg2.jpg'); 
            background-size: cover;
    
            
        }
        .welcome-container {
            text-align: center;
            margin-top: 100px;
        }

        .welcome-message {
            font-size: 2em;
            color: red;
        }

        .menu-links {
            margin-top: 30px;
            text-align: center;
        }

        .menu-links a {
            display: block;
            margin-bottom: 10px;
            font-size: 1.2em;
            text-decoration: none;
            color: #333;
            transition: color 0.3s;
        }

        .menu-links a:hover {
            color: red;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-message">
            Bem Vindo <?php require('verifica.php'); echo $_SESSION["nome_usuario"]; ?>
        </div>
        <div class="menu-links">
            <h1>Menu</h1>
            <a href="relatorio.php">Relatório</a>
            <?php if ($_SESSION["UsuarioNivel"] == "ADM"): ?>
                <a href="cadastropet.php">Cadastro de Pets</a>
            <?php endif; ?>
            <a href="logout.php">Sair</a>
        </div>
    </div>
</body>
</html>
