<?
    // Test that a product id has been set
    if(isset($_GET['id']) && $_GET['id'] > 0){
            echo "ddsfsdfsf1";
            $id = $_GET['id'];    
    }else{
            header('Location: catalogue.php');      
    }

?>

<?
    $styleSheets = ["product"];
    $pageTitle = "____";
    include ('php/modules/_header.php');
?>
<main>
        
    <?
    // Get the Product Information 
    $query = "
        SELECT * FROM product AS p
        INNER JOIN productTemplate AS pt
        ON p.productTemplate_id = pt.id
        WHERE p.id = '".$id."'
        LIMIT 1
        ";
    
    $productResult = queryDB($query);
    
    while($row = mysqli_fetch_assoc($productResult)){
        echo '<pre>';
        var_dump($row);
        echo '</pre>';
        
        $template_id = $row['productTemplate_id'];
    }
    
    // Get the stock information 
     $query = "
        SELECT * FROM `stock` as s
        INNER JOIN templateStockIndex as tsi
        ON s.id = tsi.stock_id
        WHERE tsi.template_id = ".$template_id."
        AND inStock IS NOT NULL
        ";
    
    $productResult = queryDB($query);
    
    $count = 0;
    while($row = mysqli_fetch_assoc($productResult)){
        
        $color[] = $row["color"];
        $sizeCategory[] = $row["sizeCategory"];
        $stock[$count]["sizeCategory"] = $row["sizeCategory"];
        $stock[$count]["size"] = $row["size"];
        $stock[$count]["color"] = $row["color"];
        $stock[$count]["surcharge"] = $row["surcharge"];
        $stock[$count]["id"] = $row["id"];
        
        
        $count ++;
        
        
    }
            
    
    // remove the duplicates
    $color = array_unique($color);
    $sizeCategory = array_unique($sizeCategory);
   
    print_r($sizeCategory);

    ?>
    
    <!-- HTML -->
    <h3>Colour</h3>
    <div id="select-color-wrapper">
        <? foreach ($color as $value){
        echo '<div class="color-trigger '.$value.'">'.$value.'</div>';
        }
        ?>
    </div>
    
    <div class="add-size-wrapper">
        <?
        // split the size categories 
        foreach ($sizeCategory as $cat){
        echo '<h3>'.$cat.'</h3>';
            
                foreach ($stock as $value){
                    if($value["sizeCategory"] == $cat){ 
                        echo '<div id="'.$value['id'].'" class="size-trigger">';
                            echo '<div class="size cat'.$value['color'].'">'.$value['size'].'</div>';
                        echo '</div>';
                          
                    }
                }
            
            echo '<br><br>';
            
        } // end size cat 


     

        ?>
    
    
    </div>
    
    
    
</main>
  
<? include('php/modules/_footer.php'); ?>



