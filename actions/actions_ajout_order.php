<?php
include_once "../Mise_en_page/header.php";
$orderDate=filter_input(INPUT_POST, "orderDate");
$id_customer=filter_input(INPUT_POST, "id_customer");
$id_order=filter_input(INPUT_POST, "id_order");
$canceled=filter_input(INPUT_POST, "canceled");
$status = "processing";
$price = 0;
//Créer un objet de connexion a la BDD avec PDO
$db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

//je prépare ma requete sql
if (empty($canceled)){
    $r=$db->prepare("insert into `order` (orderDate,status, price, id_customer) values (:orderDate, :status, :price, :id_customer) ");
    $r->bindParam(":orderDate", $orderDate);
    $r->bindParam(":status", $status);
    $r->bindParam(":price", $price);
    $r->bindParam(":id_customer", $id_customer);
    $r->execute();
}else{
    $r=$db->prepare("update `order` set status=:status where id=:id ");
    $r->bindParam(":status", $canceled);
    $r->bindParam(":id",$id_order);
    $r->execute();
}


header('location: ../Form/Orders.php');