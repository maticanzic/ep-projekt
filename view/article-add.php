<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Add entry</title>

<h1>Add new article</h1>

<p>[
<a href="<?= BASE_URL . "articles" ?>">All articles</a> |
<a href="<?= BASE_URL . "articles/add" ?>">Add new</a>
]</p>

<form action="<?= BASE_URL . "articles/add" ?>" method="post">
    <p><label>Author: <input type="text" name="author" value="<?= $author ?>" autofocus /></label></p>
    <p><label>Title: <input type="text" name="title" value="<?= $title ?>" /></label></p>
    <p><label>Price: <input type="number" name="price" value="<?= $price ?>" /></label></p>
    <p><label>Year: <input type="number" name="year" value="<?= $year ?>" /></label></p>
    <p><label>Description: <br/><textarea name="description" cols="70" rows="10"><?= $description ?></textarea></label></p>
    <p><button>Insert</button></p>
</form>
