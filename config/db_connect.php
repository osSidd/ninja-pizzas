<?php

$conn = mysqli_connect('localhost', 'shaun', 'test123456789', 'ninja_pizza');

//check connection
if(!$conn){
    echo 'Connection error ' . mysqli_connect_error();
}

?>