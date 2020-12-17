<?php
include_once "../Mise_en_page/header.php";
$id_customer=filter_input(INPUT_POST, "id");

$db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

$r=$db->prepare("delete c from customer c where c.id=:id_customer");
$r->bindParam(":id_customer",$id_customer);
$r->execute();
$r->debugDumpParams();


header('location: ../Form/Customer.php');
