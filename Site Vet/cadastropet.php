<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pets</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('bg4.jpg');
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


        a:hover {
            color: red;
        }
        button{
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
    </style>
</head>
<body>
<?php
include('config.php');
require('verifica.php');
if ($_SESSION["UsuarioNivel"] != "ADM"){ 
  // Usu�rio n�o logado! Redireciona para a p�gina de login 
  header("Location: login.php"); 
  exit; 
  } 

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
    $nome = $_POST['nome'];
    $raca = $_POST['raca'];
    $peso = $_POST['peso'];
    $idade = $_POST['idade'];
    $telefone = $_POST['telefone'];
	if (!$_REQUEST['id'])
	{
		$insere = "INSERT INTO pets (nome, raca, peso, idade, telefone) values('$nome', '$raca', '$peso', '$idade', '$telefone')";
		$result_insere = mysqli_query($con, $insere);
		
		if ($result_insere) echo "<h2> Registro inserido com sucesso!!!</h2>";
		else echo "<h2> Nao consegui inserir!!!</h2>";
		
	} else 	
	{
		$insere = "UPDATE usuario SET 
					nome = '$nome'
					, raca = '$raca'
                    , peso = '$peso'
                    , idade = '$idade'
                    , telefone = '$telefone'
					WHERE id = '{$_REQUEST['id']}'
				";
		$result_update = mysqli_query($con, $insere);

		if ($result_update) echo "<h2> Registro atualizado com sucesso!!!</h2>";
		else echo "<h2> Nao consegui atualizar!!!</h2>";
		
	}
}
?>

<form action="#" method="post" name="usuario">
        <h2>Cadastro de Pets</h2>
        <table>
            <tr>
                <th>Cod.</th>
                <td><?php echo @$_POST['id']; ?></td>
            </tr>
            <tr>
                <td>Nome:</td>
                <td><input type="text" name="nome" value="<?php echo @$_POST['nome']; ?>"required></td>
            </tr>
            <tr>
                <td>Raça:</td>
                <td><input type="text" name="raca" value="<?php echo @$_POST['raca']; ?>"required></td>
            </tr>
            <tr>
                <td>Peso:</td>
                <td><input type="text" name="peso" value="<?php echo @$_POST['peso']; ?>"required></td>
            </tr>
            <tr>
                <td>Idade:</td>
                <td><input type="text" name="idade" value="<?php echo @$_POST['idade']; ?>"required></td>
            </tr>
            <tr>
                <td>Telefone:</td>
                <td><input type="text" name="telefone" value="<?php echo @$_POST['telefone']; ?>"required></td>
            </tr>
            <tr>
                <td colspan="2" align="right">
                    <input type="submit" value="Gravar" name="botao"> 
                    <input type="submit" value="Excluir" name="botao"> 
                    <input type="reset" value="Novo" name="novo"> 
                    <button><a href="logout.php">Sair</a></button>
                    <input type="hidden" name="id" value="<?php echo @$_REQUEST['id'] ?>" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>