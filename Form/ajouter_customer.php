<?php
include_once  "../Mise_en_page/header.php";
include_once  "../Mise_en_page/footer.php";
mon_header("Ajouter Customer");

?>

<h2>Ajouter un consommateur</h2>

<form method="post" action="../actions/actions_ajout_customer.php">
    <div class="form-group">
        <label for="Prénom">Prénom</label>
        <input type="text" class="form-control" maxlength="150"
               name="firstname" value="" placeholder="Entrez un prénom" required>
    </div>

    <div class="form-group">
        <label for="Nom">Nom</label>
        <input type="text" class="form-control" maxlength="150"
               name="lastname" value="" placeholder="Entrez un nom" required>
    </div>

    <a href="Customer.php" class="btn btn-danger">
        <i class="fal fa-backward"></i>
        Retour
    </a>
    <button type="submit" class="btn btn-primary pull-right" onclick="return confirm('Voulez-vous ajouter ce consommateur ?')">Ajouter</button>
</form>