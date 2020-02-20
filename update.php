<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Update Me Now!</title>
</head>

<body>
	<?php
	//Store the info in variables.
	$reviewer_name = filter_input(INPUT_POST, 'name');
	$reviewer_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$book_title = filter_input(INPUT_POST, 'book');
	$book_genre = filter_input(INPUT_POST, 'genre');
	$book_review = filter_input(INPUT_POST, 'review');
	$book_link = filter_input(INPUT_POST, 'booklink');
	$book_img = $_FILES['photo']['name'];
	$book_id = $_GET['book_id'];

	//Flag variable.
	$ok = true;

	if(empty($reviewer_name))
	{
		//Connect this b word.
		$conn = new PDO("mysql:host=localhost; dbname=comp1006", 'root', '');

		//Set up dat query.
		$sql= "SELECT reviewer_name FROM books WHERE book_id = :book_id";

		//Prep time!
		$cmd= $conn->prepare($sql);

		//Time to get bouuuuund
		$cmd->bindParam(':book_id', $book_id, PDO::PARAM_INT);

		//Execute(but not the bad one)
		$cmd->execute();

		$books= $cmd->fetchAll();
		foreach($books as $book)
		{
			$reviewer_name= $book['reviewer_name'];
		}

		//Close me up
		$conn= NULL;
	}
	if(empty($reviewer_email))
	{
		//Connect this b word.
		$conn = new PDO("mysql:host=localhost; dbname=comp1006", 'root', '');

		//Set up dat query.
		$sql= "SELECT reviewer_email FROM books WHERE book_id = :book_id";

		//Prep time!
		$cmd= $conn->prepare($sql);

		//Time to get bouuuuund
		$cmd->bindParam(':book_id', $book_id, PDO::PARAM_INT);

		//Execute(but not the bad one)
		$cmd->execute();

		$books= $cmd->fetchAll();
		foreach($books as $book)
		{
			$reviewer_email= $book['reviewer_email'];
		}

		//Close me up
		$conn= NULL;
	}
	if(empty($book_title))
	{
		//Connect this b word.
		$conn = new PDO("mysql:host=localhost; dbname=comp1006", 'root', '');

		//Set up dat query.
		$sql= "SELECT book_title FROM books WHERE book_id = :book_id";

		//Prep time!
		$cmd= $conn->prepare($sql);

		//Time to get bouuuuund
		$cmd->bindParam(':book_id', $book_id, PDO::PARAM_INT);

		//Execute(but not the bad one)
		$cmd->execute();

		$books= $cmd->fetchAll();
		foreach($books as $book)
		{
			$book_title= $book['book_title'];
		}

		//Close me up
		$conn= NULL;
	}
	if(empty($book_genre))
	{
		//Connect this b word.
		$conn = new PDO("mysql:host=localhost; dbname=comp1006", 'root', '');

		//Set up dat query.
		$sql= "SELECT book_genre FROM books WHERE book_id = :book_id";

		//Prep time!
		$cmd= $conn->prepare($sql);

		//Time to get bouuuuund
		$cmd->bindParam(':book_id', $book_id, PDO::PARAM_INT);

		//Execute(but not the bad one)
		$cmd->execute();

		$books= $cmd->fetchAll();
		foreach($books as $book)
		{
			$book_genre= $book['book_genre'];
		}

		//Close me up
		$conn= NULL;
	}
	if(empty($book_review))
	{
		//Connect this b word.
		$conn = new PDO("mysql:host=localhost; dbname=comp1006", 'root', '');

		//Set up dat query.
		$sql= "SELECT book_review FROM books WHERE book_id = :book_id";

		//Prep time!
		$cmd= $conn->prepare($sql);

		//Time to get bouuuuund
		$cmd->bindParam(':book_id', $book_id, PDO::PARAM_INT);

		//Execute(but not the bad one)
		$cmd->execute();

		$books= $cmd->fetchAll();
		foreach($books as $book)
		{
			$book_review= $book['book_review'];
		}

		//Close me up
		$conn= NULL;
	}
	if(empty($book_link))
	{
		//Connect this b word.
		$conn = new PDO("mysql:host=localhost; dbname=comp1006", 'root', '');

		//Set up dat query.
		$sql= "SELECT book_link FROM books WHERE book_id = :book_id";

		//Prep time!
		$cmd= $conn->prepare($sql);

		//Time to get bouuuuund
		$cmd->bindParam(':book_id', $book_id, PDO::PARAM_INT);

		//Execute(but not the bad one)
		$cmd->execute();

		$books= $cmd->fetchAll();
		foreach($books as $book)
		{
			$book_link= $book['book_link'];
		}

		//Close me up
		$conn= NULL;
	}
	if(empty($book_img))
	{
		//Connect this b word.
		$conn = new PDO("mysql:host=localhost; dbname=comp1006", 'root', '');

		//Set up dat query.
		$sql= "SELECT book_img FROM books WHERE book_id = :book_id";

		//Prep time!
		$cmd= $conn->prepare($sql);

		//Time to get bouuuuund
		$cmd->bindParam(':book_id', $book_id, PDO::PARAM_INT);

		//Execute(but not the bad one)
		$cmd->execute();

		$books= $cmd->fetchAll();
		foreach($books as $book)
		{
			$book_img= $book['book_img'];
		}

		//Close me up
		$conn= NULL;
	}

	if($ok === true)
	{
		//Connect to our database.
		$conn = new PDO("mysql:host=localhost; dbname=comp1006", 'root', '');

		//Set up SQL query
		$sql = "UPDATE books SET book_title= :book_title, book_genre= :book_genre, book_review= :book_review, reviewer_name = :reviewer_name,
				reviewer_email = :reviewer_email, book_link = :book_link, book_img = :book_img WHERE book_id= :id";

		//Prepare the query.
		$cmd = $conn->prepare($sql);

		//Bind the parameters.
		$cmd->bindParam(':book_title', $book_title);
		$cmd->bindParam(':book_genre', $book_genre);
		$cmd->bindParam(':book_review', $book_review);
		$cmd->bindParam(':reviewer_name', $reviewer_name);
		$cmd->bindParam(':reviewer_email', $reviewer_email);
		$cmd->bindParam(':book_link', $book_link);
		$cmd->bindParam(':book_img', $book_img);

		//Execute the query.
		$cmd->execute();

		//Close the db (not required, but best practice)
		$cmd->closeCursor();

		//Send back to admin page.
		header('location:admin.php');
		ob_flush();
	}
	else
	{
		echo "<a href='updateform.php?book_id=" . $book_id . "'> Try Again </a>";
	}
	?>
</body>

</html>