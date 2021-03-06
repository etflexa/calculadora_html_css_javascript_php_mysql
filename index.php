<?php
	$pdo = new PDO('mysql:host=localhost;dbname=calculadora_db','root','');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Calculadora</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8">
	<meta name='viewport' content='width=device-width,initial-scale=1.0,maximum-scale=1.0'>
	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	<script type="text/javascript" src="js/main.js"></script>
	<title></title>
</head>
<body>
	<div class="left">
		<div class="main">

			<form method="post" name="form">

				<?php

					if(isset($_POST['acao'])){
							$titulo = $_POST['titulo'];
							$conta = $_POST['conta'];
							$sql = $pdo->prepare("INSERT INTO `contas` VALUES (null,?,?)");
							$sql->execute(array($titulo,$conta));
						}

				?>


				<div class="save-button">
					<input type="submit" name="acao" value="Salvar Conta">
				</div>
				<input type="text" class="textview" name="titulo" placeholder="Título da conta" required>
				<input type="text" class="textview" name="conta" required>
			</form>

			<table>

				<tr>
					<td><input class="button" type="button" value="C" onclick="clean()"></td>
					<td><input class="button" type="button" value="<" onclick="back()"></td>
					<td><input class="button" type="button" value="/" onclick="insert('/')"></td>
					<td><input class="button" type="button" value="X" onclick="insert('*')"></td>
				</tr>

				<tr>
					<td><input class="button" type="button" value="7" onclick="insert(7)"></td>
					<td><input class="button" type="button" value="8" onclick="insert(8)"></td>
					<td><input class="button" type="button" value="9" onclick="insert(9)"></td>
					<td><input class="button" type="button" value="-" onclick="insert('-')"></td>
				</tr>

				<tr>
					<td><input class="button" type="button" value="4" onclick="insert(4)"></td>
					<td><input class="button" type="button" value="5" onclick="insert(5)"></td>
					<td><input class="button" type="button" value="6" onclick="insert(6)"></td>
					<td><input class="button" type="button" value="+" onclick="insert('+')"></td>
				</tr>

				<tr>
					<td><input class="button" type="button" value="1" onclick="insert(1)"></td>
					<td><input class="button" type="button" value="2" onclick="insert(2)"></td>
					<td><input class="button" type="button" value="3" onclick="insert(3)"></td>
					<td rowspan=5><input style="height: 100px;" class="button" type="button" value="=" onclick="equal()"></td>
				</tr>

				<tr>
					<td colspan=2><input class="button" style="width:100px;" type="button" value="0" onclick="insert(0)"></td>
					<td><input class="button" type="button" value="." onclick="insert('.')"></td>
					
				</tr>

			</table>
			
		</div>
	</div>

	<div class="right">
		<div class="view-information">
				<h2>Valores Salvos:</h2>
				<div class="view">
					<?php

						if(isset($_GET['excluir'])) {
							$id = (int)$_GET['excluir'];
							$pdo->exec("DELETE FROM `contas` WHERE id = $id");
							
						}

						$info = $pdo->prepare("SELECT * FROM `contas`");
						$info->execute();
						$info = $info->fetchAll();
						foreach ($info as $key => $value) {

					?>

					<div class="box-visualization">
						<div class="box-single-wrapper">
							<b>Título da Conta:</b> <?php echo $value['titulo']; ?><br>
							<b>Valor:</b> R$ <?php echo $value['conta']; ?><br>
							<a href="?excluir=<?php echo $value['id']; ?>">Apagar Conta</a>
							
							
						</div>
				
			</div>

			<?php } ?>
			<div class="clear"></div>
				</div>
			</div>
	</div>
</body>
</html>