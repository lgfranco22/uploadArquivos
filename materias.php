<?php
include_once './conexao.php';
//SQL para selecionar os registros
$result_materias = "SELECT * FROM materias ORDER BY nome ASC";

//Seleciona os registros
$resultado_materias = $conn->prepare($result_materias);
$resultado_materias->execute();
$consut_id = "SELECT id FROM materias ORDER BY nome ASC";

//Seleciona os registros
$res_id = $conn->prepare($consut_id);
$res_id->execute();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Materias</title>
</head>
<body>
<h1>Apostilas para download</h1>
<table class="lista-apostila" border="3px" cellpadding="3px" cellspacing="2" id="alter" align="center" width="50%">
    <tr>
        <td>Primeiro Semestre</td>
        <td>Segundo Semestre</td>
        
    </tr>
    <?php while ($row_materias = $resultado_materias->fetch(PDO::FETCH_ASSOC)) {?>
        <tr>
            <td><?php echo $row_apostila["primsemestre"];?> </td>
            <td><?php echo $row_apostila["segsemestre"];?></td>
         </tr>
    <?php } ?>
</table>
</body>
</html>
