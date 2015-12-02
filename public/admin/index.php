<?php 
    $styleSheets = ["index"];
    $pageTitle = "Site Admin";
    include ('php/modules/_header.php');
?>

<main>
    
    <ul>
        <li><a href="product.php">Product</a></li>
        <li><a href="artist.php">Artist</a></li>
        <li><a href="design.php">Design</a></li>
        <li><a href="product-template.php">Product Template</a></li>
        <li><a href="stock.php">Stock Item</a></li>
        <li><a href="stock-custom.php">Custom Stock Item</a></li>
        <li><a href="assign-stock-to-product-template.php">Assign Stock to a Product Template</a></li>
        <li><a href="shipping.php">Shipping</a></li>
        <li><a href="add-reseller.php">Add Reseller</a></li>
        <li><a href="discount-codes.php">Discount Code</a></li>
        <li><a href="templateStockIndex.php">Connect Stock to templates</a></li>
        <li><a href="slider.php">Update Home Page Slider Links</a></li>
        
    </ul>
    
        
</main>
  
<?php   include('php/modules/_footer.php'); ?>