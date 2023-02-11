<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Formulario login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <?php

    if(isset($_SESSION['offset'])){
        $currentOffset = $_SESSION['offset'];
    } else {
        $currentOffset = 0;
    }

    function getPokemons($currentOffset)
    {
        $url = "https://pokeapi.co/api/v2/pokemon?limit=20&offset=$currentOffset";
        $respuesta = json_decode(file_get_contents($url), true);
        $tbody = "<tbody>";
        $self = htmlentities($_SERVER['PHP_SELF']);

        foreach ($respuesta['results'] as $pokemon) {
            $tbody .= "<tr>";
            $tbody .= "<td>$pokemon[name]</td>";
            $tbody .= "<td><form method='GET' action='$self' name='detalle'> <button type='submit' name='detalle' value='$pokemon[url]'>Detalle</button> </form></td>";
            $tbody .= "</tr>";
        }

        $tbody .= "</tbody>";

        return $tbody;
    }

    function getPokemonDetail($url)
    {
        $respuesta = json_decode(file_get_contents($url), true);
        $name = $respuesta['name'];
        $hp = $respuesta['stats'][0]['base_stat'];
        $attack = $respuesta['stats'][1]['base_stat'];
        $defense = $respuesta['stats'][2]['base_stat'];
        $spattack = $respuesta['stats'][3]['base_stat'];
        $spdefense = $respuesta['stats'][4]['base_stat'];
        $speed = $respuesta['stats'][5]['base_stat'];
        $pkimage = $respuesta['sprites']['front_default'];

        $detail = "<table id='detail'>";
        $detail .= "<tr><th>Name</th><td>$name</td></tr>";
        $detail .= "<tr><th>Image</th><td><img id='pkimage' src='$pkimage' alt='' width='200px' height='200px'></td></tr>";
        $detail .= "<tr><th>HP</th><td>$hp</td></tr>";
        $detail .= "<tr><th>Attack</th><td>$attack</td></tr>";
        $detail .= "<tr><th>Defense</th><td>$defense</td></tr>";
        $detail .= "<tr><th>SP-Attack</th><td>$spattack</td></tr>";
        $detail .= "<tr><th>SP-Defense</th><td>$spdefense</td></tr>";
        $detail .= "<tr><th>Speed</th><td>$speed</td></tr>";
        $detail .= "</table>";

        return $detail;
    }

    ?>

    <body>
        <div id="lista">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="submit" name="next" value="Next">
                <?php
                if (isset($_POST['next'])) {
                    if(isset($_SESSION['offset'])) {
                        $_SESSION['offset'] = intval($_SESSION['offset']) + 20;
                    } else {
                        $_SESSION['offset'] = 20;
                    }
                }
                ?>
            </form>
            <table id="pokemons">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <?php
                global $currentOffset;
                $tag = getPokemons($currentOffset);
                echo $tag;
                ?>
            </table>
        </div>
        <div id="detalle">
            <div>
                <?php
                if (isset($_GET['detalle'])) {
                    echo getPokemonDetail($_GET['detalle']);
                }
                ?>
            </div>
        </div>
    </body>

</html>