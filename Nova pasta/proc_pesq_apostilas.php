<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uploadpdf";

$conn = mysqli_connect($servername, $username, $password, $dbname);

//Receber a requisão da pesquisa 
$requestData= $_REQUEST;


//Indice da coluna na tabela visualizar resultado => nome da coluna no banco de dados
$columns = array( 
	0 =>'nome', 
	1 => 'autor',

);

//Obtendo registros de número total sem qualquer pesquisa
$result_apostilas"SELECT nome, autor FROM arquivos";
$resultado_apostilas =mysqli_query($conn, $result_apostilas);
$qnt_linhas = mysqli_num_rows($resultado_apostilas);

//Obter os dados a serem apresentados
$result_apostilas = "SELECT nome, autor FROM arquivos WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // se houver um parâmetro de pesquisa, $requestData['search']['value'] contém o parâmetro de pesquisa
	$result_apostilas.=" AND ( nome LIKE '".$requestData['search']['value']."%' ";    
	$result_apostilas.=" OR autor LIKE '".$requestData['search']['value']."%' ";
	
}

$resultado_apostilas=mysqli_query($conn, $result_apostilas);
$totalFiltered = mysqli_num_rows($resultado_apostilas);
//Ordenar o resultado
$result_apostilas.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
$resultado_apostilas=mysqli_query($conn, $result_apostilas);

// Ler e criar o array de dados
$dados = array();
while( $row_apostilas =mysqli_fetch_array($resultado_apostilas) ) {  
	$dado = array(); 
	$dado[] = $row_apostilas["nome"];
	$dado[] = $row_apostilas["autor"];
		
	$dados[] = $dado;
}


//Cria o array de informações a serem retornadas para o Javascript
$json_data = array(
	"draw" => intval( $requestData['draw'] ),//para cada requisição é enviado um número como parâmetro
	"recordsTotal" => intval( $qnt_linhas ),  //Quantidade de registros que há no banco de dados
	"recordsFiltered" => intval( $totalFiltered ), //Total de registros quando houver pesquisa
	"data" => $dados   //Array de dados completo dos dados retornados da tabela 
);

echo json_encode($json_data);  //enviar dados como formato json
