<main  class="container-fluid">
    
    <h1><?php echo ucwords($table);?></h1>
    
       <ol class="breadcrumb">
           <li class="active"><a href="../admin/">Home</a></td>
    
        <li><?php echo ucwords($table);?></li>
        </ol>

    
<div class="table">

    <div class="header-row tr">
        <?php    
        
    

       
        
        // Print out a list 
        foreach($columnTitles as $value){
            echo "<span class='td'>".$value."</span>";   
        }
                    
        ?>

    
    </div>

   
 
      <?php 


        // select all values in the table
        $query = "SELECT ".
        $query = "*".
        $query = " FROM " . $table;

        $result  = queryDB($query);

        while($row = mysqli_fetch_assoc($result)){

                echo "<form id='{$row["id"]}' class='update tr'>";
           
                foreach($columns as $key => $value){
                    
                  switch ($value) {
                    
                        case "auto":
                        
                             echo createTextBoxElement("text",$key,$row[$key]);  
                            
                        break;
                        case "text":
                    
                             echo createTextBoxElement("text",$key,$row[$key]);  
                            
                        break;
                        case "toggle":
                       
                            echo createCheckBoxElement($row[$key],$key);
                            
                        break;
                        case "select":
                        
                            echo createSelectElement($list[$key],$key,$row[$key]);
                            
                        break;    
                        case "number":
                        
                              echo createTextBoxElement("number",$key,$row[$key]); 
                            
                        break;        
                            

                       
                }
                    
                    
                    
                }

                echo "<div class='delete'>DELETE</div>";
                echo "</form>";

            
        }
        
        mysqli_free_result($result);

        ?>
        
      
            <form class="insert tr">
           
            
                <?php 

                foreach($columns as $key => $value){
                 
                    switch ($value) {
                    
                        case "auto":
                        
                             echo createTextBoxElement("text",$key,$row[$key]);  
                            
                        break;
                        case "text":
                    
                             echo createTextBoxElement("text",$key,$row[$key]);  
                            
                        break;
                        case "toggle":
                       
                            echo createCheckBoxElement($row[$key],$key);
                            
                        break;
                        case "select":
                        
                            echo createSelectElement($list[$key],$key,$row[$key]);
                            
                        break;    
                        case "number":
                            
                            echo createTextBoxElement("text",$key,$row[$key]); 
                            
                        break;        
                            

                }

                    
                }
                
             

                ?> 
            <input type="submit" id="add-row" class="" value="+">   
            </form>
        
</div>

<div id="results"></div>
        
</main>