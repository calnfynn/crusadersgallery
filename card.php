<?php include_once("session.php");?>
<div class="h2"> <!--display all information associated with products passed by loop in products.php -->
  <hr><hr>
  <?= $row['title'] ?><br>&lpar;<?= $row['year_created']?>&rpar;
</div>
<div class="producttext" style="font-size: 15px;">
  by <?= $row['name'] ?>
  </br>
</div>
<img class="productimage" src="./images/<?= $row['source'] ?>" title="&apos;<?= $row['title']?>&apos;" alt="<?=$row['alt']?>" style="width: 100%; height: auto">
<div class="producttext">
  <hr>
  <?= $row['price'] ?> € <br>
</div>
<div>
  <form action="cart.php" method="post"> <!--on click: add item to cart, go to cart -->
    <input type="hidden" name="products_id" value="<?=$row['products_id'] ?>">
    <input type="submit" name="add_to_cart" value="add to cart" class="smallbutton">
  </form>
  <form action="details.php" method="post"> <!--on click: open details.php for specified item -->
    <input type="hidden" name="products_id" value="<?=$row['products_id'] ?>">
    <input type="submit" name="show_details" value="details" class="smallbutton">
  </form>
</div>