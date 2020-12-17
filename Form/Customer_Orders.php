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


$id=filter_input(INPUT_GET, "id");
if (empty($id)){
    $id=filter_input(INPUT_POST, "id");
}



$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

if ($tri == 0){
    $r = $db->prepare("SELECT *, o.id as order_id, c.id as id_customer FROM `order` o JOIN customer c on o.id_customer=c.id WHERE id_customer = :id ORDER BY `o`.`orderDate` ASC");
}else if($tri == 1){
    $r = $db->prepare("SELECT *, o.id as order_id, c.id as id_customer FROM `order` o JOIN customer c on o.id_customer=c.id WHERE id_customer = :id ORDER BY `o`.`status` ASC");
}else if($tri == 2){
    $r = $db->prepare("SELECT *, o.id as order_id, c.id as id_customer FROM `order` o JOIN customer c on o.id_customer=c.id WHERE id_customer = :id ORDER BY `o`.`price` ASC");
}

$r->bindParam(":id", $id);
$r->execute();
//$r->debugDumpParams();
$resultats = $r->fetchAll();

?>


    <h2>Voici les commandes de <?php echo $resultats[0]["firstname"]," ",$resultats[0]["lastname"] ?></h2>
    <h3>Vous voulez voir toutes les commandes ? </h3>


    <a class="btn btn-success" href="../Form/Orders.php">Voir toutes les commandes</a>
    <table class="table">
        <tr>
            <th></th>
            <th>
                <form method="post" action="Customer_Orders.php">
                    <input type="hidden" name="tri" value="0">
                    <input type="hidden" name="id" value="<?php echo $id ?>>">
                    <button class="btn btn-link" type="submit">orderDate </button>
                </form>
            </th>
            <th>
                <form method="post" action="Customer_Orders.php">
                    <input type="hidden" name="tri" value="1">
                    <input type="hidden" name="id" value="<?php echo $id ?>>">
                    <button class="btn btn-link" type="submit">Status </button>
                </form>
            </th>
            <th>
                <form method="post" action="Customer_Orders.php">
                    <input type="hidden" name="tri" value="2">
                    <input type="hidden" name="id" value="<?php echo $id ?>>">
                    <button class="btn btn-link" type="submit">Prix </button>
                </form>
            </th>
            <th></th>
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
                <form method="post" action="../Form/ajouter_product_order.php">
                    <input type="hidden" name="id_customer" value="<?php echo $ligne["id_customer"]?>">
                    <input type="hidden" name="id_order" value="<?php echo $id?>">
                    <button class="btn btn-warning"><i
                                class="fa fa-edit"></i> Détails</button>
                </form>
                <?php if ($ligne["status"] == "processing" ){ ?>
                    <form method="post" action="../Form/ajouter_product_order.php">
                        <input type="hidden" name="canceled" value="canceled">
                        <input type="hidden" name="id_order" value="<?php echo $ligne["id_order"] ?>">
                        <button class="btn btn-dark"><i
                                    class="fa fa-close"></i> Annuler la commande</button>
                    </form>
                <?php }?>
                <form method="post" action="../actions/action_supprimer_order.php">
                    <input type="hidden" name="id" value="<?php echo $ligne["id_order"] ?>">
                    <button type="submit" onclick="return confirm('Etes-vous sur de vouloir supprimer ce client ? (Cela va supprimer toutes les commandes qu\'il a fait)')"
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
        Retour
    </a>

<?php mon_footer(); ?>