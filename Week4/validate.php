<?php
/**
 * Created by PhpStorm.
 * User: iglitzi
 * Date: 3/22/16
 * Time: 8:45 PM
 */

if (!filter_var($_POST['website'], FILTER_VALIDATE_URL)) {
    echo "<div class='message'> Invalid Website URL... Try Again!</div>";
    $_SESSION['error'] = 1;

} else {
    $website = $_POST['website'];
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    echo "<div class='message'> Invalid Email... Try Again!</div>";
    $_SESSION['error'] = 1;

} else {
    $email = $_POST['email'];
}

if (!is_numeric($_POST['phone'])) {
    echo "<div class='message'> Invalid Phone... Try Again!</div>";
    $_SESSION['error'] = 1;

} else {
    $phone = $_POST['phone'];
}

?>