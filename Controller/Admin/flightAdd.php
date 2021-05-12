<?php 

include_once '../../Model/db.php';
 


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $takeoff = test_input($_POST["takeoff"]);
        $landing = test_input($_POST["landing"]);
        $departure = test_input($_POST["departure"]);  
        //echo "date is". $departure;    
                
    }
    function test_input($data){
        $data = trim($data);
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    
    if(isset($_POST['submit'])){
        if(empty($_POST["takeoff"])){
            echo "Takeoff is required";
        }
        elseif(empty($_POST["landing"])){
            echo "Landing is required";
        }
        elseif(empty($_POST["departure"])){
            echo "departure is required";
        }
        
        else{
            $takeoff = $_POST["takeoff"];
            $landing = $_POST["landing"];
            $departure = $_POST["departure"];
            header('location: ../../View/Admin/flights.php');   
            //echo $takeoff. "---" . $landing. "--". $departure;           
            addFlight($takeoff, $landing, $departure); 
            echo "<meta http-equiv='refresh' content='0'>"; 
            
            
            
                
        }
    }
    
    





?>
