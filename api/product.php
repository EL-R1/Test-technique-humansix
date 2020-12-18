<?php
// Headers requis
// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");

// Format des données envoyées
header("Content-Type: application/json; charset=UTF-8");

// Méthode autorisée
header("Access-Control-Allow-Methods: GET");

// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");

// Entêtes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Condition pour bien avoir une api REST
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    require_once "../config/config.php";

    $sku = $_GET['sku'];

    $db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

    $r=$db->prepare("SELECT * FROM `product` WHERE sku=:sku");
    $r->bindParam(":sku", $sku);
    $r->execute();


    if($r->rowCount() > 0){
        $tab = [];
        $tab["product"] = [];


        $resultats=$r->fetchAll();

        foreach ($resultats as $row){

            $products = [
                "sku" => $row["sku"],
                "name" => $row["name"],
                "price" => $row["price"],
            ];

            $tab["product"][] = $products;

            http_response_code(200);

            echo json_encode($tab);
        }
    }else{
        http_response_code(404);
        echo json_encode(["message" => "Il n'y a pas de produit avec cette reference"]);
    }

}else{
    http_response_code(405);
    echo json_encode(["message" => "La methode utilisee n'est pas la bonne"]);
}


