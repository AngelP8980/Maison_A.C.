<?php

// On récupère le nom de la categorie en fonction de l'id passée dans l'url
$category = Category::find($id);
echo "Catégories : " . $category->name;

var_dump(Category::all());

foreach (Category::all() as $cat) {
    if ($cat['id'] == $_GET["id"]) {
        echo "<p>" . $cat['name'];
    } else {
    }
}
?>

// Affichage : inclusion du template
$template = 'category';
include '../templates/base.phtml';