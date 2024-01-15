<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CONSULTA PAGINACIÓN</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
<script>
    function eliminarDato(id, nombre) {
            // Mostrar una ventana de confirmación
            var confirmacion = confirm("¿Estás seguro de que deseas eliminar "+nombre+"?");

        // Verificar la respuesta del usuario
        if (confirmacion) {
            document.location.href="?orden=Borrar&id="+id;
            //alert("Dato eliminado correctamente");
        } else {
            // El usuario ha hecho clic en "Cancelar" o ha cerrado la ventana de confirmación
            alert("Operación de eliminación cancelada");
        }
    }
    function llamarModificar(id){
        document.location.href="?orden=Modificar&id="+id;
    }
</script>
</head>
<body>
<div id="container" style="width: 900px;">
<div id="header">
<h1>CONSULTA CON PAGINACIÓN versión 1.0</h1>
</div>
<div id="content">
<table>
<tr><th>id</th><th>first_name</th><th>email</th>
<th>gender</th><th>ip_address</th><th>teléfono</th></tr>
<?php foreach ($tvalores as $valor): ?>
<tr>
<td><?= $valor->id?> </td>
<td><?= $valor->first_name ?> </td>
<td><?= $valor->email ?> </td>
<td><?= $valor->gender ?> </td>
<td><?= $valor->ip_address ?> </td>
<td><?= $valor->telefono ?> </td>




<td><input type="button" value="Borrar" onclick="eliminarDato('<?=$valor->id?>','<?=$valor->first_name?>')"></td>
<td><input type="button"  value="Modificar" onclick="llamarModificar('<?=$valor->id?>')"></td>

<tr>
<?php endforeach ?>
</table>
<form>
<br>
<input type="submit" name="orden" value="Nuevo"><br></br>
<input type="submit" name="orden" value="Primero">
<input type="submit" name="orden" value="Siguiente">
<input type="submit" name="orden" value="Anterior">
<input type="submit" name="orden" value="Ultimo">
</form>
</div>
</div>
</body>
</html>