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
    <input id="clickMe" type="button" value="previous" onclick="previous();" />
    <input id="clickMe" type="button" value="next" onclick="next();" />
    <label for='number-dd'><b>Limit</b></label>
    <select onchange="newLimit(this.value)" id='number-dd' name='number'>
        <option value=10>10</option>
        <option value=20>20</option>
        <option value=30>30</option>
    </select>
    <table id="pokemons">
        <tr>
            <th>Nombre</th>
            <th>Detalle</th>
            <tbody>

            </tbody>
        </tr>
    </table>
    <div>
        <div id="pkmnImg">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/11.png" alt="" width="200px" height="200px">
        </div>
        <div>
            <p>Metapod</p>
            <table>
                <tr>
                    <td>HP</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>Attack</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>Defense</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>SP-Attack</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>SP-Deffense</td>
                    <td>100</td>
                </tr>
                <tr>
                    <td>Speed</td>
                    <td>100</td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>