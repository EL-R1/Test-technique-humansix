<?php
include_once  "../Mise_en_page/header.php";
include_once  "../Mise_en_page/footer.php";
mon_header("Ajouter Produit");

?>

<h2>Ajouter une Categorie</h2>

<form method="post" action="../actions/actions_ajout_order.php">
    <div class="form-group">
        <label for="Nom">Date de la commande :</label>
        <input type="datetime-local" class="form-control" maxlength="150"
               name="orderDate" value="" placeholder="Entrez un nom" required>
    </div>

    <div class="form-group">
        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Choisir l'utilisateur</label>
        <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="id_customer">
            <?php

            $db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

            $r = $db->prepare("SELECT * FROM `customer`");
            $r->execute();
            //$r->debugDumpParams();
            $resultats = $r->fetchAll();

            foreach ($resultats as $ligne){
                    ?>
                     <option value="<?php echo $ligne['id'] ?>"><?php echo $ligne['firstname']," ",$ligne['lastname']  ?></option>
                    <?php
            }
            ?>
        </select>
    </div>

    <a href="Orders.php" class="btn btn-danger">
        <i class="fal fa-backward"></i>
        Retour
    </a>
    <button type="submit" class="btn btn-primary pull-right" onclick="return confirm('Voulez-vous ajouter cette commande ?')">Ajouter</button>
</form>