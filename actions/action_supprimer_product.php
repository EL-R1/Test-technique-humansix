<?php
include_once "../Mise_en_page/header.php";
$ref_product=filter_input(INPUT_POST, "ref");
var_dump($_POST);


$db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

$r=$db->prepare("delete p from product p where p.ref=:ref_product");
$r->bindParam(":ref_product",$ref_product);
$r->execute();
$r->debugDumpParams();


header('location: ../Form/Product.php');
