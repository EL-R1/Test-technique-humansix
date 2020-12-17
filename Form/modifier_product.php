<?php
include_once  "../Mise_en_page/header.php";
include_once  "../Mise_en_page/footer.php";
mon_header("Modifier Produit");

$ref=filter_input(INPUT_GET, "ref");
;
$db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

$r=$db->prepare("select * from product where ref=:ref ");
$r->bindParam(":ref",$ref);
$r->execute();

//$r->debugDumpParams();

$lignes=$r->fetchAll();

?>

<h2>Modifier un Produit</h2>

<form method="post" action="../actions/actions_modif_product.php">
    <input type="hidden" name="ref" value="<?php echo $ref ?>">
    <div class="form-group">
        <label for="Nom">Nom</label>
        <input type="text" class="form-control" maxlength="150"
               name="name" value="<?php echo $lignes[0]["name"] ?>" required>
    </div>

    <div class="form-group">
        <label for="Prix">Prix</label>
        <input type="text" class="form-control" maxlength="150"
               name="price" value="<?php echo $lignes[0]["price"] ?>" required>
    </div>

    <a href="Product.php" class="btn btn-danger">
        <i class="fal fa-backward"></i>
        Retour
    </a>
    <button type="submit" class="btn btn-primary pull-right" onclick="return confirm('Etes-vous sur de vouloir modifier ce produit ?')">Enregistrer</button>
</form>