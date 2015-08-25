
<?php  

    // 1. Create a databsae connection 
    function createDBConnection(){
        
        $dbshost = "localhost";
        $dbuser = "root";
        $dbpass = "root";
        $dbname = "theclubofoddvolumes";
        $db = mysqli_connect($dbshost,$dbuser,$dbpass,$dbname);

        if(mysqli_connect_errno()){
            die("Database connection failed: ".
                mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")"
                );
        }else{
         
            return $db;
            
        }
        
    }

    function queryDB($query){
        
        $db = createDBConnection();
        
        $result = mysqli_query($db,$query);

        if(!$result){
            die("Databse query failed");
        }else{
            
            return $result;   
        }
        
        mysqli_close($db);
    }

    
    

    
    function cleanText($text){
        
        $db = createDBConnection();
        return mysqli_real_escape_string($db,$text);
        
    }

    // Select every value of a single column and index it by the row ID
    function queryDBIndexByID($select,$table){
           $query = "SELECT ".
            $query = "id, {$select}".
            $query = " FROM ".
            $query = $table.
            $query =" ORDER BY ".$select;   

            $result = queryDB($query);

            while($row = mysqli_fetch_assoc($result)){

                $returnArray[$row["id"]]=$row[$select];
            }

            mysqli_free_result($result);
        
            return  $returnArray;
    }

    
//#############  INSERT   ###################################

    function insert_DB($table,$insertValues){
        
            
            // find columns
            $count = 0;
            foreach ($insertValues as $key => $value){
                if($count >=1){
                    $columns = $columns . "," . cleanText($key);
                }else{
                    $columns = cleanText($key);
                }
                $count++;
            }
        
            $count = 0;
            foreach ($insertValues as $value){
                if($count >= 1){
                    if(gettype($value) == "string" && !($value == "NULL")){
                    $values = $values . ",". "'".cleanText($value)."'";
                    }else{
                    $values = $values . ",". cleanText($value);   
                    }
                }else{
                    if(gettype($value) == "string" && !($value == "NULL")){
                    $values = "'".cleanText($value)."'";
                    }else{
                    $values = cleanText($value);   
                    }
                }
                
                $count++;
            }
        
          echo  $query = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
            $db = createDBConnection();
        
            $result = mysqli_query($db,$query);

        if(!$result){
            echo mysqli_error($db). "<br>";
            die("Databse query failed");
            
        }else{
            return mysqli_insert_id($db);
        }
        
        mysqli_close($db);
            
        
    }


//#############  UPDATE   ###################################

function update_DB($table,$updateValues,$id){
        
            $count = 0;
            $update = "";
            foreach($updateValues as $key => $value){
                if($count >=1){
                    $update = $update . ", {$key }= '{$value}'";
                }else{
                    $update = $update . "{$key }= '{$value}'";
                }
                $count++;
            }
            
        
            $query = "UPDATE {$table} SET {$update} WHERE id = {$id}";
            $db = createDBConnection();
        
            $result = mysqli_query($db,$query);

       if(!$result){
            echo mysqli_error($db). "<br>";
            die("Databse query failed");
            
        }
        
        mysqli_close($db);
            
        
    }

//#############  DELETE    ###################################

function deleteRow($table,$id){
    
    $query = "DELETE FROM {$table} WHERE id={$id}";
    
     $db = createDBConnection();
        
     $result = mysqli_query($db,$query);

       if(!$result){
            echo mysqli_error($db). "<br>";
            die("Databse query failed");
            
        }
        
        mysqli_close($db);
    
    
}

?>

<?php 

// HINTS

//   while($row = mysqli_fetch_assoc($results)){
//          
//   }
//      

//   mysqli_free_result($productResult);
?>