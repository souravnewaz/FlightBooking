<?php
include "../Model/db.php";

$name="";
$password = ""; 

if ($_SERVER["REQUEST_METHOD"] =="POST"){
    $name = test_input($_POST["name"]);
    $password = test_input($_POST["password"]);
}
    

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    if(isset($_POST['submit'])){
       if (empty($_POST["name"])) {
            echo "Name is required";
        }
        elseif(empty($_POST["password"])){
            echo "Password is required";
        }
        else{ 
            $name = $_POST["name"];
            $password = $_POST["password"];
            if(login($name, $password)==1){
                echo "Login successful";
                header('Location: User/home.php');
                session_start();
                $_SESSION['name']= $name;
                
            } else if(adminLogin($name, $password)==1){
                echo "Login successful";
                header('Location: Admin/home.php');
                session_start();
                $_SESSION['name']= $name;
                 
                //echo gettype($password);
            } else {
                echo "login failed <br> ";
            }
            
        }
        
        //echo check($name, $password);
        
    }

?>