<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Seznam artiklov</title>

<h1>Vsi artikli</h1>

<p>[
<a href="<?= BASE_URL . "articles" ?>">Vsi artikli</a> |
<a href="<?= BASE_URL . "articles/add" ?>">Dodaj nov artikel</a>
]</p>

<ul>

    <?php foreach ($articles as $article): ?>
        <li><a href="<?= BASE_URL . "articles/" . $article["id"] ?>"> 
        	<?= $article["title"] ?></a></li>
    <?php endforeach; ?>

</ul>
