<?php
include_once "../Mise_en_page/header.php";
include_once  "../Mise_en_page/footer.php";

mon_header("Customer");

?>
<div>
    <span>Implémenter la Base de données (Step 1) :</span>
    <a class="btn btn-primary" href="../actions/AjoutBDD.php"><i class="fas fa-plus-square"></i> Implémenter</a>
</div>

<div>
    <a class="btn btn-success" href="../Form/ajouter_customer.php"><i class="fas fa-plus-square"></i> Ajouter un consommateur</a>
</div>



    <table class="table">
        <tr>

            <th>Prénom</th>
            <th>Nom</th>
            <th></th>
            <th></th>
        </tr>

        <?php


        $db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);
        $r=$db->prepare("SELECT * FROM `customer`");
        $r->execute();
        //$r->debugDumpParams();
        $resultats=$r->fetchAll();



        foreach ($resultats as $ligne) {

            $r2 = $db->prepare(" SELECT o.id as order_id, c.id as id_customer FROM `order` o JOIN customer c on o.id_customer=c.id WHERE id_customer = :id");
            $r2->bindParam(":id", $ligne["id"]);
            $r2->execute();
            $resultats2=$r2->fetchAll();

            ?>

            <tr>
                <td><?php echo $ligne["firstname"]?></td>
                <td><?php echo $ligne["lastname"]?></td>


                <td>
                    <form method="post" action="../actions/action_supprimer_customer.php">
                        <input type="hidden" name="id" value="<?php echo $ligne["id"] ?>">
                        <a href="../Form/modifier_customer.php?id=<?php echo $ligne["id"]?>" class="btn btn-primary"><i
                                    class="fa fa-edit"></i></a>
                        <button type="submit" onclick="return confirm('Etes-vous sur de vouloir supprimer ce client ? (Cela va supprimer toutes les commandes qu\'il a fait)')"
                                class="btn btn-danger"><i class="fa fa-trash"></i></button>
                       <?php
                       if (!empty($resultats2)) { ?>
                        <a href="../Form/Customer_Orders.php?id=<?php echo $ligne["id"]?>" class="btn btn-warning"><i
                                    class="fa fa-edit"></i>Détails</a>

                       <?php } ?>
                    </form>
                </td>

                <?php
        }
        ?>
    </table>


<?php mon_footer(); ?>
