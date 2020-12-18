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

    $id = $_GET['id'];

    $db = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

    $r=$db->prepare("SELECT * FROM `order` WHERE id=:id");
    $r->execute();

    if($r->rowCount() > 0){
        $tab = [];
        $tab["order"] = [];


        $resultats=$r->fetchAll();

        foreach ($resultats as $row){

            $order = [
                "id" => $row["id"],
                "orderDate" => $row["orderDate"],
                "status" => $row["status"],
                "price" => $row["price"],
                "id_customer" => $row["id_customer"],
            ];

            $tab["order"][] = $order;

            http_response_code(200);

            echo json_encode($tab);
        }
    }else{
        http_response_code(404);
        echo json_encode(["message" => "Il n'y a pas de commande avec cette id"]);
    }
    
}else{
    http_response_code(405);
    echo json_encode(["message" => "La methode utilisee n'est pas la bonne"]);
}


