<?php 

    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
    
    echo $id . ' ' . $quantity;

    $conn = mysqli_connect("localhost","root");
    $db = mysqli_select_db($conn,"addcart");

    $query = "INSERT INTO addcart (ID,QUANTITY) VALUE ($id,$quantity)";

    // checks for connection error
    if(!$conn){
        die("connection failed: " . mysqli_connect_error());
    }

    $retVal = mysqli_query($conn,$query) or die( mysqli_error($conn));


?>