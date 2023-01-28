<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./main.css">
    <title>API DWES</title>

<body>

    <?php
    // Si se ha hecho una peticion que busca informacion de un autor "get_datos_autor" a traves de su "id"...
    if (isset($_GET["action"]) && isset($_GET["id"]) && $_GET["action"] == "get_datos_autor") {
        //Se realiza la peticion a la api que nos devuelve el JSON con la información de los autores
        $autor = file_get_contents('http://angeles-fernandez-gomez-tarea-7.duckdns.org/autores/' . $_GET["id"]);
        // Se decodifica el fichero JSON y se convierte a array
        $autor = json_decode($autor);
    ?>
        <h1>Datos del Autor</h1>
        <table class="tabla_corta">
            <tr>
                <th>
                    Nombre
                </th>
                <td>
                    <p><?php echo $autor->nombre ?></p>
                </td>
            </tr>
            <tr>
                <th>
                    Apellidos
                </th>
                <td>
                    <?php echo $autor->apellidos ?>
                </td>
            </tr>
            <tr>
                <th>
                    Nacionalidad
                </th>
                <td>
                    <?php echo $autor->nacionalidad ?>
                </td>
            </tr>
        </table>

        <h1>Libros del Autor</h1>
        <table>
            <tr>
                <th>Libros del autor</th>
            </tr>
            <!-- Mostramos los libros del autor -->
            <?php foreach ($autor->libros as $libro) : ?>
                <tr>
                    <td>
                        <a href="<?php echo "http://localhost/tarea7/cliente.php?action=get_datos_libro&id=" . $libro->id  ?>">
                            <?php echo $libro->titulo ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br />
        <!-- Enlace para volver a la lista de autores -->
        <a href="http://localhost/tarea7/cliente.php?action=get_autores" alt="Lista de autores">Volver a la lista de autores</a>
        <br>
        <a href="http://localhost/tarea7/cliente.php" alt="Página principal">Volver a la página principal</a>
    <?php
    } elseif (isset($_GET["action"]) && $_GET["action"] == "get_autores") //sino muestra la lista de autores
    {
        // Pedimos al la api que nos devuelva una lista de autores. La respuesta se da en formato JSON
        $lista_autores = file_get_contents('http://angeles-fernandez-gomez-tarea-7.duckdns.org/autores');
        // Convertimos el fichero JSON en array
        //var_dump($lista_autores);
        $lista_autores = json_decode($lista_autores);
    ?>
        <table>
            <tr>
                <th>
                    Autores
                </th>
            </tr>
            <!-- Mostramos una entrada por cada autor -->
            <?php foreach ($lista_autores as $autor) : ?>
                <tr>
                    <td>
                        <!-- Enlazamos cada nombre de autor con su informacion (primer if) -->
                        <a href="<?php echo "http://localhost/tarea7/cliente.php?action=get_datos_autor&id=" . $autor->id  ?>">
                            <?php echo $autor->nombre . " " . $autor->apellidos ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br />
        <!-- Enlace para volver a la lista de autores -->
        <br>
        <a href="http://localhost/tarea7/cliente.php" alt="Página principal">Volver a la página principal</a>
    <?php
    } elseif (isset($_GET["action"]) && $_GET["action"] == "get_libros") //sino muestra la lista de autores
    {
        // Pedimos al la api que nos devuelva una lista de autores. La respuesta se da en formato JSON
        $lista_libros = file_get_contents('http://angeles-fernandez-gomez-tarea-7.duckdns.org/libros');
        // Convertimos el fichero JSON en array
        //var_dump($lista_autores);
        $lista_libros = json_decode($lista_libros);
    ?>
        <table>
            <tr>
                <th>Libros</th>
            </tr>
            <!-- Mostramos una entrada por cada autor -->
            <?php foreach ($lista_libros as $libro) : ?>
                <tr>
                    <td>
                        <!-- Enlazamos cada nombre de autor con su informacion (primer if) -->
                        <a href="<?php echo "http://localhost/tarea7/cliente.php?action=get_datos_libro&id=" . $libro->id  ?>">
                            <?php echo $libro->titulo . " " . $libro->f_publicacion ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br />
        <!-- Enlace para volver a la lista de autores -->
        <br>
        <a href="http://localhost/tarea7/cliente.php" alt="Página principal">Volver a la página principal</a>
    <?php
    } elseif (isset($_GET["action"]) && isset($_GET["id"]) && $_GET["action"] == "get_datos_libro") //sino muestra la lista de autores
    {
        // Pedimos al la api que nos devuelva una lista de autores. La respuesta se da en formato JSON
        $libro = file_get_contents('http://angeles-fernandez-gomez-tarea-7.duckdns.org/libros/' . $_GET["id"]);
        // Convertimos el fichero JSON en array
        //var_dump($lista_autores);
        $libro = json_decode($libro);
    ?>
        <h1>Datos Libro</h1>
        <table class="tabla_corta">
            <tr>
                <th>Titulo</th>
                <td> <?php echo $libro->titulo ?></td>
            </tr>
            <tr>
                <th>Fecha de Publicación</th>
                <td> <?php echo $libro->f_publicacion ?></td>
            </tr>
            <tr>
                <th>Autor</th>
                <td>
                    <a href="<?php echo "http://localhost/tarea7/cliente.php?action=get_datos_autor&id=" . $libro->autor->id  ?>">
                        <?php echo $libro->autor->nombre ?>
                    </a>
                </td>
            </tr>
        </table>
        <br />
        <!-- Enlace para volver a la lista de autores -->
        <a href="http://localhost/tarea7/cliente.php?action=get_libros" alt="Lista de libros">Volver a la lista de libros</a>
        <br>
        <a href="http://localhost/tarea7/cliente.php" alt="Página principal">Volver a la página principal</a>
    <?php
    } else {
    ?>
        <ul>
            <li><a href="<?php echo "http://localhost/tarea7/cliente.php?action=get_autores" ?>">Ver Autores</a></li>
            <li><a href="<?php echo "http://localhost/tarea7/cliente.php?action=get_libros" ?>">Ver Libros</a></li>
        </ul>
    <?php
    } ?>
</body>

</html>