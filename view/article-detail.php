<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Article detail</title>

<h1>Details of: <?= $title ?></h1>

<p>[
    <a href="<?= BASE_URL . "articles" ?>">All articles</a> |
    <a href="<?= BASE_URL . "articles/add" ?>">Add new</a>
    ]</p>

<ul>
    <li>Author: <b><?= $author ?></b></li>
    <li>Title: <b><?= $title ?></b></li>
    <li>Price: <b><?= $price ?> EUR</b></li>
    <li>Year: <b><?= $year ?></b></li>
    <li>Description: <i><?= $description ?></i></li>
</ul>

<p>[ <a href="<?= BASE_URL . "articles/edit/" . $id ?>">Edit</a> |
    <a href="<?= BASE_URL . "articles" ?>">Article index</a> ]</p>
