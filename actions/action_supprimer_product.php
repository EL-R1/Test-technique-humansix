<?php
include_once "../Mise_en_page/header.php";
$sku_product=filter_input(INPUT_POST, "sku");
var_dump($_POST);


$db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

$r=$db->prepare("delete p from product p where p.sku=:sku_product");
$r->bindParam(":sku_product",$sku_product);
$r->execute();
$r->debugDumpParams();


header('location: ../Form/Product.php');
