<?php
include_once "../Mise_en_page/header.php";


$utilisateur=filter_input(INPUT_POST, "email");
$mot_de_passe=filter_input(INPUT_POST, "mot_de_passe");

$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);
$r = $db->prepare("select * from utilisateur where login=:login AND mot_de_passe=:mot_de_passe");

$r->bindParam(":login",$utilisateur);
$r->bindParam(":mot_de_passe",$mot_de_passe);
$r->debugDumpParams();
$r->execute();

$resultat=$r->fetchAll();


if (!empty($resultat)) {
    $_SESSION["Login"] = "Connecté !";
    header("location: ../Form/Customer.php");

}else{
    header("location: ../Form/Index.php");
}
