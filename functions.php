<?php
require 'db.php';

function getHierarchy($pdo, $lang) {
    $query = "SELECT 
    city.id AS city_id, 
    city.c_name_$lang AS city_name, 
    city.c_descr_$lang AS city_descr,
    country.id AS country_id,
    country.c_name_$lang AS country_name, 
    country.c_descr_$lang AS country_descr,
    region.id AS region_id,
    region.r_name_$lang AS region_name,
    region.r_descr_$lang AS region_descr
    FROM city
    LEFT JOIN region ON city.c_region_id = region.id
    LEFT JOIN country ON city.c_country_id = country.id
    WHERE country.glob_region_id = (
        SELECT id FROM glob_region WHERE gr_name_rus = 'Европа'
    )
    ORDER BY country.id, region.id, city.id;
    ";
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
