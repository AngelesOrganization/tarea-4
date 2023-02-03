    <?php
    session_start();
    if (!isset($_SESSION['tlf']) || !isset($_SESSION['email'])) {
        header('Location: http://angeles-fernandez-gomez.duckdns.org/tarea4/login.php');
        exit;
    }

    if (isset($_POST['grabar'])) {
        if (isset($_POST['telefono']) && isset($_POST['email'])) {
            $_SESSION['tlf'] = $_POST['telefono'];
            $_SESSION['email'] = $_POST['email'];
            header("Location: http://angeles-fernandez-gomez.duckdns.org/tarea4/sesion.php");
            exit;
        }
    } elseif (isset($_POST['borrar'])) {
        $_SESSION['tlf'] = "";
        $_SESSION['email'] = "";    
        setcookie('horario', '', time() - 3600);
        header("Location: http://angeles-fernandez-gomez.duckdns.org/tarea4/sesion.php");
        exit;
    } elseif (isset($_POST['grabar_horario'])) {
        if (isset($_POST['horario'])) {
            setcookie('horario', $_POST['horario'], time() + 3600);
            header("Location: http://angeles-fernandez-gomez.duckdns.org/tarea4/sesion.php");
            exit;
        }
    } elseif (isset($_POST['borrar_horario'])) {
    
    }
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Formulario sesion</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

    <form method="POST" action="" name="sesion">

        <h1>Acceso concedido</h1>
        <hr>
        <p><b> Introduzca telefono y email </b></p>
        <br>
        <?php echo phpinfo()?>

        <div class="telefono">
            <label>Teléfono:
                <input type="text" id="telefono" name="telefono" value="<?php if (isset($_SESSION['tlf'])) {
                                                                            echo $_SESSION['tlf'];
                                                                        } ?>" required />
            </label>
        </div>
        <br>
        <div class="email">
            <label>Email:
                <input type="text" id="email" name="email" value="<?php if (isset($_SESSION['email'])) {
                                                                        echo $_SESSION['email'];
                                                                    } ?>" required />
            </label>
        </div>
        <br>
        <br>
        <button type="submit" name="grabar" value="Grabar">Grabar</button>
        <button type="submit" name="borrar" value="Borrar">Borrar</button>
        <br><br><br>
    </form>

    <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" name="horario_form">
        <select name="horario">
            <option value="mañana" <?php if (isset($_COOKIE['horario']) && $_COOKIE['horario'] == 'mañana') {
                                        echo 'selected';
                                    } ?>>Mañana</option>
            <option value="tarde" <?php if (isset($_COOKIE['horario']) && $_COOKIE['horario'] == 'tarde') {
                                        echo 'selected';
                                    } ?>>Tarde</option>
            <option value="noche" <?php if (isset($_COOKIE['horario']) && $_COOKIE['horario'] == 'noche') {
                                        echo 'selected';
                                    } ?>>Noche</option>
        </select>

        <br><br>
        <button type="submit" name="grabar_horario" value="Grabar Horario">Grabar Horario</button>
        <br><br><br>
    </form>
</body>
</html>