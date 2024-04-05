<div id="navwrapper" style="text-align: center">

     <?php //determines current page
        $activePage = basename($_SERVER['PHP_SELF'], ".php"); 
     ?>                                     <!-- if current page is '': class is '', else class is '' -->
         <a href="./index.php" class="<?= ($activePage == 'index') ? 'activebutton':'inactivebutton'; ?>">products</a>
         <a href="./cart.php" class="<?= ($activePage == 'cart') ? 'activebutton':'inactivebutton'; ?> .cart-button">cart</a>
         <a href="./downloads.php" class="<?= ($activePage == 'downloads') ? 'activebutton':'inactivebutton'; ?>">downloads</a>
         <a href="./aboutus.php" class="<?= ($activePage == 'aboutus') ? 'activebutton':'inactivebutton'; ?>">about us</a>   
</div>
