<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API DWES</title>
</head>

<body>

    <?php
    // Si se ha hecho una peticion que busca informacion de un autor "get_datos_autor" a traves de su "id"...
    if (isset($_GET["action"]) && isset($_GET["id"]) && $_GET["action"] == "get_datos_autor") {
        //Se realiza la peticion a la api que nos devuelve el JSON con la información de los autores
        $app_info = file_get_contents('http://localhost/dwes/rest/api.php?action=get_datos_autor&id=' . $_GET["id"]);
        // Se decodifica el fichero JSON y se convierte a array
        $app_info = json_decode($app_info);
    ?>
        <p>
            <td>Nombre: </td>
            <td> <?php echo $app_info->datos->nombre ?></td>
        </p>
        <p>
            <td>Apellidos: </td>
            <td> <?php echo $app_info->datos->apellidos ?></td>
        </p>
        <p>
            <td>Fecha de nacimiento: </td>
            <td> <?php echo $app_info->datos->nacionalidad ?></td>
        </p>
        <ul>
            <!-- Mostramos los libros del autor -->
            <?php foreach ($app_info->libros as $libro) : ?>
                <li>
                    <?php echo $libro->titulo; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <br />
        <!-- Enlace para volver a la lista de autores -->
        <a href="http://localhost/dwes/rest/cliente.php?action=get_listado_autores" alt="Lista de autores">Volver a la lista de autores</a>
    <?php
    } else //sino muestra la lista de autores
    {
        // Pedimos al la api que nos devuelva una lista de autores. La respuesta se da en formato JSON
        $lista_autores = file_get_contents('http://localhost/dwes/rest/api.php?action=get_listado_autores');
        // Convertimos el fichero JSON en array
        //var_dump($lista_autores);
        $lista_autores = json_decode($lista_autores);
    ?>
        <ul>
            <!-- Mostramos una entrada por cada autor -->
            <?php foreach ($lista_autores as $autores) : ?>
                <li>
                    <!-- Enlazamos cada nombre de autor con su informacion (primer if) -->
                    <a href="<?php echo "http://localhost/dwes/rest/cliente.php?action=get_datos_autor&id=" . $autores->id  ?>">
                        <?php echo $autores->nombre . " " . $autores->apellidos ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php
    } ?>
</body>

</html>