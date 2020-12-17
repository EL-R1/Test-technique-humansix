<?php
include_once "../Mise_en_page/header.php";
require_once "../config.php";

$xml = simplexml_load_file("../orders.xml");

$db = new PDO("mysql:host=" . Config::SERVEUR . ";dbname=" . Config::BASEDEDONNEES, Config::UTILISATEUR, Config::MOTDEPASSE);

//echo '<pre>' . var_export($data, true) . '</pre>';            vardump
foreach ($xml->children() as $row){
    $id_order = $row[0]->attributes();

    $customer = $row->customer;

    $id_customer = $customer[0]->attributes(); //avoir l'id du xml

    foreach ($customer as $row_customer){
        $firstname = $row_customer->firstname;
        $lastname = $row_customer->lastname;

        $r = $db->prepare("INSERT INTO `customer`(id,firstname,lastname) values (:id, :firstname, :lastname)");
        $r->bindParam(":id", $id_customer);
        $r->bindParam(":firstname", $firstname);
        $r->bindParam(":lastname", $lastname);
        $r->execute();
    }

    $orderDate = $row->orderDate;
    $status = $row->status;
    $price = $row->price;

    $r3 = $db->prepare("INSERT INTO `order`(id,orderDate,status,price, id_customer) values (:id, :orderDate, :status, :price, :id_customer)");
    $r3->bindParam(":id", $id_order);
    $r3->bindParam(":orderDate", $orderDate);
    $r3->bindParam(":status", $status);
    $r3->bindParam(":price", $price);
    $r3->bindParam(":id_customer", $id_customer);
    $r3->execute();
    $r3->debugDumpParams();

    $cart = $row->cart;
    foreach ($cart as $cart_row){

        $product = $cart_row->product;

        foreach ($product as $list_product){
            $sku = $list_product[0]->attributes();
            $name = $list_product->name;
            $quantity = $list_product->quantity;
            $price = $list_product->price;

            $r2 = $db->prepare("INSERT INTO `product`(sku,name,price) values (:sku, :name, :price)");
            $r2->bindParam(":sku", $sku);
            $r2->bindParam(":name", $name);
            $r2->bindParam(":price", $price);
            $r2->execute();

            $r4 = $db->prepare("INSERT INTO `cart`(quantity, id_order,sku_product) values (:quantity, :id_order, :sku_product)");
            $r4->bindParam(":quantity", $quantity);
            $r4->bindParam(":id_order", $id_order);
            $r4->bindParam(":sku_product", $sku);
            $r4->execute();

        }
    }
}
header('location: ../Form/Customer.php');