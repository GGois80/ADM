<?php
// Conexão com o banco de dados
require_once 'conexao.php';

// Se o usuário clicou no botão cadastrar efetua as ações	

$nome = $_POST ['nome'];
$sexo = $_POST ['sexo'];
$celular = $_POST ['Cel'];
$email = $_POST ['email'];
$senha = $_POST ['senha'];
$foto = $_FILES ['foto'];

	//print_r($foto);exit;
	//abaixo faço uma checagem para ver se o usuário não está enviando o campo file em branco, a chave "error" serve para sabermos os niveis de erros
	if ($foto["error"]==4){?>
		<script> 
			alert('Não envie em branco');
			location.href='index.php';
		</script>		
	<?php }if ($foto["error"]==1){?>
		<script>
			alert('O arquivo no upload é maior do que o limite definido em upload_max_filesize no php.ini');//Ai teremos que alterar lá no php.ini meus camaradas, pesquisem e deem seus pulos
			location.href='adm.php';
		</script>	
	<?php }
	//print_r($foto);exit;
	// Se a imagem estiver sido selecionada
	if ($foto["name"]) {	
		
		// Largura máxima em pixels
		$largura = 2000;
		// Altura máxima em pixels
		$altura = 3000;
		// Tamanho máximo do arquivo em bytes
		$tamanho = 1000000; // coloquei 1 megabyte
    	// Verifica se o arquivo é uma imagem através de uma função nativa do PHP preg_match, através de expressões regulares
		
		if(!preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext)){ 
			?>
            	<script>
					alert('Ops! Isso não é uma imagem.');
					location.href='adm.php';
				</script>
            <?php
			} 	
				
	
		// Pega as dimensões da imagem, criando um novo vetor através da função nativa getimagesize
		$dimensoes = getimagesize($foto["tmp_name"]);
		
		// Verifica se a largura da imagem é maior que a largura permitida
		if($dimensoes[0] > $largura) {
			echo "A largura da imagem não deve ultrapassar ".$largura." pixels";
		}

		// Verifica se a altura da imagem é maior que a altura permitida
		if($dimensoes[1] > $altura) {
			echo "Altura da imagem não deve ultrapassar ".$altura." pixels";
		}
		
		// Verifica se o tamanho da imagem é maior que o tamanho permitido
		if($foto["size"] > $tamanho) {
   		 	echo "A imagem deve ter no máximo ".$tamanho." bytes";
		}else {
			
			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
			
        	// Gera um nome único para a imagem, esse nome será criptografado em md5 (assim como poderia ser em sha1, preferi md5 porque não requer tanta segurança e o número de caracteres é menor que sha1), juntamente com o milesegundos que estou upando a imagem
        	$nomefoto = md5(uniqid(time())) . "." . $ext[1];
			//echo $nomefoto;
			//print_r($foto);exit;
        	// Caminho de onde ficará a imagem
        	$caminho = "imagens/" . $nomefoto;
			//echo $foto["tmp_name"];exit;
			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($foto["tmp_name"], $caminho);
		
			// Insere os dados no banco de dados
			$query = "INSERT INTO usuario (nome, sexo, cel, email, senha, foto, flag, moderuser) 
			VALUES ('$nome', '$sexo', '$celular', '$email', sha1('$senha'), '$nomefoto', 1, 1)";
			//echo $query;exit;
			$insere = mysqli_query($conexao,$query);
			if($insere==1){
				echo "<script>alert ('Dados inseridos com sucesso'); location.href='adm.php' </script> ";
			}else{
				echo "<script>alert ('Deu ruim') location.href='adm.php' </script> ";
			}
		}
	}		
?>