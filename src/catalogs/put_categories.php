<?php
$queryUpdate = "UPDATE wp_catalogs_es c
INNER JOIN (
    SELECT DISTINCT c.id, p.product_category_es
    FROM wp_catalogs_es c
    INNER JOIN (
        SELECT DISTINCT c.id
        FROM wp_catalogs_es c
        JOIN wp_k_products p ON INSTR(c.catalog_name_es, p.product_model) > 0
        LIMIT 589
    ) AS selected_catalogs ON c.id = selected_catalogs.id
    INNER JOIN wp_k_products p ON INSTR(c.catalog_name_es, p.product_model) > 0
) AS updated_data ON c.id = updated_data.id
SET c.catalog_category_es = updated_data.product_category_es";



$resultUpdate = $conexion->query($queryUpdate);

if ($resultUpdate === TRUE) {
echo "Updated";
} else {
echo "Error" . $conexion->error;
}
?>
