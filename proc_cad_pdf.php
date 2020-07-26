<?php

session_start();
include_once './conexao.php';
//Verificar se o usuário clicou no botão, clicou no botão acessa o IF
// e tenta cadastrar, caso contrario acessa o ELSE
	
$SendCadImg = filter_input(INPUT_POST, 'SendCadImg', FILTER_SANITIZE_STRING);
if ($SendCadImg) {
    //Receber os dados do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
	$autor = filter_input(INPUT_POST, 'autor', FILTER_SANITIZE_STRING);
    $nome_arquivo = $_FILES['arquivo']['name'];

	//Substituir os caracteres especiais
	$original = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
    $substituir = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';	
	$nome_arquivo = strtr(utf8_decode($nome_arquivo), utf8_decode($original), $substituir);
	
	//Substituir o espaco em branco pelo traco
	$nome_arquivo = str_replace(' ', '-', $nome_arquivo);
	
	//Converter para minusculo
	$nome_arquivo = strtolower($nome_arquivo);
    //var_dump($_FILES['arquivo']);
    //Inserir no BD
    $result_pdf = "INSERT INTO arquivos (nome, autor, arquivo) VALUES (:nome, :autor, :arquivo)";
    $insert_apostila = $conn->prepare($result_pdf);
    $insert_apostila->bindParam(':nome', $nome);
	$insert_apostila->bindParam(':autor', $autor);
    $insert_apostila->bindParam(':arquivo', $nome_arquivo);

    //Verificar se os dados foram inseridos com sucesso
    if ($insert_apostila->execute()) {
        //Recuperar último ID inserido no banco de dados
        $ultimo_id = $conn->lastInsertId();

        //Diretório onde o arquivo vai ser salvo
        $diretorio = 'uploads/';
		//Diretório onde o arquivo vai ser salvo concatenado com o nome do arquivo
		$arquivo_pdf = $diretorio.$nome_arquivo;

        //Criar a pasta de pdf 
        mkdir($diretorio, 0755);
        
        if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $arquivo_pdf)){
            $_SESSION['msg'] = "<p style='color:green;'>Dados salvo com sucesso e upload da arquivo realizado com sucesso</p>";
            header("Location: index.php");
        }else{
            $_SESSION['msg'] = "<p><span style='color:green;'>Dados salvo com sucesso. </span><span style='color:red;'>Erro ao realizar o upload da arquivo</span></p>";
            header("Location: index.php");
        }        
    } else {
        $_SESSION['msg'] = "<p style='color:red;'>Erro ao salvar os dados</p>";
        header("Location: index.php");
    }
} else {
    $_SESSION['msg'] = "<p style='color:red;'>Erro ao salvar os dados</p>";
    header("Location: index.php");
}