<html>
<body>
<meta charset=utf-8>
<font size=7 color=red> Entrei no Relatório - <?php require('verifica.php'); 
echo $_SESSION["nome_usuario"]; include('config.php');

?></font>
</head>

<body>
<form action="relatorio.php?botao=gravar" method="post" name="form1">
<table width="95%" border="1" align="center">
  <tr>
    <td colspan=5 align="center">Relat&oacute;rio de Pets</td>
  </tr>
  <tr>
    <td width="18%" align="right">Nome:</td>
    <td width="15%"><input type="text" name="nome"  /></td>
    <td width="15%" align="right">Raca:</td>
    <td width="18%"><input type="text" name="raca" size="3" /></td>
    <td width="15%" align="right">Peso:</td>
    <td width="18%"><input type="text" name="peso" size="3" /></td>
    <td width="15%" align="right">Idade:</td>
    <td width="18%"><input type="text" name="idade" size="3" /></td>
    <td width="15%" align="right">Telefone:</td>
    <td width="18%"><input type="text" name="telefone" size="3" /></td>
    <td width="21%"><input type="submit" name="botao" value="Gerar" /></td>
  </tr>
</table>
</form>

<?php if (@$_REQUEST['botao'] == "Gerar") { ?>

<table width="95%" border="1" align="center">
  <tr bgcolor="#9999FF">
    <th width="5%">C&oacute;d</th>
    <th width="25%">Nome</th>
    <th width="13%">Raca</th>
    <th width="10%">Peso</th>
    <th width="10%">Idade</th>
    <th width="10%">Telefone</th>
  </tr>

<?php

	$nome = $_POST['nome'];
	$raca = $_POST['raca'];
	$peso = $_POST['peso'];
    $idade = $_POST['idade'];
    $telefone = $_POST['telefone'];
	$query = "SELECT *
			  FROM pets 
			  WHERE id > 0 ";
	$query .= ($nome ? " AND nome LIKE '%$nome%' " : "");
    $query .= ($raca ? " AND raca LIKE '%$raca%' " : "");
    $query .= ($peso ? " AND peso LIKE '%$peso%' " : "");
    $query .= ($idade ? " AND idade LIKE '%$idade%' " : "");
    if ($_SESSION["UsuarioNivel"] == "ADM"){
	    $query .= ($telefone ? " AND telefone = '$telefone' " : "");
    }$query .= " ORDER by id";
	$result = mysqli_query($con, $query);

	while ($coluna=mysqli_fetch_array($result)) 
	{
		
	?>

    
    <tr>
      <th width="5%"><?php echo $coluna['id']; ?></th>
      <th width="30%"><?php echo $coluna['nome']; ?></th>
      <th width="15%"><?php echo $coluna['raca']; ?></th>
      <th width="12%"><?php echo $coluna['peso']; ?></th>
      <th width="15%"><?php echo $coluna['idade']; ?></th>
      <th width="12%"><?php if ($_SESSION["UsuarioNivel"] == "ADM") echo $coluna['telefone']; ?></th>
        <td>

    </tr>

    <?php
	
	} // fim while
?>
</table>
<?php	
}
?>
</body>