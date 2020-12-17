<?php
include_once "../Mise_en_page/header.php";

$id_customer=filter_input(INPUT_POST, "id_customer");
$id_order = filter_input(INPUT_POST, "id_order");
$ref = filter_input(INPUT_POST, "product");
$quantity = filter_input(INPUT_POST, "quantity");

//Créer un objet de connexion a la BDD avec PDO
$db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

$r4 = $db->prepare("INSERT INTO `cart`(quantity, id_order,ref_product) values (:quantity, :id_order, :ref_product)");
$r4->bindParam(":quantity", $quantity);
$r4->bindParam(":id_order", $id_order);
$r4->bindParam(":ref_product", $ref);
$r4->execute();

$r=$db->prepare("select p.price, c.quantity from `cart` c join `product` p on c.ref_product=p.ref WHERE c.id_order=:id ");
$r->bindParam(":id", $id_order);
$r->debugDumpParams();
$r->execute();
$resultats = $r->fetchAll();

$price = 0;
foreach ($resultats as $row){
    var_dump($row["quantity"]);
    var_dump($row["price"]);
    $price +=  ($row["price"] * $row["quantity"]);
}

$r=$db->prepare("update `order` set price=:price where id=:id ");
$r->bindParam(":price", $price);
$r->bindParam(":id",$id_order);
$r->execute();


$_SESSION["id_order"] = $id_order;
$_SESSION["id_customer"] = $id_customer;
header('location: ../Form/ajouter_product_order.php');