<!DOCTYPE html>
<link rel ="stylesheet" type="text/css" href="<?= CSS_URL . "bootstrap.min.css" ?>">
<link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
<meta charset="UTF-8" />
<title>Dodajanje uporabnika</title>

<h1>Dodaj novega uporabnika</h1>

<p>[
<a href="<?= BASE_URL . "users" ?>">Vsi uporabniki</a> 
]</p>

<form action="<?= BASE_URL . "users/add" ?>" method="post">
    <p><label>Ime: <input type="text" name="name" value="<?= $name ?>" autofocus required /></label></p>
    <p><label>Priimek: <input type="text" name="lastName" value="<?= $lastName ?>" required /></label></p>
    <p><label>E-naslov: <input type="text" name="email" value="<?= $email ?>" required /></label></p>
    <p><label>Geslo: <input type="password" name="password" value="<?= $password ?>" required /></label></p>
    <p><label>Tip uporabnika:
            <select name="type">
                <option value="1">Prodajalec</option>
                <option value="2">Stranka</option>
            </select></label></p>
    <p><label>Naslov: <input type="text" name="address" value="<?= $address ?>" /></label></p>
    <p><label>Telefon: <input type="text" name="phone" value="<?= $phone ?>" /></label></p>
    <input type="hidden" name="activated" value=0>
    <p><label>Aktiviran: <input type="checkbox" name="activated" /></label></p>
    <p><button>Dodaj uporabnika</button></p>
</form>