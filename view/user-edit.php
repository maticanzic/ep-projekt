<!DOCTYPE html>
<link rel ="stylesheet" type="text/css" href="<?= CSS_URL . "bootstrap.min.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Posodabljanje uporabnika</title>

<h1>Posodabljanje podatkov uporabnika: <?= $name ?> <?= $lastName ?></h1>

<p>[
    <a href="<?= BASE_URL . "users/add" ?>">Dodaj novega uporabnika</a> |
    <a href="<?= BASE_URL . "users" ?>">Vsi uporabniki</a>
    ]</p>

<form action="<?= BASE_URL . "users/edit/" . $id ?>" method="post">
    <input type="hidden" name="id" value="<?= $id ?>"  />
    <p><label>Ime: <input type="text" name="name" value="<?= $name ?>" autofocus required /></label></p>
    <p><label>Priimek: <input type="text" name="lastName" value="<?= $lastName ?>" required /></label></p>
    <p><label>E-naslov: <input type="text" name="email" value="<?= $email ?>" required /></label></p>
    <p><label>Geslo: <input type="password" name="password" value="<?= password_hash($password, PASSWORD_DEFAULT) ?>" required /></label></p>
    <p><label>Tip uporabnika:
        <select name="type">
            <option value="1">Prodajalec</option>
            <option value="2">Stranka</option>
        </select></label></p>
    <p><label>Naslov: <input type="text" name="address" value="<?= $address ?>"  /></label></p>
    <p><label>Telefon: <input type="text" name="phone" value="<?= $phone ?>" /></label></p>
    <p><label>Aktiviran: <input type="checkbox" name="activated" <?php if(isset($activated) && $activated == 1){print " checked=\"checked\"";} ?> /></label></p>
    <p><button>Posodobi zapis artikla</button></p>
</form>

<form action="<?= BASE_URL . "users/delete/" . $id ?>" method="post">
    <label>Izbris uporabnika? <input type="checkbox" name="delete_confirmation" required /></label>
    <button type="submit" class="important">Izbriši uporabnika</button>
</form>
