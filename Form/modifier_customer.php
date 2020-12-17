<?php
include_once  "../Mise_en_page/header.php";
include_once  "../Mise_en_page/footer.php";
mon_header("Modifier Customer");

$id=filter_input(INPUT_GET, "id");
;
$db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

$r=$db->prepare("select * from customer where id=:id ");
$r->bindParam(":id",$id);
$r->execute();

//$r->debugDumpParams();

$lignes=$r->fetchAll();

?>

<h2>Modifier un Consommateur</h2>

<form method="post" action="../actions/actions_modif_customer.php">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <div class="form-group">
        <label for="Prénom">Prénom</label>
        <input type="text" class="form-control" maxlength="150"
               name="firstname" value="<?php echo $lignes[0]["firstname"] ?>" required>
    </div>

    <div class="form-group">
        <label for="Nom">Nom</label>
        <input type="text" class="form-control" maxlength="150"
               name="lastname" value="<?php echo $lignes[0]["lastname"] ?>" required>
    </div>

    <a href="Customer.php" class="btn btn-danger">
        <i class="fal fa-backward"></i>
        Retour
    </a>
    <button type="submit" class="btn btn-primary pull-right" onclick="return confirm('Etes-vous sur de vouloir modifier ce consommateur ?')">Enregistrer</button>
</form>