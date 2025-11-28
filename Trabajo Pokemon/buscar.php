<?php
$regions = json_decode(file_get_contents("https://pokeapi.co/api/v2/region/"), true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="examen.css">
</head>

<body>

<header>Pokédex</header>

<nav>
    <strong>
        <?php  
        $nombreBonito = [
            "kanto" => "G1 Kanto",
            "johto" => "G2 Johto",
            "hoenn" => "G3 Hoenn",
            "sinnoh" => "G4 Sinnoh",
            "unova" => "G5 Unova",
            "kalos" => "G6 Kalos",
            "alola" => "G7 Alola",
            "galar" => "G8 Galar",
            "paldea" => "G9 Paldea"
        ];

        foreach ($regions["results"] as $region) {
            $name = $region["name"];

            if (!isset($nombreBonito[$name])) continue;

            echo '<a href="region.php?region='.$name.'" style="color:orange; text-decoration:none;">'
                . $nombreBonito[$name] .
                '</a>&nbsp;&nbsp;';
        }

        echo '<a href="buscar.php" style="color:orange; text-decoration:none;">Búsqueda</a>';
        ?>
    </strong>
</nav>

<h2 style="text-align:center;">Buscar Pokémon</h2>


<form method="GET" style="text-align:center; margin-bottom:20px;">

    
    <input type="text" name="name" placeholder="Name">

   
    <select name="type">
        <option value="">Tipo</option>
        <?php
        $types = json_decode(file_get_contents("https://pokeapi.co/api/v2/type/"), true);
        foreach ($types['results'] as $t) {
            echo "<option value='{$t['name']}'>" . ucfirst($t['name']) . "</option>";
        }
        ?>
    </select>

   
    <select name="region">
        <option value="">Region</option>
        <?php
        $regions = json_decode(file_get_contents("https://pokeapi.co/api/v2/region/"), true);
        foreach ($regions['results'] as $reg) {
            echo "<option value='{$reg['name']}'>" . ucfirst($reg['name']) . "</option>";
        }
        ?>
    </select>

    <button type="submit">Buscar</button>
</form>

<hr>

<?php

if (!empty($_GET)) {

    echo "<h3 style='text-align:center;'>Results:</h3>";

  
    if (!empty($_GET['name'])) {
        $name = strtolower($_GET['name']);
        echo "<p style='text-align:center;'><a href='pokemon.php?name=$name'>" . ucfirst($name) . "</a></p>";
    }

   
    if (!empty($_GET['region'])) {
        $region = $_GET['region'];
        $info = json_decode(file_get_contents("https://pokeapi.co/api/v2/region/$region"), true);

        $pokedex = json_decode(file_get_contents($info['pokedexes'][0]['url']), true);

        echo "<h4 style='text-align:center;'>Pokémon in region " . ucfirst($region) . ":</h4>";

        foreach ($pokedex['pokemon_entries'] as $entry) {
            $name = $entry['pokemon_species']['name'];
            echo "<p style='text-align:center;'><a href='pokemon.php?name=$name'>" . ucfirst($name) . "</a></p>";
        }
    }


    if (!empty($_GET['type'])) {
        $type = $_GET['type'];
        $data = json_decode(file_get_contents("https://pokeapi.co/api/v2/type/$type"), true);

        echo "<h4 style='text-align:center;'>Pokémon of type " . ucfirst($type) . ":</h4>";

        foreach ($data['pokemon'] as $pk) {
            $name = $pk['pokemon']['name'];
            echo "<p style='text-align:center;'><a href='pokemon.php?name=$name'>" . ucfirst($name) . "</a></p>";
        }
    }
}
?>

</body>
</html>
