<!DOCTYPE html>
<link rel ="stylesheet" type="text/css" href="<?= CSS_URL . "bootstrap.min.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Podrobnosti naročila</title>

<h1>Podrobnosti o naročilu ID <?= $id ?></h1>

<p>[
    <a href="<?= BASE_URL . "orders" ?>">Vsa naročila</a>
    ]</p>

<?php
    $uporabnik = UsersController::getUserDetails($id_user);
    if ($id_seller != 0) {
        $prodajalec = UsersController::getUserDetails($id_seller);
    }
    $posta = PostController::get($uporabnik["zipcode_id"]);
    $order_articles = OrderArticlesController::getOrderArticlesById($id);
    print_r($order_articles);
    print_r($uporabnik);
?>


<h4>Podatki o stranki</h4>
<ul>
    <li>Ime in priimek: <b><?= $uporabnik["name"] ?> <?= $uporabnik["lastName"] ?></b></li>
    <li>Naslov: <b><?= $uporabnik["address"] ?></b></li>
    <li>Pošta: <b><?= $posta["zipcode"] ?></b></li>
    <li>Telefon: <b><?= $uporabnik["phone"]?> </b></li>
</ul>

<?php if(isset($prodajalec)) { ?>
<h4>Podatki o prodajalcu</h4>
<ul>
    <li>Ime in priimek prodajalca: <b><?= $prodajalec["name"] ?> <?= $prodajalec["lastName"] ?></li>
</ul>
<?php } ?>

<br>
<h4>Podatki o naročilu</h4>
<ul>
    <li>Artikli:</li>
    <ul>
        <?php foreach ($order_articles as $order_article): 
            $article = ArticlesController::get($order_article["article_id"]); ?>
        <li><?= $order_article["amount"] ?> &times; <?= $article["title"] ?>, <?= $article["price"] ?> € ?></li>
        <?php endforeach;    ?>
    </ul>   
    <li>Status naročila: <b>
            <?php if ($status == 0) { ?> POTRJENO 
                <?php } else if ($status == 1) { ?> ODDANO 
                <?php } else if ($status == 2) { ?> STORNIRANO 
                        <?php } ?></b></li>
</ul>

<?php if(isset($_SESSION["loggedin"]) && $_SESSION["type"] == 1) { ?>
<p>[ <a href="<?= BASE_URL . "orders/edit/" . $id ?>">Urejanje naročila</a> ] </p>
<?php } ?>
