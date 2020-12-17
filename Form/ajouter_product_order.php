<?php
include_once "../Mise_en_page/header.php";
include_once "../Mise_en_page/footer.php";
mon_header("Ajouter Produit");

$id_customer = filter_input(INPUT_POST, "id_customer");
$id_order = filter_input(INPUT_POST, "id_order");

if(empty($id_order) or empty($id_customer) ){
    $id_order = $_SESSION["id_order"];
    $id_customer = $_SESSION["id_customer"];
}

$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);
$r = $db->prepare("SELECT *, SUM(o.price), o.id as order_id, c.id as id_customer FROM `order` o JOIN customer c on o.id_customer=c.id WHERE id_customer = :id ORDER BY `o`.`orderDate` ASC");

$r->bindParam(":id", $id_customer);
$r->execute();
//$r->debugDumpParams();
$resultats = $r->fetchAll();
?>

    <div class="row">
<?php  if($resultats[0]["status"] != "canceled"){
?>
        <div class="col-md-4">
            <h2>Ajouter des produits dans la commande n°<?php echo $id_order ?> </h2>
            <h3>Fait par : <?php echo $resultats[0]["firstname"], " ", $resultats[0]["lastname"] ?></h3>
            <form method="post" action="../actions/actions_ajout_produit_order.php">
                <div class="form-group">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Choisir l'utilisateur</label>
                    <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="product">
                        <?php

                        $db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

                        $r = $db->prepare("SELECT * FROM `product`");
                        $r->execute();
                        $r->debugDumpParams();
                        $resultats1 = $r->fetchAll();

                        foreach ($resultats1 as $ligne) {
                            ?>
                            <option value="<?php echo $ligne['ref'] ?>"><?php echo $ligne['name'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="Quantité">Quantité</label>
                    <input type="number" class="form-control" maxlength="150" step="1"
                           name="quantity" value="" placeholder="Entrez une quantité du produit" required>
                </div>

                <input type="hidden" value="<?php echo $id_order ?>" name="id_order">
                <input type="hidden" value="<?php echo $id_customer ?>" name="id_customer">

                <a href="Orders.php" class="btn btn-danger"
                   onclick="return confirm('Etes-vous sur ? Si ce produit n\'a pas été rentré il ne sera pas sauvegardé')">
                    <i class="fal fa-backward"></i>
                    Retour
                </a>
                <button type="submit" class="btn btn-primary pull-right"
                        onclick="return confirm('Voulez-vous ajouter ce consommateur ?')">Ajouter
                </button>
            </form>



        </div>
        <?php } ?>
        <div class="col-md-4"></div>


        <div class="col-md-4">
            <h2>Liste des produits dans la categorie n°<?php echo $id_order ?>  </h2>
            <H3>Fait par : <?php echo $resultats[0]["firstname"], " ", $resultats[0]["lastname"] ?></H3>
            <?php

            $db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);
            $r = $db->prepare("SELECT * FROM `cart` c JOIN product p on p.ref=c.ref_product WHERE id_order= :id");
            $r->bindParam(":id", $id_order);
            $r->execute();
            //$r->debugDumpParams();
            $resultats1= $r->fetchAll();
            ?>

            <table class="table">
                <tr>

                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantity</th>
                </tr>

                <?php

                foreach ($resultats1 as $ligne) { ?>

                <tr>
                    <td><?php echo $ligne["name"]?></td>
                    <td><?php echo $ligne["price"]?> €</td>
                    <td><?php echo $ligne["quantity"] ?></td>
                </tr>
                    <?php
                    }
                    ?>
            </table>
            <table>
                <tr>
                    <th>Total :  <td><?php echo $resultats[0]["SUM(o.price)"] ?> €</td></th>
                </tr>
            </table>
        </div>

    </div>


<?php
if($resultats[0]["status"] == "canceled"){
?>
    <a href="Orders.php" class="btn btn-danger">
        <i class="fal fa-backward"></i>
        Retour
    </a>
<?php

}


mon_footer();
?>