<?php

$book_id = $_GET['book_id'];

//Connect this b word.
$conn = new PDO("mysql:host=localhost; dbname=comp1006", 'root', '');

//Set up dat query.
$sql= "DELETE FROM books WHERE book_id = :book_id";

//Prep time!
$cmd= $conn->prepare($sql);

//Time to get bouuuuund
$cmd->bindParam(':book_id', $book_id, PDO::PARAM_INT);

//Execute(but not the bad one)
$cmd->execute();

//Close me up
$conn= NULL;

//Send back to admin page.
header('location:admin.php');
ob_flush();


?>