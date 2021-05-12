<?php
include '../Model/db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $phone = test_input($_POST["phone"]);
    $address = test_input($_POST["address"]);
    $password = test_input($_POST["password"]);
}

function test_input($data){
    $data = trim($data);
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST['submit'])){
    if(empty($_POST["name"])){
        echo "name is required";
    }
    elseif(empty($_POST["email"])){
        echo "email is required";
    }
    elseif(empty($_POST["phone"])){
        echo "phone is required";
    }
    elseif(empty($_POST["address"])){
        echo "address is required";
    }
    elseif(empty($_POST["password"])){
        echo "password is required";
    }
    elseif(empty($_POST["password2"])){
        echo "confirm your password";
    }
    else{
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        if($password != $password2){
            echo "Password does not match";
        } else{
            signup($name, $email, $phone, $address, $password);
        }
        
        
    }
}

?>