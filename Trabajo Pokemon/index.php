<?php
$regions = json_decode(file_get_contents("https://pokeapi.co/api/v2/region/"), true);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pokemon</title>
	<link rel="stylesheet" type="text/css" href="examen.css">
</head>
<body>
 
<header> Mi blog de &nbsp;&nbsp; <img src="img/International_Pokémon_logo.svg.png"></header>

<div></div>

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

<div id="iniciales">

</div>

<div class="abajo"></div>

<footer> Trabajo &nbsp;<strong> Desarrollo Web en Entorno Servidor </strong>&nbsp; 2025/2026 IES Serra Perenxisa.</footer>

</body>
</html>
