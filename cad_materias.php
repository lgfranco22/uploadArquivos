<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de materias</title>
    </head>
    <body>
        <h1>Cadastrar Materias</h1>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="proc_cad_pdf.php" enctype="multipart/form-data">
            <label>Nome da materia:</label>
            <input type="text" name="nome" placeholder="Digite o nome da materia"><br><br>
			
            <label>Semestre da Materia:</label>
            <input type="text" name="semestre" placeholder="Digite o semestre"><br><br>
			           
            <input name="SendCadImg" type="submit" value="Cadastrar">	

  </form>
 
                               
    </body>
</html>
