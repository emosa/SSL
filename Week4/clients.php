<?php
/**
 * Created by PhpStorm.
 * USuccessfullyyie Morales Santiago
 * Date: 3/22/16
 * Time: 8:44 PM
 */

session_start();


if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

$user = 'root';
$pass = 'root';
$mysql = 'mysql:host=localhost;dbname=SSL;port=8889';
$dbh = new PDO($mysql, $user, $pass);

if (isset($_POST['submit'])){

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $website = $_POST['website'];

    $dbh = new PDO($mysql, $user, $pass);
    $stmt = $dbh->prepare("INSERT INTO clients (fname,lname, phone, email, website ) VALUES(:fname, :lname, :phone, :email, :website);");
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':website', $website);
    $stmt->execute();

    echo "<div class='message'>Client Was Added Successfully!</div>";
}

?>


<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Clients Database</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>

    <p><h1><b>Elimarie's Clients Contact Manager</b></h1>
    <div class="btn">
        <button class="add-button">Add Client</button>
    </div>


<section class="form">
    <form id="add" action="clients.php" method="POST">
        <label><strong>First Name:</strong><input type="text" name="fname" value="" required /></label><br>
        <label><strong>Last Name:</strong><input type="text" name="lname" value="" required /></label><br>
        <label><strong>Phone:</strong><input type="text" name="phone" value="" required /></label><br>
        <label><strong>Email:</strong><input type="text" name="email" value="" required /></label><br>
        <label><strong>Website:</strong><input type="text" name="website" value="http://" required /></label><br>
        <div id="button1">
            <input class="button1" type="submit" name="submit" value="Save">
        </div>
    </form>
</section>

<?php

    $dbh = new PDO($mysql, $user, $pass);
    $stmt = $dbh->prepare("SELECT * FROM clients ORDER BY clientid");
    $stmt->execute();
    $result = $stmt->fetchAll();

    foreach ($result as $row){

        echo "<div align=center id='client'>";
        echo "<div class='client'>";
        echo "<h2>First:" . " " . $row['fname']."</h2>";
        echo "<h2>Last:" . " " . $row['lname']."</h2>";
        echo "<h2>Phone:" . " " . $row['phone']."</h2>";
        echo "<h2>Email:" . " " . $row['email']."</h2>";
        echo "<h2>Website:" . " " . $row['website']."</h2>";
        echo '<a href="delete.php?id='.$row['clientid'].'"><button id="delete" class="button2">X</button></a>&nbsp &nbsp &nbsp';
        echo '<a href="update.php?id='.$row['clientid'].'"><button id="edit" class="button3">E</button></a>';
        echo "</div></div></aside>";


    }
?>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script>

        (function ($) {

            $('.message').fadeIn().delay(3000).fadeOut();
            $('.message2').fadeIn().delay(3000).fadeOut();

            $('.button2').click(function() {
                return window.confirm(this.title || 'Do you want to delete this client?');
            });

            $("form").hide();
            $('.add-button').click(function(){
                $('#add').slideToggle();
                return false;
            });

            })(jQuery);

        </script>



</body>
</html>