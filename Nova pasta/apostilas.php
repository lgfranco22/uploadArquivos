<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Celke</title>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" language="javascript">
		$(document).ready(function() {
				$.fn.dataTable.ext.errMode = function(obj,param,err){
                var tableId = obj.sTableId;
                console.log('Handling DataTable issue of Table '+tableId);
			$('#listar-apostilas').DataTable({			
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": "./proc_pesq_apostilas.php",
					"type": "POST"
				}
			});
		} );
		</script>
	</head>
	<body>
		<h1>Listar Apostilas</h1>
		<table id="listar-apostilas" class="display" style="width:100%">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Autor</th>
	     		</tr>
			</thead>
		</table>		
	</body>
</html>
