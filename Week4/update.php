<?php
/**
 * Created by PhpStorm.
 * User: Elimarie Morales Santiago
 * Date: 3/22/16
 * Time: 9:46 PM
 */

    session_start();

    $_SESSION["message"] = "<div class='message'> Client Updated Successfully!</div>";

    $user = 'root';
    $pass = 'root';
    $mysql = 'mysql:host=localhost;dbname=SSL;port=8889';
    $dbh = new PDO($mysql, $user, $pass);


    $clientid = $_GET['id'];

    $stmt = $dbh->prepare("SELECT * FROM clients where clientid IN (:clientid)");
    $stmt->bindParam(':clientid', $clientid);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $website = $_POST['website'];

    $stmt=$dbh->prepare("UPDATE clients SET fname='".$fname."', lname='".$lname."', phone='".$phone."',email='".$email."', website='".$website ."' WHERE clientid ='$clientid'");
    $stmt->execute();

    header('Location: clients.php');
    die();

}

?>

<!Doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Clients Update</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>

<header>
    <h1><a href="clients.php">Update Contact Information</a></h1>
</header>

<form class="update" action="" method="POST">
    <label><strong>First Name:</strong><input type="text" name="fname" value=<?php echo '"' .$result[0]['fname']. '"';  ?> required /><br>
    <label><strong>Last Name:</strong><input type="text" name="lname" value=<?php echo '"' .$result[0]['lname']. '"';  ?> required /><br>
    <label><strong>Phone:</strong><input type="text" name="phone" value=<?php echo '"' .$result[0]['phone']. '"';  ?> required /><br>
    <label><strong>Email:</strong><input type="text" name="email" value=<?php echo '"' .$result[0]['email']. '"';  ?> required /><br>
    <label><strong>Website:</strong><input type="text" name="website" value=<?php echo '"' .$result[0]['website']. '"';  ?> required /><br>
    <input class="button1" type="submit" name="submit" value="Update" /><br>
</form>



<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script>

    (function ($) {

        $('.message').fadeIn().delay(3000).fadeOut();

    })(jQuery);

</script>
</body>
</html>