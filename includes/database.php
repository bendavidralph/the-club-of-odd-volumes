
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



?>



