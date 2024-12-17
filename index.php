<?php
require 'functions.php';

$userLang = isset($_GET['lang']) && in_array($_GET['lang'], ['rus', 'eng', 'ger']) ? $_GET['lang'] : 'rus';

$data = getHierarchy($pdo, $userLang);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles.css">
    <script src="assets/script.js" defer></script>
    <title>Список городов Европы</title>
</head>
<body>
    <h1>Список городов Европы</h1>
    <ul>
        <?php
            $currentCountry = '';
            $currentRegion = '';
            foreach ($data as $row) {
                if ($currentCountry !== $row['country_name']) {
                    $currentCountry = $row['country_name'];
                    echo "<li class='country' data-desc='{$row['country_descr']}'>{$currentCountry}</li>";
                }

                if ($row['region_name'] && $currentRegion !== $row['region_name']) {
                    $currentRegion = $row['region_name'];
                    echo "<ul><li class='region' data-desc='{$row['region_descr']}'>{$currentRegion}</li></ul>";
                }

                if ($row['region_name']) {
                    echo "<ul><li class='city' data-desc='{$row['city_descr']}'>{$row['city_name']}</li></ul>";
                } else {
                    echo "<li class='city' data-desc='{$row['city_descr']}'>{$row['city_name']}</li>";
                }
            }
        ?>
    </ul>
</body>
</html>
