<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Dodajanje artikla</title>

<h1>Dodaj nov artikel</h1>

<p>[
<a href="<?= BASE_URL . "articles" ?>">Vsi artikli</a> |
<a href="<?= BASE_URL . "articles/add" ?>">Dodaj nov artikel</a>
]</p>

<form action="<?= BASE_URL . "articles/add" ?>" method="post">
    <p><label>Naziv: <input type="text" name="title" value="<?= $title ?>" autofocus /></label></p>
    <p><label>Cena: <input type="number" name="price" value="<?= $price ?>" /></label></p>
    <p><label>Aktiviran: <input type="checkbox" name="activated" value="<?= $activated ?>" /></label></p>
    <p><label>Opis: <br/><textarea name="description" cols="70" rows="10"><?= $description ?></textarea></label></p>
    <p><button>Dodaj artikel</button></p>
</form>
