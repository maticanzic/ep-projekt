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
    $uporabnik = UsersController::getUserDetails(array("id" => $id_user));
    if ($id_seller != 0) {
        $prodajalec = UsersController::getUserDetails(array("id" => $id_seller));
    }
?>


<h4>Podatki o stranki</h4>
<ul>
    <li>Ime in priimek: <b><?= $uporabnik["name"] ?> <?= $uporabnik["lastName"] ?></b></li>
    <li>Naslov: <b><?= $uporabnik["address"] ?></b></li>
    <li>Pošta: <b><?= $posta[""]</b></li>
</ul>

<br>
<h4>Podatki o naročilu</h4>
<ul>    
    <li>Status naročila: <b>
            <?php if ($status == 0) { ?> POTRJENO 
                <?php } else if ($status == 1) { ?> ODDANO 
                <?php } else if ($status == 2) { ?> STORNIRANO 
                        <?php } ?></b></li>
</ul>

<?php if(isset($_SESSION["loggedin"]) && $_SESSION["type"] == 1) { ?>
<p>[ <a href="<?= BASE_URL . "orders/edit/" . $id ?>">Urejanje naročila</a> ] </p>
<?php } ?>
