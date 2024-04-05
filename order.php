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
    <title>Thank You!</title>
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
 
            if(isset($_SESSION['buyThose'])) { //if value passed by SESSION, assign to $buyThose & $ids
                $buyThose = $_SESSION['buyThose'];
                $prod_bought = array();
                $ids = $_SESSION['ids'];
                ?>
            <h1>Thank you for your order! We will contact you shortly.</h1> 
                <?php
                    foreach ($ids as $id): //loop through passed IDs, set int availability to 0 for associated items
                        $query_update = "UPDATE products SET products.availability = 0 WHERE products.id = {$id}";
                        get_products($query_update);
                    endforeach;


                    $names = $db->quote(implode(', ', array($_POST['lname'], $_POST['fname']))); //implode to turn array into string
                    $buyThose = $db->quote(implode(', ', $_SESSION['buyThose']));              //quote to sanitize data
                    $tel = $db->quote($_POST['number']);
                    $mail = $db->quote(($_POST['mail']));
                    if (!empty($_POST['comments'])) { //if comments were entered into form on checkout.php, include them in query
                        $comm = $db->quote($_POST['comments']);
                        $query_insert = "INSERT INTO orders (product_names, names, phone, mail, comments) VALUES ({$buyThose}, {$names}, {$tel}, {$mail}, {$comm})";
                    } else { //no comments, don't include in query
                        $query_insert = "INSERT INTO orders (product_names, names, phone, mail) VALUES ({$buyThose}, {$names}, {$tel}, {$mail})";
                    }
                    
                    $db->query($query_insert); ?> <!--insert data from above into table 'orders'

            <?php
            } else { ?> //if no values passed through SESSION, do nothing and display error 
            <h1><?= "Something went wrong. Please try again." ?></h1><?php 
            }
            session_destroy(); //clear all SESSIONS
            ?>
        </div>
    </section>
    <footer>
        <?php include_once("footer.php"); ?>
    </footer>
</body>
