<?php
include ('config.php');

session_start(); // inicia a sessao	


if (@$_REQUEST['botao']=="Entrar")
{
	$login = $_POST['login'];
	$senha = MD5($_POST['senha']);
	
	$query = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha' ";
	$result = mysqli_query($con, $query);
	while ($coluna=mysqli_fetch_array($result)) 
	{
		$_SESSION["id_usuario"]= $coluna["id"]; 
		$_SESSION["nome_usuario"] = $coluna["login"]; 
		$_SESSION["UsuarioNivel"] = $coluna["nivel"];

		// caso queira direcionar para páginas diferentes
		$niv = $coluna['nivel'];
		if($niv == "USER"){ 
			header("Location: menu.php"); 
			exit; 
		}
		
		if($niv == "ADM"){ 
			header("Location: menu.php"); 
			exit; 
		}
		// ----------------------------------------------
	}
	
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('bg.jpg'); 
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        form {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 300px;
            text-align: center;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
            color: #333;
        }

        a:hover {
            color: #000;
        }
    </style>
</head>
<body>
    <form action="#" method="post">
        Login: <input type="text" name="login" required><br>
        Senha: <input type="password" name="senha" required><br>
        <input type="submit" name="botao" value="Entrar"><br>
        <br>É novo? <a href="cadastrar.php">Cadastre-se</a>
    </form>
</body>
</html>











