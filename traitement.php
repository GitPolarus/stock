<?php
require_once("./connexion.php");
session_start();
$errors = [];
/**
 * get value from form input field
 * @param mixed $inputName
 * @param bool $required
 * 
 * @return [String]
 */
function getInputValue($inputName, $required = true)
{
    global $errors;
    if (empty($_REQUEST[$inputName] && $required)) {
        array_push($errors, "$inputName is empty");
        $_SESSION["errors"] = $errors;
        return null;
    }

    return htmlspecialchars($_REQUEST[$inputName]);
}

if (isset($_REQUEST["register"])) {
    $name = getInputValue("name");
    $email = getInputValue("email");
    $password = getInputValue("password");
    // Hashage du mot de passe avant stockage dans la BD
    $encryptedPass = password_hash($password, PASSWORD_BCRYPT);

    if ($name == null or $email == null or $password == null) {
        header("location:./register.php");
    }

    $sql = "INSERT INTO users (nom, email, password) values (:nom, :email, :password);";

    $params = [
        "nom" => $name,
        "email" => $email,
        "password" => $encryptedPass
    ];


    $stmt = $conn->prepare($sql);
    if ($stmt->execute($params)) {
        $_SESSION["success"] = "User Regitered successfully";
        header("location:./login.php");
    } else {
        $_SESSION["error"] = "User Regitration failed";
        header("location:./register.php");
    }

}

if (isset($_REQUEST["login"])) {
    $email = getInputValue("email");
    $password = getInputValue("password");

    if ($email == null or $password == null) {
        header("location:./login.php");
    }

    $sql = "SELECT * FROM users WHERE email = :email";

    $params = [
        "email" => $email,
    ];
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($user)) {
        if (password_verify($password, $user["password"])) {
            $_SESSION["success"] = "Use logged in successfully";
            header("location:./index.php");
        } else {
            $_SESSION["error"] = "incorrect password";
            header("location:./login.php");
        }
    } else {
        $_SESSION["error"] = "User account does not exist";
        header("location:./login.php");
    }

}