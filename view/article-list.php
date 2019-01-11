<?php 

$url = filter_input(INPUT_SERVER, "PHP_SELF", FILTER_SANITIZE_SPECIAL_CHARS);
$validationRules = ['do' => [
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => [
            "regexp" => "/^(add_into_cart|update_cart|purge_cart)$/"
        ]
    ],
    'id' => [
        'filter' => FILTER_VALIDATE_INT,
        'options' => ['min_range' => 0]
    ],
    'kolicina' => [
        'filter' => FILTER_VALIDATE_INT,
        'options' => ['min_range' => 0]
    ]
];

$data = filter_input_array(INPUT_POST, $validationRules);


switch ($data["do"]) {
    case "add_into_cart":
        try {
            $article = ArticleDB::get(array("id" => $data["id"]));

            if (isset($_SESSION["cart"][$article["id"]])) {
                $_SESSION["cart"][$article["id"]] ++;
            } else {
                $_SESSION["cart"][$article["id"]] = 1;
            }
        } catch (Exception $exc) {
            die($exc->getMessage());
        }
        break;
    case "update_cart":
        if (isset($_SESSION["cart"][$data["id"]])) {
            if ($data["kolicina"] > 0) {
                $_SESSION["cart"][$data["id"]] = $data["kolicina"];
            } else {
                unset($_SESSION["cart"][$data["id"]]);
            }
        }
        break;
    case "purge_cart":
        unset($_SESSION["cart"]);
        break;
    default:
        break;
}
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel ="stylesheet" type="text/css" href="<?= CSS_URL . "bootstrap.min.css" ?>">
        <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
        <meta charset="UTF-8" />
        <title>Seznam artiklov</title>
    <head>
    <body>
        <h1>Spletna trgovina</h1>

        <p>[       
        <?php if(!isset($_SESSION["loggedin"])) { ?>
            <a href="<?= BASE_URL . "registration" ?>">Registracija</a> |
            <a href="<?= BASE_URL . "login" ?>">Prijava</a> 
        <?php } else { 
            if($_SESSION["type"] == 1) { ?>
                <a href="<?= BASE_URL . "articles/add" ?>">Dodaj nov artikel</a> |
                <a href="<?= BASE_URL . "users" ?>">Vsi uporabniki</a> |
                <a href="<?= BASE_URL . "orders" ?>">Vsa naročila</a> |
            <?php } else if ($_SESSION["type"] == 0) { ?>
                <a href="<?= BASE_URL . "users" ?>">Vsi uporabniki</a> | 
        <?php } else if ($_SESSION["type"] == 2 ){ ?>
                <a href="<?= BASE_URL . "orders" ?>">Vsa naročila</a> |
        <?php } ?>
            <a href="<?= BASE_URL . "profile/" . $_SESSION["id"] ?>">Uredi profil</a> | 
            <a href="<?= BASE_URL . "logout" ?>">Odjava</a>
        <?php } ?>   
        ]</p>
        
        <div id ="main">
            <?php
            foreach ($articles as $article): ?>
                <div class="article">
                    <form action="<?= BASE_URL . "articles" ?>" method="post">
                        <input type="hidden" name="do" value="add_into_cart" />
                        <input type="hidden" name="id" value="<?= $article["id"] ?>" />
                        <p><?= $article["title"] ?></p>
                        <b><p><?= number_format($article["price"], 2) ?> €<br/></b>
                        <a href="<?= BASE_URL . "articles/" . $article["id"] ?>" class="btn btn-info details">Podrobnosti</a>
                        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["type"] == 2) { ?>
                            <button type="submit" class="btn btn-info add-to-cart">V košarico</button>
                        <?php } ?>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["type"] == 2) { ?>
            <div class="cart">
                <h3>Košarica</h3>

                <?php
                $kosara = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

                if ($kosara) {
                    $znesek = 0;
                    foreach ($kosara as $id => $kolicina):
                        $article = ArticleDB::get(array("id" => $id));
                        $znesek += $article["price"] * $kolicina;
                        ?>
                        <form action="<?= BASE_URL . "articles" ?>" method="post">
                            <input type="hidden" name="do" value="update_cart" />
                            <input type="hidden" name="id" value="<?= $article["id"] ?>" />
                            <input type="number" name="kolicina" value="<?= $kolicina ?>"
                                   class="short_input" />
                            &times; <?=
                            (strlen($article["title"]) < 50) ?
                                    $article["title"] :
                                    substr($article["title"], 0, 26) . " ..."
                            ?> (<?= number_format($article["price"], 2) ?> €)
                            <button class="update-cart" type="submit">Posodobi</button> 
                        </form>
                    <?php endforeach; ?>

                    <p>Skupaj: <b><?= number_format($znesek, 2) ?> EUR</b></p>

                    <form action="<?= BASE_URL . "articles" ?>" method="POST">
                        <input type="hidden" name="do" value="purge_cart" />
                        <input type="submit" value="Izprazni košarico" />
                    </form>

                    <!-- TO-DO: DODAJ GUMB ZA POTRDITEV NAROČILA -->
                <?php } elseif(!isset($_SESSION["loggedin"])) { ?>
                    Za dodajanje v košarico se je potrebno prijaviti.
                <?php } else { ?>
                    Košara je prazna.                
                <?php } ?>
            </div>
        <?php } ?>
    </body>
</html>