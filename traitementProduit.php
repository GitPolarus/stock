<?php
require_once("./connexion.php");
session_start();
require_once("./helper/functions.php");

if (isset($_REQUEST["newProduct"])) {
    $label = getInputValue("libelle");
    $desc = getInputValue("description", false);
    $price = getInputValue("pu");
    $qty = getInputValue("qte");

    if ($label == null || $price == null || $qty == null) {
        header("location:./produits.php");
    }

    $sql = "Insert into produits (libelle, description, prix_unitaire, quantite, user_id) values (:libelle, :description, :prix_unitaire, :quantite, :user_id)";

    $params = [
        "libelle" => $label,
        "description" => $desc,
        "prix_unitaire" => $price,
        "quantite" => $qty,
        "user_id" => $_SESSION["user"]["id"]
    ];

    $stmt = $conn->prepare($sql);
    if ($stmt->execute($params)) {
        $_SESSION["success"] = "Product added successfully";
        header("location:./produits.php");
    } else {
        $_SESSION["error"] = "Product add failed";
        header("location:./produits.php");
    }
}

if (isset($_REQUEST["deleteId"])) {
    $sql = "Delete from produits where id = :id;";

    $params = [
        "id" => $_REQUEST["deleteId"]
    ];
    $stmt = $conn->prepare($sql);
    if ($stmt->execute($params)) {
        $_SESSION["success"] = "Product deletes successfully";
        header("location:./produits.php");
    } else {
        $_SESSION["error"] = "Product delete failed";
        header("location:./produits.php");
    }
}

if (isset($_REQUEST["updateProduct"])) {
    $label = getInputValue("libelle");
    $desc = getInputValue("description", false);
    $price = getInputValue("pu");
    $qty = getInputValue("qte");
    $id = getInputValue("id");

    if ($label == null || $price == null || $qty == null) {
        header("location:./produits.php");
    }

    $sql = "UPDATE  produits SET libelle = :libelle, description = :description, prix_unitaire = :prix_unitaire, quantite = :quantite , user_id = :user_id WHERE id = :id";

    $params = [
        "libelle" => $label,
        "description" => $desc,
        "prix_unitaire" => $price,
        "quantite" => $qty,
        "user_id" => $_SESSION["user"]["id"],
        "id" => $id
    ];

    $stmt = $conn->prepare($sql);
    if ($stmt->execute($params)) {
        $_SESSION["success"] = "Product updated successfully";
        header("location:./produits.php");
    } else {
        $_SESSION["error"] = "Product update failed";
        header("location:./produits.php");
    }
}