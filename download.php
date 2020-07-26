<?php

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("content-Type: text/html;  charset=utf-8",true);

function download($file,$filename){
if(isset($file) && file_exists($file)){
         $extensao=strtolower(substr(strrchr(basename($file),"."),1));
         switch($extensao){ 
         case "pdf": $tipo="application/pdf"; break;
         case "exe": $tipo="application/octet-stream"; break;
         case "zip": $tipo="application/zip"; break;
         case "doc": $tipo="application/msword"; break;
         case "xls": $tipo="application/vnd.ms-excel"; break;
         case "ppt": $tipo="application/vnd.ms-powerpoint"; break;
         case "gif": $tipo="image/gif"; break;
         case "png": $tipo="image/png"; break;
         case "jpg": $tipo="image/jpg"; break;
         case "mp3": $tipo="audio/mpeg"; break;
         case "php": 
         case "htm": 
         case "html": 
         }
         header("Content-Type: ".$tipo); 
         header("Content-Length: ".filesize($file));
         header("Content-Disposition: attachment; filename=".urldecode(str_replace("+", "%20", urlencode(utf8_decode($filename)))).".".$extensao); 
         readfile($file);
         exit;
}
}

include("./conexao.php");

$pasta="./uploads/";



$id=$_GET["id"];

$consulta = $conn->query("SELECT nome, arquivo FROM arquivos WHERE id=$id");
$consulta->execute();
$dados = $consulta->fetchAll();

foreach($dados as $linha){  
         //Realiza o download for?ado no navegador, pegando o caminho do arquivo e o nome e gerando o arquivo de download com o nome
         download($pasta.$linha["arquivo"],$linha["nome"]);  
}
