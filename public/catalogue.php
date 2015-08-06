<?

    $styleSheets = ["catalogue"];
    $pageTitle = "Catalogue";
    include ('php/modules/_header.php');
?>

    <main class="container">
        
        <!-- Filters -->
        <section id="filters">
        
            <div class="filter">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    POPULAR
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="#">RANDOM</a></li>
                    <li><a href="#">NEW</a></li>
                  </ul>
                </div> 
            </div><!-- end of filter -->
          
            <div class="filter margin-corection">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    ARTIST
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <? 
                        $query = "SELECT id, artistName FROM artist WHERE visible = 1 AND pinned = 1";    
                        $result  = queryDB($query);
                        while($row = mysqli_fetch_assoc($result)){
                            echo '<li><a href="catalogue.php?artist='.$row['id'].'">'.strtoupper($row['artistName']).'</a></li>';
                        }
                        
                        mysqli_free_result($result);
                        
                    ?>
                    <li role="separator" class="divider"></li>
                     <? 
                        $query = "SELECT id, artistName FROM artist WHERE visible = 1 AND pinned IS NULL";    
                        $result  = queryDB($query);
                        while($row = mysqli_fetch_assoc($result)){
                            echo '<li><a href="catalogue.php?artist='.$row['id'].'">'.strtoupper($row['artistName']).'</a></li>';
                        }
                        
                        mysqli_free_result($result);
                        
                    ?>  
                  </ul>
                </div>   
            </div><!-- end of filter -->    
            
            
            <div class="filter margin-corection">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Search</button>
              </span>
            </div><!-- /input-group -->
            </div> <!-- end of filter -->    

            
        
        
        </section>
        
        
        <!-- Results -->
        <section class="row">
         
        <?  
             

            $query = "SELECT * FROM product as p
                        INNER JOIN productTemplate as pt
                        ON p.productTemplate_id = pt.id
                        WHERE 
                        p.visible IS NOT NULL 
                        AND pt.visable IS NOT NULL
                        ORDER BY p.newFlag DESC, p.displayPriority
                        LIMIT 30 OFFSET 0";

            $productResult  = queryDB($query);

             while($row = mysqli_fetch_assoc($productResult)){
                $productsToDisplay[$row['id']]['id'] = $row['id'];     
                $productsToDisplay[$row['id']]['productName'] = $row['productName'];
                $productsToDisplay[$row['id']]['price'] = $row['surcharge']+$row['basePrice'];
                $productsToDisplay[$row['id']]['newFlag'] = $row['newFlag'];
                $productsToDisplay[$row['id']]['artist_id'] = $row['artist_id'];

            }
      
      
            foreach ($productsToDisplay as $value){
                
                echo displayProduct($value);
            }
            
            mysqli_free_result($productResult);
        
        ?>      
        
        </section>
        
        
    
    </main>
  
<? include('php/modules/_footer.php'); ?>