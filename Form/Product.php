<?php
include_once  "../Mise_en_page/header.php";
include_once  "../Mise_en_page/footer.php";
mon_header("Product");
?>

<a href="ajouter_product.php" type="submit" class="btn btn-success"><i class="fas fa-plus-square"></i> Ajouter un produit</a>


    <table class="table">
        <tr>

            <th>Référence</th>
            <th>Nom</th>
            <th>Prix</th>
            <th></th>
        </tr>

        <?php


        $db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

        $r=$db->prepare("SELECT * FROM `product`");
        $r->execute();
        //$r->debugDumpParams();
        $resultats=$r->fetchAll();
        foreach ($resultats as $ligne) {
            ?>

            <tr>
                <td><?php echo $ligne["sku"]?></td>
                <td><?php echo $ligne["name"]?></td>
                <td><?php echo $ligne["price"]?> €</td>


                <td>
                    <form method="post" action="../actions/action_supprimer_product.php">
                        <input type="hidden" name="sku" value="<?php echo $ligne["sku"] ?>">
                        <a href="../Form/modifier_product.php?sku=<?php echo $ligne["sku"]?>" class="btn btn-primary"><i
                                    class="fa fa-edit"></i></a>
                        <button type="submit" onclick="return confirm('Etes-vous sur de vouloir supprimer ce produit ? (Cela va supprimer toutes les commandes dans lesquels il est)')"
                                class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </td>

                <?php
        }
        ?>
    </table>


<?php mon_footer(); ?>
