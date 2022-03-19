<?php
$prodNames = [];
$prodPrice = [];
$prodNames = [];
$prodDesc = [];
$prodImage = [];

$conn = mysqli_connect("localhost","root");
// checks for connection error
if(!$conn){
    die("connection failed: " . mysqli_connect_error());
}

$db = mysqli_select_db($conn,"products");
$sql = 'SELECT * FROM product';
$retVal = mysqli_query($conn,$sql) or die( mysqli_error($conn));


while($row = mysqli_fetch_array($retVal, MYSQLI_BOTH)){
    array_push($prodNames, $row[1]);
    array_push($prodDesc, $row[2]);
    array_push($prodImage, $row[3]);
    array_push($prodPrice, $row[4]);

}

mysqli_free_result($retVal);
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/14fa44cb08.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="styles.css" rel="stylesheet" type="text/css"/>
    <script
          src="https://code.jquery.com/jquery-3.4.1.min.js"
          integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
          crossorigin="anonymous"></script>
   

</head>
<body>

    <nav class="navbar ">
        <div class="logo">
            
            <h4>Online Shopping</h4>
        </div>
        <div class="container">
            <ul class="nav-links">
                <li class="">
                    <a href="index.html" class="">Home</a>
                </li>

                <li class="">
                    <a href="shop.html" class="">Shop</a>
                </li>

                <li class="">
                    <a href="projects.html" class="">Checkout</a>
                </li>

            </ul>
            <div class="bg"></div>
            
        </div>
    </nav>

    <script type="text/Javascript">
       
        var quantity;
        var id;

        function quantityChange(inp){
          
            //var inp = document.getElementsByName("quantity").value;
            quantity = inp;
        }

        function addCart(ev){
            
            id = ev;
            alert('id: ' + id +' quantity: ' + quantity)
            
            fetch("addCart.php", {method: "POST", body: {id: id, quantity: quantity}})
            .then(res => res.text())
            .then((text) =>{
                console.log(text);
            })
            .catch((err) => {console.error(err);});

        }
        
        

    </script>



    <div class="content">
        <!-- Prints out products -->
        <div class="grid">
        <?php 
            $arrLength = count($prodNames);
            $i = 0;
            while($i < $arrLength){
                echo('
                <div class="prod">
                <h3 class="">'. $prodNames[$i] .'</h3>
                <img alt='. $prodImage[$i] .'>
                <p>'. $prodDesc[$i] .'</p>
                <p>$'. $prodPrice[$i] .'</p>
                <button onClick=addCart('.$i.')>Add to cart</button> 
                <select name="quantity" onchange="quantityChange(this.options[this.selectedIndex].value)">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                </div>');
                $i++;
            }      
        ?>
        </div>
    </div>



    
    
</body>
</html>