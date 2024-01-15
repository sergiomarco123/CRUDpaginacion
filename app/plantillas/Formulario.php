<?php
// PLANTILLA DEL FORMULARIO
// El mismo fomularios lo utilizo para las ordenes: detalles, alta o modificar 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>CRUD DE USUARIOS</title>
    <link href="web/default.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="container" style="width: 600px;">
        <div id="header">
            <h1>GESTIÓN DE CLIENTES</h1>
        </div>
        <div id="msg"> <?= isset($msg) ? $msg : "" ?></div>
        <div id="content">
            <p> Datos del usuario: </p>
            <form method="GET">
                <table>
                    <td>ID </td>
                        <td>
                            <input type="text" name="id" value="<?= $cliente->id ?>" size="10" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>Nombre </td>
                        <td>
                            <input type="text" name="nombre" value="<?= $cliente->first_name ?>" size="20" autofocus>
                        </td>
                    </tr>
                    <tr>
                    <td>Apellido </td>
                        <td>
                            <input type="text" name="apellido" value="<?= $cliente->last_name ?>"  size="20">
                        </td>
                    </tr>
                    <tr>
                        <td>email </td>
                        <td>
                            <input type="text" name="email" value="<?= $cliente->email ?>"  size="50">
                        </td>
                    </tr>
                    <tr>
                        <td>Genero </td>
                        <td>
                        <select name="genero" value="<?= $cliente->gender ?>" >
                        <option value="male">Hombre</option>
                        <option value="female">Mujer</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Ip </td>
                        <td>
                            <input type="text" name="ip" value="<?= $cliente->ip_address ?>" size=20>
                        </td>
                    </tr>
                    <tr>
                        <td>Telefono</td>
                        <td>
                            <input type="text" name="telefono" value="<?= $cliente->telefono ?>" size=20>
                        </td>
                    </tr>
                </table>
                <br>
                <?php if ($orden != "Detalles") : ?>
                    <input type="submit" name="orden2" value="<?= $orden ?>">
                <?php endif ?>
                <input type="submit" name="orden2" value="Volver">
            </form>
        </div>
    </div>
</body>

</html>
<?php exit(); ?>
