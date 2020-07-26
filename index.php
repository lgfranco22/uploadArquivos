<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Upload pdf</title>
    </head>
    <body>
        <h1>Cadastrar Apostilas</h1>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="proc_cad_pdf.php" enctype="multipart/form-data">
            <label>Nome do arquivo:</label>
            <input type="text" name="nome" placeholder="Digitar o nome"><br><br>
			
            <label>Autor:</label>
            <input type="text" name="autor" placeholder="Digitar o nome"><br><br>
			
            <label>Arquivo</label>
            <input type="file" name="arquivo"><br><br>
            
            <input name="SendCadImg" type="submit" value="Cadastrar">	

  </form>
 
                               
    </body>
</html>
