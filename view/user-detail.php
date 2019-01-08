<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Podrobnosti uporabnika</title>

<h1>Podrobnosti o uporabniku: <?= $name ?> <?= $lastName ?></h1>

<p>[
    <a href="<?= BASE_URL . "users/add" ?>">Dodaj novega uporabnika</a> |
    <a href="<?= BASE_URL . "users" ?>">Vsi uporabniki</a>
    ]</p>

<ul>
    <li>Ime in priimek: <b><?= $name ?> <?= $lastName ?></b></li>
    <li>E-naslov: <b><?= $email ?></b></li>
    <li>Tip uporabnika: <b><?= $type ?></b></li>
    <li>Naslov: <b><?= $address ?></b></li>
    <li>Telefon: <b><?= $phone ?></b></li>
    <li>Aktiviran: <b><?= $activated ? "DA" : "NE" ?></b></li>
</ul>

<p>[ <a href="<?= BASE_URL . "users/edit/" . $id ?>">Urejanje uporabnika</a> |
    <a href="<?= BASE_URL . "users" ?>">Nazaj na seznam uporabnikov</a> ]</p>