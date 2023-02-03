<?php
    session_start();
    if (isset($_POST['user']) && isset($_POST['pass'])) {
        if ($_POST['user'] == "foc" && $_POST['pass'] == "Fdwes!22") {
            $_SESSION['tlf'] = "";
            $_SESSION['email'] = "";
            echo "<script> location.href='http://angeles-fernandez-gomez.duckdns.org/tarea4/sesion.php'; </script>";
            exit;
        } else {
            echo "Credenciales incorrectas";
        }
    }
    ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Formulario login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="cuadro">

    <h1>Acceso a la pagina</h1>
    <hr>
    <p><b> Introduzca usuario y contraseña </b></p>
    <br>

    <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="login">

        <div class="usuario">
            <label>Usuario:
                <input type="text" name="user" pattern="[a-zA-Z0-9]+" required />
            </label>
        </div>
        <br>
        <div class="contraseña">
            <label>Contraseña:
                <input type="password" name="pass" required />
            </label>
        </div>
        <button type="submit" name="login" value="login">Log In</button>
    </form>

</body>
</html>