<!DOCTYPE html>
<link rel ="stylesheet" type="text/css" href="<?= CSS_URL . "bootstrap.min.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />

<?php if(isset($_SESSION["loggedin"]) && $_SESSION["type"] == 0) { ?>
<?php } else if(isset($_SESSION["loggedin"]) && $_SESSION["type"] == 1) { ?>
    <title>Seznam naročil</title>
<?php } else if(isset($_SESSION["loggedin"]) && $_SESSION["type"] == 2) { ?>
    <title>Moja naročila</title>
<?php } ?>

<p>[
<?php if(isset($_SESSION["loggedin"]) && $_SESSION["type"] == 1) { ?>
<?php } else if (isset($_SESSION["loggedin"]) && $_SESSION["type"] == 2) { ?>
    <a href="<?= BASE_URL . "articles" ?>">Seznam artiklov</a> 
<?php } ?>
]</p>

<ul>
    <?php if(isset($_SESSION["loggedin"])) {
        if ($_SESSION["type"] == 0) { ?>
    <?php } else if ($_SESSION["type"] == 1) { ?>
        <h2>Oddana naročila:</h2>
    <?php foreach ($orders as $order):
            if (order["status"] == 1) { ?>
                <li><a href="<?= BASE_URL . "orders/" . $order["id"] ?>"> 
                    Naročilo št. <?= $order["id"] ?>
                </a></li>
            <?php } endforeach; ?>
        <h2>Potrjena naročila:</h2>
            <?php foreach ($orders as $order):
            if (order["status"] == 0) { ?>
                <li><a href="<?= BASE_URL . "orders/" . $order["id"] ?>"> 
                    Naročilo št. <?= $order["id"] ?>
                </a></li>
            <?php } endforeach; ?>
        <h2>Stornirana naročila:</h2>
            <?php foreach ($orders as $order):
            if (order["status"] == 2) { ?>
                <li><a href="<?= BASE_URL . "orders/" . $order["id"] ?>"> 
                    Naročilo št. <?= $order["id"] ?>
                </a></li>
            <?php } endforeach; ?>
        <?php } else if ($_SESSION["type"] == 2) {
            foreach ($orders as $order):
                if (order["id_user"] == $_SESSION["id"]) { ?>
                    <li><a href="<?= BASE_URL . "orders/" . $order["id"] ?>"> 
                    Naročilo št. <?= $order["id"] ?> | Status naročila: 
                    <?php if ($order["status"] == 0) { ?> POTRJENO
                    <?php } else if ($order["status"] == 1) { ?> ODDANO
                    <?php } else if ($order["status"] == 2) { ?> STORNIRANO
                    <?php } ?>
                        </a></li>
            <?php } endforeach; ?>                     
        <?php } ?>
    <?php } ?>
</ul>
