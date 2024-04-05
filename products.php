<div>    
    <?php include_once 'connection.php'; //connects SQL-DB
        include_once 'session.php'; //starts SESSION
    ?> 
    
    <div class="products-container" style="display: grid; grid-template-columns: repeat(3, 1fr); width: 100%;">
        <?php 
        $sql = "SELECT products.id AS products_id, products.*, artist.id as artist_id, artist.*, img.* FROM products LEFT JOIN artist ON products.artist = artist.id LEFT JOIN img ON products.id = img.id WHERE products.availability = 1";
        $result = get_products($sql); ?> <!--retrieve data from DB -->
        <?php while($row = $result->fetch()):?> <!--loop for as long as DB rows are being retrieved -->
            <div class="product" style="float: left; text-align:center; padding: 5px;">
                <?php include 'card.php'?>
            </div>
        <?php endwhile;?>
    </div>
</div>
