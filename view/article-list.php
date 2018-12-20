<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Library</title>

<h1>All articles</h1>

<p>[
<a href="<?= BASE_URL . "articles" ?>">All articles</a> |
<a href="<?= BASE_URL . "articles/add" ?>">Add new</a>
]</p>

<ul>

    <?php foreach ($articles as $article): ?>
        <li><a href="<?= BASE_URL . "articles/" . $article["id"] ?>"><?= $article["author"] ?>: 
        	<?= $article["title"] ?> (<?= $article["year"] ?>)</a></li>
    <?php endforeach; ?>

</ul>
