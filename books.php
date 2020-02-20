<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>OUR MOOOOOVIES!</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="main.css"/>

</head>

<body>
	<div class= "container">
		<h1>The Ultimate List of the Most Awesome Books Ever</h1>
		<a href="index.php"> Add Anotha One</a>

		<?php
		//Access the database.
		require('db.php');
		require('defined.php');

		//Set up our SQL query.
		$sql = "SELECT * FROM books";

		//Prepare the biatch.
		$cmd = $conn->prepare($sql);

		//Run that query.
		$cmd->execute();

		//Use fetchAll (even though it'll never be a thing) to store results.
		$books = $cmd->fetchAll();

		echo 
		'<table class= "table table-striped">
			<thead>
				<th> Name </th>
				<th> Email</th>
				<th> Book </th>
				<th> Genre </th>
				<th> Review </th>
				<th> Link </th>
				<th> Photo </th>
			</thead>

			<tbody>';

			//Loop through the data and create a new table row for each record.

			foreach ($books as $book)
			{
				echo
				'<tr><td>' . $book['reviewer_name'] . '</td><td>' . $book['reviewer_email'] . '</td><td>' . $book['book_title'] . '</td><td>' . $book['book_genre'] . '</td><td>' . $book['book_review'] . '</td><td>' . $book['book_link'] . '</td><td><div id="imgbox"><img class="myimg" src="' . UPLOADPATH . $book['book_img'] . '" alt = "User Image"/></div></td></tr>';
			}

			echo '</tbody></table>';

			//Close the database connection.
			$conn = NULL;
		?>
	</div>
</body>

</html>