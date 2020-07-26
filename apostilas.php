<?php
include_once './conexao.php';
//SQL para selecionar os registros
        $result_apostilas = "SELECT * FROM arquivos ORDER BY nome ASC";

        //Seleciona os registros
        $resultado_apostilas = $conn->prepare($result_apostilas);
        $resultado_apostilas->execute();
		$consut_id = "SELECT id FROM arquivos ORDER BY nome ASC";

        //Seleciona os registros
        $res_id = $conn->prepare($consut_id);
        $res_id->execute();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Apostilas</title>
    </head>
    <body>
        <h1>Apostilas para download</h1>
		<table class="lista-apostila" border="3px" cellpadding="3px" cellspacing="2" id="alter" align="center" width="50%">
		     <tr>
               <td>Nome </td>
               <td>Autor</td>
			   <td>Download</td>
            </tr>
		<?php while ($row_apostila = $resultado_apostilas->fetch(PDO::FETCH_ASSOC)) {?>
			<tr>
               <td><?php echo $row_apostila["nome"];?> </td>
               <td><?php echo $row_apostila["autor"];?></td>   
			   <td><a href="./download.php?id=<?php echo $row_apostila["id"]; ?>"><?php echo $row_apostila["nome"] ?></a></td>			   
            </tr>		
        <?php } ?>
		</table>
    </body>
</html>
