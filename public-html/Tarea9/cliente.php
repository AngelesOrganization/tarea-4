<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="main.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./main.css">
    <title>API DWES</title>
    <script>
        let limit = 10;
        let currentOffset = 0;

        function getPokemons() {
            let asyncRequest = new XMLHttpRequest();
            asyncRequest.onreadystatechange = stateChange;
            asyncRequest.open("GET", `https://pokeapi.co/api/v2/pokemon?limit=${limit}&offset=${currentOffset}`, true);
            asyncRequest.send();

            function stateChange() {
                if (asyncRequest.readyState == 4 && asyncRequest.status == 200) {
                    let respuesta = JSON.parse(asyncRequest.responseText);
                    let tbody = document.getElementById("pokemons").getElementsByTagName('tbody')[0];

                    tbody.innerHTML = "";

                    respuesta.results.forEach(function(pokemon) {
                        let newRow = tbody.insertRow();

                        let cellName = newRow.insertCell();
                        let cellUrl = newRow.insertCell();

                        cellName.innerHTML = pokemon.name;
                        cellUrl.innerHTML = `<button onclick="getPokemonDetail('${pokemon.url}');">Detalle</button>`;
                    });
                }
            }
        }

        function getPokemonDetail(url) {
            let asyncRequest = new XMLHttpRequest();
            asyncRequest.onreadystatechange = stateChange;
            asyncRequest.open("GET", url, true);
            asyncRequest.send();

            function stateChange() {
                if (asyncRequest.readyState == 4 && asyncRequest.status == 200) {
                    let respuesta = JSON.parse(asyncRequest.responseText);
                    document.getElementById("name").innerHTML = respuesta.name;
                    document.getElementById("hp").innerHTML = respuesta.stats[0].base_stat;
                    document.getElementById("attack").innerHTML = respuesta.stats[1].base_stat;
                    document.getElementById("defense").innerHTML = respuesta.stats[2].base_stat;
                    document.getElementById("spattack").innerHTML = respuesta.stats[3].base_stat;
                    document.getElementById("spdefense").innerHTML = respuesta.stats[4].base_stat;
                    document.getElementById("speed").innerHTML = respuesta.stats[5].base_stat;
                    document.getElementById("pkimage").setAttribute("src", respuesta.sprites.front_default);
                    document.getElementById("detalle").removeAttribute("hidden");
                }
            }
        }

        function previous() {
            currentOffset = currentOffset - limit;
            getPokemons();
        }

        function next() {
            currentOffset = currentOffset + limit;
            getPokemons();
        }

        function newLimit(value) {
            limit = parseInt(value);
            getPokemons();
        }
    </script>

<body onload="getPokemons();">
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
            <tbody></tbody>
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