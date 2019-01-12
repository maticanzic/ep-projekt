<!DOCTYPE html>
<link rel ="stylesheet" type="text/css" href="<?= CSS_URL . "bootstrap.min.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Potrditev naročila</title>

<h1>Potrditev naročila</h1>

<p>[
    <a href="<?= BASE_URL . "orders" ?>">Vsa naročila</a>
    ]</p>

<?php
    $uporabnik = UsersController::getUserDetails($_SESSION["id"]);
    $posta = PostController::get($uporabnik["zipcode_id"]);
?>


<h4>Podatki o stranki</h4>
<ul>
    <li>Ime in priimek: <b><?= $uporabnik["name"] ?> <?= $uporabnik["lastName"] ?></b></li>
    <li>Naslov: <b><?= $uporabnik["address"] ?></b></li>
    <li>Pošta: <b><?= $posta["zipcode"] ?></b></li>
    <li>Telefon: <b><?= $uporabnik["phone"]?> </b></li>
</ul>

<br>
<h4>Podatki o naročilu</h4>
<ul>
    <li>Artikli:</li>
    <ul>
        <?php
        $total = 0;
        if(isset($_SESSION["cart"])) $kosara = $_SESSION["cart"];
        foreach ($kosara as $id => $kolicina):
            $article = ArticlesController::getArticleDetails($id); 
            $total += $kolicina * $article["price"]; ?>
        <li><?= $kolicina ?> &times; <?= $article["title"] ?>, <b><?= $article["price"] ?> €</b></li>
        <?php endforeach;    ?>
        <p>Skupaj: <b><?= number_format($total, 2) ?> €</p>
    </ul>   
</ul>
<br>
<form action="<?= BASE_URL . "orders/submit" ?>" method="POST">
      <input type="submit" value="Oddaj naročilo">
</form>

