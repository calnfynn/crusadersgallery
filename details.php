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
    <meta name="author" content="Anna Rahr, 1583353">
    <title>Details</title>
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
        <div>
        <?php 
            include_once('connection.php'); //connects SQL-DB
            include_once('session.php'); //starts SESSION


            $detItems = isset($_POST['products_id']) ? $_POST['products_id'] : [];

            $sql = "SELECT products.id AS prod_id, products.*, artist.*, artist.description AS artistdesc, medium.materials, style.style_name, img.* 
            FROM products 
            LEFT JOIN artist ON products.artist = artist.id 
            LEFT JOIN medium ON products.medium = medium.id 
            LEFT JOIN style ON products.style = style.id 
            LEFT JOIN img ON products.id = img.id 
            WHERE products.id = {$detItems}";

            $prod = get_products($sql); //retrieve data from multiple tables. 
                                //only for elements in array that was passed by card.php

            $product = $prod->fetch(PDO::FETCH_ASSOC) ?> <!--display data -->
            <h1><u><?php echo $product['title']; ?></u></h1><br>
            <p class="details">
                by <?=$product['name']?> &lpar;*<?=$product['birthyear']?>&rpar;
            </p><br>
            <img style="margin-right:auto; margin-left:auto; display:block; height:auto; width:50%;" src="./images/<?= $product['source'] ?>" title="&apos;<?= $product['title']?>&apos;" alt="<?=$product['alt']?>"><br>
            <p class="details">
                <b>Size:</b> <?=$product['size']?>cm<br><br>
                <b>Materials:</b> <?=$product['materials']?><br><br>
                <b>Style:</b> <?=$product['style_name']?><br><br>
                <b>About the Artist:</b> <?=$product['artistdesc']?><br>
            </p>                  
        </div>
    </section>
    <footer>
        <?php include_once("footer.php"); ?>
    </footer>
</body>