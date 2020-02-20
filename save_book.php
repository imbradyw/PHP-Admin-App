<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Save Book</title>
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

	//If the user puts in a name of admin than it will bring them to the admin page.
	if(strtolower($reviewer_name) == "admin")
	{
		header('location:admin.php');
		ob_flush();
	}
	else
	{
		//Set definitions
		require('defined.php');

		//Use $_FILES to grab the image info.
		$photo = $_FILES['photo']['name'];
		$photo_type = $_FILES['photo']['type'];
		$photo_size = $_FILES['photo']['size'];

		//Setup a flag variable.
		$ok = true;

		//Form validation.
		if(empty($reviewer_name))
		{
			echo "<p> Name is required. </p>";
			$ok= false;
		}
		if(empty($reviewer_email))
		{
			echo "<p> Email is required. </p>";
			$ok= false;
		}
		if(empty($book_title))
		{
			echo "<p> Book is required. </p>";
			$ok= false;
		}
		if(empty($book_genre))
		{
			echo "<p> Genre is required. </p>";
			$ok= false;
		}
		if(empty($book_review))
		{
			echo "<p> Review is required. </p>";
			$ok= false;
		}
		if(empty($book_link))
		{
			echo "<p> A link is required. </p>";
			$ok= false;
		}
		if(empty($_FILES['photo']['name']))
		{
			echo "<p> An image is required. </p>";
			$ok= false;
		}
		else
		{
			if(!(($photo_type == 'image/gif') || ($photo_type == 'image/jpg') || ($photo_type == 'image/jpeg') || ($photo_type == 'image/png')) && !($photo_size > 0) && !($photo_size <= MAXFILESIZE))
			{
				$ok= false;
			}
			else
			{
				if(!($_FILES['photo']['error'] == 0))
				{
					$ok = false;
				}
				else
				{
					$target = UPLOADPATH . $photo;
					if(move_uploaded_file($_FILES['photo']['tmp_name'], $target));
				}
			}
		}

		//Email validation.
		if($reviewer_email === FALSE)
		{
			echo "<p> Email is not valid </p>";
			$ok = false;
		}

		if($ok === TRUE)
		{
			//Connect to our database.
			require('db.php');

			//Set up SQL query
			$sql = "INSERT INTO books (book_title, book_genre, book_review, reviewer_name, reviewer_email, book_link, book_img) VALUES(:book_title, :book_genre, :book_review, 																															:reviewer_name, :reviewer_email, 																																:book_link, :book_img)";

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

			//Send user to the list of books.
			header('location:books.php');
			ob_flush();
		}
	}
	?>
</body>

</html>