<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('bg3.jpg');
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input {
            width: calc(100% - 16px);
            padding: 12px;
            margin: 10px 0;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"], input[type="reset"] {
            width: 48%;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            padding: 12px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
            color: #333;
            display: block;
            margin-top: 20px;
            font-weight: bold;
            transition: color 0.3s;
        }

        a:hover {
            color: red;
        }
    </style>
</head>
<body>
<?php
include('config.php');

$id = @$_REQUEST['id'];

if (@$_REQUEST['botao'] == "Excluir") {
		$query_excluir = "
			DELETE FROM usuario WHERE id='$id'
		";
		$result_excluir = mysqli_query($con, $query_excluir);
		
		if ($result_excluir) echo "<h2> Registro excluido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui excluir!!!</h2>";
}

if (@$_REQUEST['id'] and !$_REQUEST['botao'])
{
	$query = "
		SELECT * FROM usuario WHERE id='{$_REQUEST['id']}'
	";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($result);
	//echo "<br> $query";	
	foreach( $row as $key => $value )
	{
		$_POST[$key] = $value;
	}
}

if (@$_REQUEST['botao'] == "Gravar") 
{
    $login = $_POST['login'];
    $senha = MD5($_POST['senha']);
	if (!$_REQUEST['id'])
	{
		$insere = "INSERT into usuario (login, senha, nivel) VALUES ('$login', '$senha', 'USER')";
		$result_insere = mysqli_query($con, $insere);
		
		if ($result_insere) echo "<h2> Registro inserido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui inserir!!!</h2>";
		
	} else 	
	{
		$insere = "UPDATE usuario SET 
					login = '$login'
					, senha = '$senha'
                    , nivel = 'USER'
					WHERE id = '{$_REQUEST['id']}'
				";
		$result_update = mysqli_query($con, $insere);

		if ($result_update) echo "<h2> Registro atualizado com sucesso!!!</h2>";
		else echo "<h2> Nao consegui atualizar!!!</h2>";
		
	}
}
?>

<form action="#" method="post" name="usuario">
        <h2>Cadastro de Usuários</h2>
        <table>
            <tr>
                <th>Cod.</th>
                <td><?php echo @$_POST['id']; ?></td>
            </tr>
            <tr>
                <td>Login:</td>
                <td><input type="text" name="login" value="<?php echo @$_POST['login']; ?>" required></td>
            </tr>
            <tr>
                <td>Senha:</td>
                <td><input type="text" name="senha" value="<?php echo @$_POST['senha']; ?>" required></td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="submit" value="Gravar" name="botao">  
                    <input type="reset" value="Novo" name="novo"> 
                    <input type="hidden" name="id" value="<?php echo @$_REQUEST['id'] ?>" />
                </td>
            </tr>
        </table>
    </form>
    <a href="logout.php">Sair</a>
</body>
</html>