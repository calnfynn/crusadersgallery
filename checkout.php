<!doctype html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <meta name="title" content="Crusaders Gallery">
    <meta name="description" content="The online presence of the Crusaders Gallery, based in Hanover. ">
    <meta name="keywords" content="art, gallery, crusaders gallery, hannover, hanover, paintings, shop, online shop">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="author" content="--">
    <title>Checkout</title>
    <link rel="stylesheet" href="styleindex.css">
</head>
<body>
    <header>
        <?php include_once("header.php"); ?>
    </header>
    <nav>
        <?php include_once("nav.php"); ?>
    </nav>
    <section>
        <?php 
            include_once('connection.php'); //connects SQL-DB
            include_once('session.php'); //starts SESSION
        ?>
        <div>
            <?php

            if(isset($_SESSION['buyThose'])) { //if value passed by SESSION, assign to $buyThose 
                $buyThose = $_SESSION['buyThose'];
                ?>
            <form action="order.php" method="post"> <!--form for data: name, email, phone, comments -->
                <table>
                    <thead>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Your Order:</td>
                            <td> <b class="h2"><?php 
                            foreach ($buyThose as $prodNo):
                                echo $prodNo; ?> <br> <?php
                            endforeach;?> </b>
                            </td>
                        </tr>
                        <tr>
                            <td>Name:</td>
                            <td><input type="text" name="lname" placeholder="Last Name" required><br>
                            <input type="text" name="fname" placeholder="First Name" required><br></td>
                        </tr>                        
                        <tr>
                            <td>Telephone:</td>
                            <td><input type="tel" name="number" placeholder="0123 4567890" required><br></td>
                        </tr>               
                        <tr>
                            <td>eMail:</td>
                            <td><input type="email" name="mail" placeholder="example@crusaders.network" required><br><td>
                        </tr>                        
                        <tr>
                            <td>Message:</td>
                            <td><textarea name="comments" rows="15" cols="29" placeholder="Any other questions? Something weighing on that heart of yours? Tell us."></textarea><br></td>
                        </tr>
                        <tr>
                            <td></td> <!--on click: go to order.php, pass user data -->
                            <td><button type="submit" class="smallbutton" style="float:right" value="send">send</button></td>
                        </tr>
                    <tbody>
                </table>
            </form>
            <?php
            } else { ?> <!--if no value passed by POST, do nothing and print text
            <h1><?= "No items found. How did you get here?" ?></h1><?php
            }
        ?>
        </div>
    </section>
    <footer>
        <?php include_once("footer.php"); ?>
    </footer>
</body>
