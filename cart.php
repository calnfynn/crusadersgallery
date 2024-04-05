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
    <title>Cart</title>
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

            if (isset($_POST['add_to_cart'])): //if value received through POST is to be added to cart, assign to $productId
                $productId = $_POST['products_id'];

                if (!in_array($productId, $_SESSION['cart'])): //if value not yet in array of items in cart, push in
                    array_push($_SESSION['cart'], $productId);
                endif;
            endif;

            if (isset($_POST['remove_from_cart'])): //if POST value is to be removed from cart, assign to $toRemove
                $toRemove = $_POST['to_remove'];

                $_SESSION['cart'] = array_diff($_SESSION['cart'], array($toRemove)); //if value found in cart, take out
                                                        //-> return the difference between current array & $toRemove

            endif;

            
            $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : []; //if SESSION[cart] not set, initialise as empty array
                             //already done in session.php, thus superflous. but leaving it in anyways just to be sure

            $total = 0;
            $buyThose = array();
            $ids = array();

            // Retrieve product data for the cart items if cart isn't empty
            if (!empty($cartItems)){ ?>
            <table>
                <thead>
                    <tr class="h1">
                        <th> </th>
                        <th>Title</th>
                        <th>Artist</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody><?php
            
                foreach ($cartItems as $productId):  //loops through cart array and gets all associated data for each element
                                                    //then prints into a table
                    $query = "SELECT * FROM products LEFT JOIN artist ON products.artist = artist.id LEFT JOIN img ON products.id = img.id WHERE products.id = {$productId}";
                    $products = get_products($query);
    
                    while ($product = $products->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><img class="small-image" src="./images/<?= $product['source'] ?>" alt=<?=$product['alt']?>></td> 
                        <td class="h2" style="text-align:right"><?= $product['title'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['price'] ?> €</td>
                        <td>
                            <form action="cart.php" method="post"> <!-- on click: reload page, delete item from cart -->
                                <input type="hidden" name="to_remove" value="<?=$product['id'] ?>">
                                <input type="submit" name="remove_from_cart" value="remove" class="microbutton">
                            </form>
                            <?php
                            array_push($buyThose, $product['title']); //array of titles of cart items
                            array_push($ids, $product['id']); //array of ids of cart items
                            $total += $product['price']; ?> <!-- total as int -->
                        </td> <?php
                    endwhile;
                endforeach; ?>
                    </tr>
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td>
                            <hr><b>total:</b><br><br><?=$total;?>.00 €<br><br>

                            <form action="checkout.php" method="post"> <!-- on click: go to checkout -->
                                <?php $_SESSION['buyThose'] = $buyThose;
                                $_SESSION['ids'] = $ids; ?>
                                <input type="submit" name="add_to_buy" class="smallbutton" value="go to checkout" >    
                            </form>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <?php              
            } else { ?> <!-- if cart empty: no action, just text -->
                <h1>Your cart is currently empty.</h1>
            <?php
            } ?>
        </div>
    </section> 
    <footer>
        <?php include_once("footer.php"); ?>
    </footer>
</body>
