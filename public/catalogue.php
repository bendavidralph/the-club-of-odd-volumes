<?php 

    $styleSheets = ["catalogue","catalogue-mobile"];
    $pageTitle = "Catalogue";
    $scripts = ["search"];
    include ('php/modules/_header.php');

    // Set the search filters 
    $filters = collectAndProccessFilters();

    define("LIMIT", 30);

   
?>

    <main class="container">
        
        <!-- Filters -->
        <section id="filters">
        
            <div class="filter">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <?php 
                            if(isset($_GET['sort']) && $_GET['sort'] == 'new'){
                                $displaySelectedSort = "Sort: <strong>NEW</strong>";
                            }else{
                                 $displaySelectedSort = "Sort: <strong>POPULAR</strong>";
                            }
                      ?>
                      <?php   echo $displaySelectedSort; ?>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                      <li><a href="catalogue.php?<?php   echo generateFilterURL('sort'); ?>">POPULAR</a></li>    
                      <li><a href="catalogue.php?sort=new<?php echo generateFilterURL('sort'); ?>">NEW</a></li>
                  </ul>
                </div> 
            </div><!-- end of filter -->
          
            <div class="filter margin-corection">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <?php      

                    if(isset($_GET['artist'])){
                    $artist = queryById('artist',$_GET['artist']);
                    $displaySelectedArtist = "Artist: <strong>" . $artist['artistName'] . "</strong>";
                    }else{
                        $displaySelectedArtist = "Artist: <strong>ALL</strong>";
                    }
       
                ?>
                    <?php   echo $displaySelectedArtist ?>  
                    <span class="caret"></span>
                  </button>   
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <li><a href="catalogue.php?<?php   echo generateFilterURL('artist');  ?>">ALL</a></li>
                       <li role="separator" class="divider"></li>
                    <?php   
                        $query = "SELECT id, artistName FROM artist WHERE visible = 1 AND pinned = 1";    
                        $result  = queryDB($query);
                        while($row = mysqli_fetch_assoc($result)){
                            echo '<li><a href="catalogue.php?artist='.$row['id'].generateFilterURL('artist').'">'.strtoupper($row['artistName']).'</a></li>';
                        }
                        
                        mysqli_free_result($result);
                        
                    ?>
                    <li role="separator" class="divider"></li>
                    <?php   
                        $query = "SELECT id, artistName FROM artist WHERE visible = 1 AND active = 1 AND pinned IS NULL ORDER BY artistName";    
                        $result  = queryDB($query);
                        while($row = mysqli_fetch_assoc($result)){
                            echo '<li><a href="catalogue.php?artist='.$row['id'].generateFilterURL('artist').'">'.strtoupper($row['artistName']).'</a></li>';
                        }
                        
                        mysqli_free_result($result);
                        
                    ?>  
                  </ul>
                </div>   
            </div><!-- end of filter -->    
            
            
            <div class="filter margin-corection">
            <div class="input-group">
              <input type="text" id="search-value" class="form-control" placeholder="Search for..." value="<?php echo $filters['searchQuery']; ?>">
              <span class="input-group-btn">
                <button id="search-trigger" class="btn btn-default" type="button">Search</button>
              </span>
            </div><!-- /input-group -->
            </div> <!-- end of filter -->    

            
        
        
        </section>
        
        
        <!-- Results -->
        <section class="row heightFixRow">
         
        <?php    

      

        if(isset($_GET['page']) && !(trim($_GET['page']) == '')){
            $offset = $_GET['page'] * LIMIT - LIMIT; 
            $activePage = $_GET['page'];
        }else{
            $activePage = 1;
            $offset = 0;
            
        }

        $selectedCat = $filters['category'];

        $query = "SELECT 
                        p.id as id,
                        p.productName as productName,
                        p.surcharge as surcharge,
                        pt.basePrice as basePrice, 
                        p.newFlag as newFlag, 
                        p.artist_id as artist_id,
                        pt.id as template_id
                        FROM product as p
                        INNER JOIN productTemplate as pt
                        ON p.productTemplate_id = pt.id
                        WHERE 
                        p.visible = 1 
                        AND pt.visable = 1
                        {$filters['category']}
                        {$filters['artist']}
                        {$filters['search']}
                        {$filters['sort']}
                        LIMIT ".LIMIT." OFFSET {$offset}";

            $productResult  = queryDB($query);

            if(mysqli_num_rows($productResult) >= 1){

                 while($row = mysqli_fetch_assoc($productResult)){
                    $productsToDisplay[$row['id']]['id'] = $row['id'];     
                    $productsToDisplay[$row['id']]['productName'] = $row['productName'];
                    $productsToDisplay[$row['id']]['price'] = $row['surcharge']+$row['basePrice'];
                    $productsToDisplay[$row['id']]['newFlag'] = $row['newFlag'];
                    $productsToDisplay[$row['id']]['artist_id'] = $row['artist_id'];
                    $productsToDisplay[$row['id']]['template_id'] = $row['template_id']; 

                }

                // Set counter for Ads
                $addCount = $offset;
           
                $selectedCat = str_replace("AND pt.category_id = ","",$selectedCat);
                
                foreach ($productsToDisplay as $value){
                    
                    
               
                    
                    $addCount ++;
                    
  
                    
                   
                        echo displayProduct($value);
             
                    
                    
                  
                   
                    
                }
               
            
            }else{
?>             
               
            <div id="no-results" >
                <h3>Whoops! There are no results for this search</h3>
                <p>Please try a different search</p>
            </div>
            
                
<?php 
            }
            
            mysqli_free_result($productResult);
        
        ?>      
        
        </section>
        
        
        <nav id="pagination-wrapper">
          <ul class="pagination">

              
<?php 

           $urlFilters = generateFilterURL('page');

           $query = "SELECT 
                        COUNT(p.id) as id
                        FROM product as p
                        INNER JOIN productTemplate as pt
                        ON p.productTemplate_id = pt.id
                        WHERE 
                        p.visible = 1 
                        AND pt.visable = 1
                        {$filters['category']}
                        {$filters['artist']}
                        {$filters['search']}
                        {$filters['sort']}";

            $paginationResult  = queryDB($query);
            
            while($row = mysqli_fetch_assoc($paginationResult)){
                   $count = $row['id'];
             }

            $count = ceil($count / LIMIT);

            if($count > 1){

                
                $countUp = 1;
                while($count > 0){
                    
                $lowerLimit = $activePage - 1;
                $upperLimit = $activePage + 1;
                    
                    
             
               
                  if($countUp == $activePage){
                      $active = "class='active'";   
                  }else{$active="";}
             
                  echo "<li {$active}><a href='catalogue.php?page={$countUp}{$urlFilters}'>{$countUp}</a></li>";
            
                    
                $countUp ++;        
                $count--;
                }
                
            }
?>

          </ul>
        </nav>
    
    </main>

<?php $scripts = ["catalogue"]; ?>
<?php   include('php/modules/_footer.php'); ?>
