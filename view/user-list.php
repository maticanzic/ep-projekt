<!DOCTYPE html>
<link rel ="stylesheet" type="text/css" href="<?= CSS_URL . "bootstrap.min.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Seznam uporabnikov</title>

<h1>Vsi uporabniki</h1>

<p>[
<a href="<?= BASE_URL . "users/add" ?>">Dodaj novega uporabnika</a> |
<a href="<?= BASE_URL . "articles" ?>">Seznam artiklov</a> 
]</p>

<ul>

    <?php foreach ($users as $user): ?>
        <li><a href="<?= BASE_URL . "users/" . $user["id"] ?>"> 
        	<?= $user["name"] ?> <?= $user["lastName"] ?></a></li>
    <?php endforeach; ?>

</ul>
