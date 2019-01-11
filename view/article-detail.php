<!DOCTYPE html>
<link rel ="stylesheet" type="text/css" href="<?= CSS_URL . "bootstrap.min.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Podrobnosti artikla</title>

<h1>Podrobnosti o artiklu: <?= $title ?></h1>

<p>[
    <a href="<?= BASE_URL . "articles" ?>">Vsi artikli</a>
    ]</p>

<ul>
    <li>Naziv: <b><?= $title ?></b></li>
    <li>Cena: <b><?= $price ?> EUR</b></li>
    <li>Aktiviran: <b><?= $activated ? "DA" : "NE" ?></b></li>
    <li>Opis: <i><?= $description ?></i></li>
</ul>

<p>[ <a href="<?= BASE_URL . "articles/edit/" . $id ?>">Urejanje artikla</a> ] </p>
