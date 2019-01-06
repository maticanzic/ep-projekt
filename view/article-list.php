<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Seznam artiklov</title>

<h1>Spletna trgovina</h1>

<p>[
<a href="<?= BASE_URL . "articles/add" ?>">Dodaj nov artikel</a> |
<a href="<?= BASE_URL . "users" ?>">Vsi uporabniki</a>
]</p>

<ul>

    <?php foreach ($articles as $article): ?>
        <li><a href="<?= BASE_URL . "articles/" . $article["id"] ?>"> 
        	<?= $article["title"] ?></a></li>
    <?php endforeach; ?>

</ul>
