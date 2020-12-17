<?php
include_once "../Mise_en_page/header.php";
$id=filter_input(INPUT_POST, "id");

var_dump($id);
$db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

$r=$db->prepare("delete o from `order` o where o.id=:id");
$r->bindParam(":id",$id);
$r->execute();
$r->debugDumpParams();


header('location: ../Form/Orders.php');
