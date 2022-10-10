<?php
//Iniciar  Sessão
session_start();
//Conexão
require_once 'conexao.php';
//Se existir o "Enviar" , é porque clicaram no botão
if(isset($_POST['Enviar'])):

	echo "testando";
	//Limpa os dados dos campos e envia pelo método POST para o arquivo de conexão
	$nome = mysqli_escape_string($conexao,$_POST['nome']);
	$sobrenome = mysqli_escape_string($conexao,$_POST['sobrenome']);
	$data = mysqli_escape_string($conexao,$_POST['data']);
	//Senha criptografada com o MD5
	$senha = md5(mysqli_escape_string($conexao,$_POST['senha']));
	$email = mysqli_escape_string($conexao,$_POST['email']);
	$logradouro = mysqli_escape_string($conexao, $_POST['logradouro']);
	$descriLogradouro = mysqli_escape_string($conexao, $_POST['descricao']);
	$numero = mysqli_escape_string($conexao, $_POST['numeroEnd']);
	$cep = mysqli_escape_string($conexao,$_POST['cep']);
	$complemento = mysqli_escape_string($conexao,$_POST['complemento']);
	$bairro = mysqli_escape_string($conexao,$_POST['bairro']);
	$municipio = mysqli_escape_string($conexao,$_POST['municipio']);
	$estado = mysqli_escape_string($conexao,$_POST['estado']);
	//Sanitizando os campos de nome e sobrenome
	$nomeSanitize = filter_var($nome, FILTER_SANITIZE_STRING);
	$sobrenomeSanitize = filter_var($sobrenome, FILTER_SANITIZE_STRING);
	//Validando o campo de e-mail
	$emailValidate = filter_var($email, FILTER_VALIDATE_EMAIL);
	//CEP já está validando no código HTML na linha 49
	//Fazendo o comando para o SQL
	$sql="INSERT INTO usuario(nomeUsuario, sobrenomeUsuario, senha, dataNascimento) VALUES ('$nomeSanitize', '$sobrenomeSanitize', '$senha', '$data');";
	/* INSERT INTO tipo_contato(descriTipoContato) VALUES ('$emailValidate');
	INSERT INTO tipo_logradouro(descriTipoLogradouro) VALUES ('$logradouro');
	INSERT INTO bairro(descriBairro) VALUES ('$bairro');
	INSERT INTO municipio(descriMunicipio) VALUES ('$municipio');
	INSERT INTO estado(descriEstado) VALUES ('$estado');
	INSERT INTO endereco(numero, CEP, descricao) VALUES ('$numero', '$cep', '$descriLogradouro');
	INSERT INTO complemento(descriComplemento) VALUES ('$complemento');"*/

	echo $sql;

	//Condição de que se foi enviado
	if(mysqli_query($conexao, $sql)):
		//Irá fazer a sessão da mensagem (Cadastrado com sucesso)
		$_SESSION['mensagem'] = "Cadastro com sucesso!";
		//E manda para o login
		header('Location: login.php');
	//Se não
	else:
		//Mostra a mensagem Erro ao cadastrar
		$_SESSION['mensagem'] = "Erro ao cadastrar!";		
	//Fecha os ifs
	endif;
endif;
?>
<!-- Criando o corpo da página-->
<!-- Chamando o cabeçalho da página-->
<?php include_once 'header.php';?>
	<!-- Título com tamanho em h1-->
	<h1>Cadastro de informações de usuário</h1>
	<h2>Dados Pessoais</h2>
	<!-- Abrindo um formulário para Cadastro-->
	<form action="cadastro.php" method="POST">
		<!-- Texto que aparece-->
		<label for = "fname">Nome:</label>
		<!-- Campo de digitação-->
		<input type = "text" id = "fname" name = "nome" placeholder = "Digite seu nome"><br><br>
		<!-- Texto que aparece-->
		<label for = "lname"><br>Sobrenome:</label>
		<!-- Campo de digitação-->
		<input type = "text" id = "lname" name = "sobrenome" placeholder = "Digite seu sobrenome"><br><br>
		<!-- Texto que aparece-->
		<label for = "fdata"><br>Data de Nascimento</label>
		<!--- Campo de Digitação-->
		<input type = "date" id = "fdata" name = "data" placeholder = "Informe sua data de nascimento"><br><br>
		<!-- Texto que aparece-->
		<label for = "pwd"><br>Senha:</label>
		<!-- Campo de digitação-->
		<input type = "password" id = "pwd" name = "senha" minlength = "8" placeholder = "Digite uma senha"><br><br>
		<h2>Dados de contato</h2>
		<!-- Texto que aparece-->
		<label for = "email">E-mail:</label>
		<!-- Campo de digitação-->
		<input type = "email" id = "campo" name = "email" placeholder = "Digite seu e-mail"><br><br>
		<!-- Texto que aparece-->
		<!--<label for = "numero">Número de celular:</label>-->
		<!-- Campo de digitação-->
		<!--<input type = "tel" id = "campo" name = "numero"><br><br>-->
		<!-- Texto que aparece-->
		<!--<label for = "facebook">Facebook:</label>-->
		<!-- Campo de digitação -->
		<!--<input type = "text" id = "campo" name = "facebook"><br><br>-->
		<!-- Texto que aparece -->
		<!--<label for = "instagram">Instagram:</label>-->
		<!-- Campo de digitação -->
		<!--<input type = "text" id = "campo" name = "instagram"><br><br>-->
		<!-- Texto que aparece -->
		<!--<label for = "telefone">Telefone:</label>-->
		<!-- Campo de digitação -->
		<!--<input type = "tel" id = "campo" name = "telefone"><br><br><br><br>-->
		<!-- Subtítulo com tamanho em h2-->
		<h2>Dados de endereço</h2>
		<!-- Texto que aparece -->
		<label for = "logradouro">Logradouro:</label>
		<!-- Campo de digitação -->
		<input type = "text" id = "campo" name = "logradouro" placeholder = "Digite seu logradouro"><br><br>
		<!-- Texto que aparece -->
		<label for = "descricao">Nome do logradouro:</label>
		<!-- Campo de digitação -->
		<input type = "text" id = "campo" name = "descricao"placeholder ="Digite o nome do logradouro"><br><br>
		<!-- Texto que aparece -->
		<label for = "numero">Número:</label>
		<!-- Campo de digitação -->
		<input type = "number" id = "campo" name = "numeroEnd" placeholder ="Digite o número da residência"><br><br>
		<!-- Texto que aparece -->
		<label for = "country_code"><br>CEP:</label>
		<!-- Campo de digitação-->
		<input type = "text" id = "country_code" placeholder = "Digite seu CEP" name = "cep" pattern = "[0-9]{5}-[0-9]{3}" title = "CEP"><br><br>
		<!-- Texto que aparece -->
		<label for = "complemento">Complemento:</label>
		<!-- Campo de digitação -->
		<input type = "text" id = "campo" name = "complemento"placeholder ="Digite seu complemento"><br><br>
		<!-- Texto que aparece -->
		<label for = "bairro">Bairro:</label>
		<!-- Campo de digitação -->
		<input type = "text" id = "campo" name = "bairro" placeholder ="Digite seu bairro"><br><br>
		<!-- Texto que aparece -->
		<label for = "municipio">Município:</label>
		<!-- Campo de digitação -->
		<input type = "text" id = "campo" name = "municipio" placeholder ="Digite seu município"><br><br>
		<!-- Texto que aparece -->
		<label for = "estado">Estado:</label>
		<!-- Campo de digitação -->
		<input type = "text" id = "campo" name = "estado" placeholder ="Digite seu Estado"><br><br>
		<!-- Campo de enviar-->
		<input type = "submit" name = "Enviar" value = "Cadastrar"><br><br><br>
	<!-- Fechando o formulário-->
	</form>
<!-- Chamando o rodapé-->
<?php include_once 'footer2.php';?>
