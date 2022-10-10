<?php
//Chamando o arquivo de conexão
require_once 'conexao.php';
//Inicia a sessão
session_start();
//se existir o "Enviar" , é porque clicaram no botão
if (isset($_POST['Enviar'])):
	//Array de erros
	$erros = array();
	//Sanitiza os dados, removendo os caracteres indesejados
	$login = mysqli_escape_string($conexao, $_POST['email']);
	$senha = mysqli_escape_string($conexao, $_POST['pwd']);
	//Condição se os campos de login e senha estão vazios
	if(empty($login) or empty($senha)):
		//Guardando no array de erro
		$erros[] = "<li> O campo login/senha precisa ser preenchido </li>";
	//Se não
	else:
		//Criptografa a senha
		$senha=md5($senha);
		//Manda o comando para o banco de dados, pegando e confirmando os dados (consulta o banco de dados)
		$sql= "SELECT idUsuario, emailUsuario FROM usuario WHERE emailUsuario= '$login' AND senha ='$senha'";
		//Efetivamente pega os dados (conectando e mandando o comando)
		$resultado = mysqli_query($conexao,$sql);
		//Fechando a conexão depois de pegar os dados
		mysqli_close($conexao);
		//Condição se numero de resultados > 0
		if (mysqli_num_rows($resultado) > 0):
			//Guardando os dados com a função mysqli_fetch_array
			$dados=mysqli_fetch_array($resultado);
			//Sessão para logar o usuário
			$_SESSION['logado'] = true;
			//Sessão para guardar o id do usuário logado
			$_SESSION['id'] = $dados[0];
			//Manda o usuário para a página principal
			header('Location: home.php');
		//Se não
		else:
			//Fala que houve um erro com os dados
			$erros[]="Usuário e senha não conferem.";
		//Fechando os ifs	
		endif;
	endif;	
endif;	
?>
<!-- Chamando o cabeçalho da página-->
<?php include_once 'header.php';?>
	<!-- Título em tamanho h1-->
	<h1>Login de usuário</h1><br>
<?php
	//Condição de checamento de dados
	if(!empty($erros)):
		//Loop de erro
		foreach($erros as $erro):
			//Imprime erro
			echo $erro;
		//Fecha o loop
		endforeach;
	//Fecha o if
	endif;
?>
	<!-- Abrindo um formulário para login-->
	<form method="POST">
		<!-- Texto que aparece-->
		<label for = "email">Email:</label>
		<!-- Campo de digitação-->
		<input type = "email" id = "email" name = "email" placeholder = "Email"><br><br><br>
		<!-- Texto que aparece-->
		<label for = "pwd">Senha:</label>
		<!-- Campo de digitação-->
		<input type = "password" id = "pwd" name = "pwd" minlength = "8" placeholder = "Senha"><br><br><br><br>
		<!-- Campo de enviar-->
		<input type = "submit" name = "Enviar" value = "Confirmar">
	<!-- Fechando o formulário-->
	</form>
	<!-- Quebra de linha -->
	<br>
	<!-- Parágrafo para fazer cadastro, caso não tenha login -->
	<p>Não possui login? <a href="cadastro.php">Cadastre-se agora</a></p>
	<!-- Parágrafo para fazer cadastro, caso não tenha login -->
<?php include_once 'footer.php';?>
