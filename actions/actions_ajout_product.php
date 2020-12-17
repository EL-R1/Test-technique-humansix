<?php
include_once "../Mise_en_page/header.php";
$name=filter_input(INPUT_POST, "name");
$price=filter_input(INPUT_POST, "price");

//Créer un objet de connexion a la BDD avec PDO
$db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

var_dump($name);
var_dump($price);

$r1=$db->prepare("SELECT COUNT(sku) FROM `product`");
$r1->execute();
//$r->debugDumpParams();
$resultats=$r1->fetchAll();


$id = $resultats[0]["COUNT(sku)"] + 1;
$string_resultats = strval($id);
$sku =  "sku".$string_resultats;


//je prépare ma requete sql
$r=$db->prepare("insert into product (sku,name, price) values (:sku, :name, :price) ");

$r->bindParam(":sku", $sku);
$r->bindParam(":name", $name);
$r->bindParam(":price", $price);

$r->debugDumpParams();


$r->execute();


header('location: ../Form/Product.php');