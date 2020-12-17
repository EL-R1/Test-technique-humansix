<?php
include_once "../Mise_en_page/header.php";
$firstname=filter_input(INPUT_POST, "firstname");
$lastname=filter_input(INPUT_POST, "lastname");

;
//Créer un objet de connexion a la BDD avec PDO
$db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

//je prépare ma requete sql
$r=$db->prepare("update customer set firstname=:firstname, lastname=:lastname where id=:id ");

$r->bindParam(":firstname", $firstname);
$r->bindParam(":lastname", $lastname);
$r->bindParam(":id",$id);

$r->execute();


header('location: ../Form/Customer.php');