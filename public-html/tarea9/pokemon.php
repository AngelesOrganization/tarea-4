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

    $limit = 10;
    $currentOffset = 0;

    function getPokemons($limit, $currentOffset) {
        $url = "https://pokeapi.co/api/v2/pokemon?limit=$limit&offset=$currentOffset";
        $respuesta = json_decode(file_get_contents($url), true);
        $tbody = "<tbody>";

        foreach ($respuesta['results'] as $pokemon) {
            $tbody .= "<tr>";
            $tbody .= "<td>$pokemon[name]</td>";
            $tbody .= "<td><button onclick='getPokemonDetail(\"$pokemon[url]\");'>Detalle</button></td>";
            $tbody .= "</tr>";
        }

        $tbody .= "</tbody>";

        return $tbody;
    }

    function getPokemonDetail($url) {
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
        <input id="clickMe" type="button" value="previous" onclick="previous();" />
        <input id="clickMe" type="button" value="next" onclick="next();" />
        <label for='number-dd'><b>Limit</b></label>
        <select onchange="newLimit(this.value)" id='number-dd' name='number'>
            <option value=10>10</option>
            <option value=20>20</option>
            <option value=30>30</option>
        </select>
        <table id="pokemons">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <?php
                global $limit, $currentOffset; 
                $tag = getPokemons($limit, $currentOffset);
                echo $tag;
            ?>
        </table>
    </div>
    <div id="detalle" hidden>
        <div>
            <table id="detail">
                <tr>
                    <th>Name</th>
                    <td id="name"></td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td><img id="pkimage" src="" alt="" width="200px" height="200px"></td>
                </tr>
                <tr>
                    <th>HP</th>
                    <td id="hp"></td>
                </tr>
                <tr>
                    <th>Attack</th>
                    <td id="attack"></td>
                </tr>
                <tr>
                    <th>Defense</th>
                    <td id="defense"></td>
                </tr>
                <tr>
                    <th>SP-Attack</th>
                    <td id="spattack"></td>
                </tr>
                <tr>
                    <th>SP-Defense</th>
                    <td id="spdefense"></td>
                </tr>
                <tr>
                    <th>Speed</th>
                    <td id="speed"></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
