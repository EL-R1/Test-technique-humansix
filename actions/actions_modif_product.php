<?php
include_once "../Mise_en_page/header.php";
$name=filter_input(INPUT_POST, "name");
$price=filter_input(INPUT_POST, "price");
$ref=filter_input(INPUT_POST, "ref");

;
//Créer un objet de connexion a la BDD avec PDO
$db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

//je prépare ma requete sql
$r=$db->prepare("update product set name=:name, price=:price where ref=:ref ");

$r->bindParam(":name", $name);
$r->bindParam(":price", $price);
$r->bindParam(":ref",$ref);

$r->debugDumpParams();
$r->execute();

header('location: ../Form/Product.php');