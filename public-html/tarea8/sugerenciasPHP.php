<?php
// Simulamos una consulta a la base de datos donde
// se almacenarán los usuarios en un array $a[]
$a[] = "Anna";
$a[] = "Brittany";
$a[] = "Cinderella";
$a[] = "Diana";
$a[] = "Eva";
$a[] = "Fiona";
$a[] = "Gunda";
$a[] = "Hege";
$a[] = "Inga";
$a[] = "Johanna";
$a[] = "JuanaPaloma";
$a[] = "JuanPalomo";
$a[] = "Kitty";
$a[] = "Linda";
$a[] = "Nina";
$a[] = "Ophelia";
$a[] = "Petunia";
$a[] = "Amanda";
$a[] = "Raquel";
$a[] = "Cindy";
$a[] = "Doris";
$a[] = "Eve";
$a[] = "Evita";
$a[] = "Sunniva";
$a[] = "Tove";
$a[] = "Unni";
$a[] = "Violet";
$a[] = "Liza";
$a[] = "Elizabeth";
$a[] = "Ellen";
$a[] = "Wenche";
$a[] = "Vicky";

// obtenemos el parámetro GET de la URL (Ej: "sugerenciasPHP.php?q=Anna")
$q = $_REQUEST["q"];

// Variable que contendrá las coincidencias
$sugerencias = "";



//Entra en el bucle si el parámetro obtenido del GET ($q) es diferente a ""
if ($q !== "") 
{
    //Si el usuario ha insertado datos se pasan a minúscula
    $q = strtolower($q);
    //Almacenamos la longitud de la palabra
    $len=strlen($q);
    //Ahora vamos a buscar coincidencias en la "base de datos"
    foreach($a as $name) 
    {
        // Buscamos los nombres que contengan la cadena insertada al principio
        if (stristr($q, substr($name, 0, $len))) 
		//if (stristr($name, $q)) //buscar en cualquier lugar
        {
            $sugerencias .= "<br>".$name;
        }
    }
}

// Salida: "no se encuentran sugerencias" si no hay sugerencias
echo $sugerencias === "" ? "no se encuentran sugerencias" : $sugerencias;
?>
