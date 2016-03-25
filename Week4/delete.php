<?php
/**
 * Created by PhpStorm.
 * User: Elimarie Morales Santiago
 * Date: 3/23/16
 * Time: 9:21 PM
 */

    session_start();

    $_SESSION["message"] = "<div class='message'> Client Deleted Successfully!</div>";

    $user = 'root';
    $pass = 'root';
    $mysql = 'mysql:host=localhost;dbname=SSL;port=8889';
    $dbh = new PDO($mysql, $user, $pass);

    $clientid = $_GET['id'];

    $stmt = $dbh->prepare("DELETE FROM clients where clientid IN (:clientid)");
    $stmt->bindParam(':clientid', $clientid);
    $stmt->execute();

    header('Location: clients.php');

    die();

?>
