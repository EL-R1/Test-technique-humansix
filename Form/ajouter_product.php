<?php
include_once  "../Mise_en_page/header.php";
include_once  "../Mise_en_page/footer.php";
mon_header("Ajouter Produit");

?>

<h2>Ajouter un Produit</h2>

<form method="post" action="../actions/actions_ajout_product.php">
    <div class="form-group">
        <label for="Nom">Nom</label>
        <input type="text" class="form-control" maxlength="150"
               name="name" value="" placeholder="Entrez un nom" required>
    </div>

    <div class="form-group">
        <label for="Prix">Prix</label>
        <input type="number" class="form-control" maxlength="150"
               name="price" value="" placeholder="Entrez un prix" required>
    </div>

    <a href="Product.php" class="btn btn-danger">
        <i class="fal fa-backward"></i>
        Retour
    </a>
    <button type="submit" class="btn btn-primary pull-right" onclick="return confirm('Voulez-vous ajouter ce consommateur ?')">Ajouter</button>
</form>