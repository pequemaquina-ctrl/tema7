<?php
$name = $_GET['name'];
$url = "https://pokeapi.co/api/v2/pokemon/$name";
$data = json_decode(file_get_contents($url), true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst($name) ?> - Pokédex</title>
    <link rel="stylesheet" href="examen.css">
    
</head>

<body>
    <header>Pokédex Explorer</header>

    <nav>
        <a href="index.php"><strong>Regions</strong></a> |
        <a href="buscar.php"><strong>Search</strong></a>
    </nav>

    <div class="pokemon-card">
        <h2><?= ucfirst($name) ?></h2>

        <div id="pokemon-image">
            <img src="<?= $data['sprites']['front_default'] ?>" alt="<?= $name ?>">
        </div>

        <table>
            <tr>
                <td><strong>ID:</strong></td>
                <td><?= $data['id'] ?></td>
            </tr>
            <tr>
                <td><strong>Height:</strong></td>
                <td><?= $data['height'] ?> dm</td>
            </tr>
            <tr>
                <td><strong>Weight:</strong></td>
                <td><?= $data['weight'] ?> hg</td>
            </tr>
            <tr>
                <td><strong>Types:</strong></td>
                <td>
                    <?php foreach ($data['types'] as $t): ?>
                        <span class="type-badge"><?= ucfirst($t['type']['name']) ?></span>
                    <?php endforeach; ?>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>