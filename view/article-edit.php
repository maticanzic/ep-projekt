<!DOCTYPE html>

<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Posodabljanje artikla</title>

<h1>Posodabljanje zapisa artikla</h1>

<p>[
    <a href="<?= BASE_URL . "articles" ?>">Vsi artikli</a> |
    <a href="<?= BASE_URL . "articles/add" ?>">Dodaj nov artikel</a>
    ]</p>

<form action="<?= BASE_URL . "articles/edit/" . $id ?>" method="post">
    <input type="hidden" name="id" value="<?= $id ?>"  />
    <p><label>Naziv: <input type="text" name="title" value="<?= $title ?>" autofocus /></label></p>
    <p><label>Cena: <input type="number" name="price" value="<?= $price ?>" /></label></p>
    <p><label>Aktiviran: <input type="checkbox" name="activated" <?php if(isset($activated) && $activated == 1){print " checked=\"checked\"";} ?> /></label></p>
    <p><label>Opis: <br/><textarea name="description" cols="70" rows="10"><?= $description ?></textarea></label></p>
    <p><button>Posodobi zapis artikla</button></p>
</form>

<form action="<?= BASE_URL . "articles/delete/" . $id ?>" method="post">
    <label>Izbris artikla? <input type="checkbox" name="delete_confirmation" /></label>
    <button type="submit" class="important">Izbriši artikel</button>
</form>
