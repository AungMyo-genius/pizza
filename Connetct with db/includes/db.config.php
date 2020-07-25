<?php

    $conn = mysqli_connect('localhost', 'root', '', 'aung_pizza');
    
    if(!$conn) {
        echo "Connection error:" . mysqli_connect_error();
    }

?>
