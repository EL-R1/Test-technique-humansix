<?php
include_once  "../Mise_en_page/header.php";
include_once  "../Mise_en_page/footer.php";
mon_header("Listes des Commandes");

$tri2=filter_input(INPUT_POST, "tri");
if(empty($tri2)){
    $tri = 0;
}else{
    $tri = intval($tri2);
}

$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

if ($tri == 0){
    $r = $db->prepare("SELECT *, o.id as id_order, c.id as id_customer FROM `order` o JOIN customer c on o.id_customer=c.id ORDER BY `o`.`orderDate` ASC");
}else if($tri == 1){
    $r = $db->prepare("SELECT *, o.id as id_order, c.id as id_customer FROM `order` o JOIN customer c on o.id_customer=c.id ORDER BY `o`.`status` ASC");
}else if($tri == 2){
    $r = $db->prepare("SELECT *, o.id as id_order, c.id as id_customer FROM `order` o JOIN customer c on o.id_customer=c.id ORDER BY `o`.`price` ASC");
}

$r->execute();
//$r->debugDumpParams();
$resultats = $r->fetchAll();

?>

    <h2>Voici toutes les commandes</h2>
    <div>
        <a class="btn btn-success" href="../Form/ajouter_order.php"><i class="fas fa-plus-square"></i> Ajouter une commande</a>
    </div>

    <table class="table">
        <tr>
            <th></th>
            <th>
                <form method="post" action="Orders.php">
                    <input type="hidden" name="tri" value="0">
                    <button class="btn btn-link" type="submit">orderDate </button>
                </form>
            </th>
            <th>
                <form method="post" action="Orders.php">
                    <input type="hidden" name="tri" value="1">
                    <button class="btn btn-link" type="submit">Status </button>
                </form>
            </th>
            <th>
                <form method="post" action="Orders.php">
                    <input type="hidden" name="tri" value="2">
                    <button class="btn btn-link" type="submit">Prix </button>
                </form>
            </th>
        </tr>

        <?php
        foreach ($resultats as $ligne) {

        ?>

        <tr>
            <td></td>
            <td><?php echo $ligne["orderDate"]?></td>
            <td><?php echo $ligne["status"]?></td>
            <td><?php echo $ligne["price"]?> €</td>
            <td>
                <?php if ($ligne["status"] == "processing" ){ ?>
                    <form method="post" action="../Form/ajouter_product_order.php">
                        <input type="hidden" name="id_customer" value="<?php echo $ligne["id_customer"]?>">
                        <input type="hidden" name="id_order" value="<?php echo $ligne["id_order"] ?>">
                        <button class="btn btn-success"><i
                                    class="fa fa-edit"></i> Continuer la commande</button>
                    </form>
                <?php } if ($ligne["status"] != "canceled" ){ ?>
                    <form method="post" action="../actions/actions_ajout_order.php">
                        <input type="hidden" name="canceled" value="canceled">
                        <input type="hidden" name="id_order" value="<?php echo $ligne["id_order"] ?>">
                        <button class="btn btn-danger"><i
                                    class="fa fa-close"></i> Annuler la commande</button>
                    </form>
                <?php }?>
                <form method="post" action="../actions/action_supprimer_order.php">
                    <input type="hidden" name="id" value="<?php echo $ligne["id_order"] ?>">
                    <button type="submit" onclick="return confirm('Etes-vous sur de vouloir supprimer cette commande ? (Cela va supprimer tous les produits associés)')"
                            class="btn btn-danger"><i class="fa fa-trash"></i></button>
                </form>
            </td>
            <td></td>



            <?php
            }
            ?>
    </table>
    <a href="Customer.php" class="btn btn-danger">
        <i class="fal fa-backward"></i>
        Retour à la listes des consommateurs
    </a>

<?php mon_footer(); ?>