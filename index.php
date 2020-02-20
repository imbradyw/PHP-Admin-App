<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title>This is PHP!</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>

<body>
<?php
$book_id = null;
$book_title = null;
$book_genre = null;
$book_review = null;
$reviewer_name = null;
$reviewer_email = null;
$book_link = null;
$book_img = null;

if(!empty($_GET['book_id']) && (is_numeric($_GET['book_id'])))
{
	//Grab movie ID from the URL string.
	$book_id = $_GET['book_id'];
	require('db.php');
	//Set up dat query.
	$sql= "SELECT * FROM books WHERE book_id = :book_id";

	//Prep time!
	$cmd= $conn->prepare($sql);

	//Time to get bouuuuund
	$cmd->bindParam(':book_id', $book_id, PDO::PARAM_INT);

	//Execute(but not the bad one)
	$cmd->execute();

	$books = $cmd->fetchAll();

	foreach($books as $book)
	{
		$book_title = $book['book_title'];
		$book_genre = $book['book_genre'];
		$book_review = $book['book_review'];
		$reviewer_name = $book['reviewer_name'];
		$reviewer_email = $book['reviewer_email'];
		$book_link = $book['book_link'];
		$book_img = $book['book_img'];
	}

	//Close me!!!
	$conn = null;
}
?>


	<div class="container">
		<a href="books.php"> View All Books </a>

		<form method="post" action="save_book.php" enctype="multipart/form-data">
			<div class="form-group">
				<label> Name: </label>
				<input type="text" name="name" class="form-control" value="<?php echo $reviewer_name ?>">
			</div>

			<div class="form-group">
				<label> E-mail: </label>
				<input type="text" name="email" class="form-control" value="<?php echo $reviewer_email ?>">
			</div>
			
			<div class="form-group">
				<label> Book: </label>
				<input type="text" name="book" class="form-control" value="<?php echo $book_title ?>">
			</div>
			
			<div class="form-group">
				<label> Genre: </label>
				<input type="text" name="genre" class="form-control" value="<?php echo $book_genre ?>">
			</div>

			<div class="form-group">
				<label> Review: </label>
				<input type="text" name="review" class="form-control" value="<?php echo $book_review ?>">
			</div>

			<div class="form-group">
				<label> Book Website: </label>
				<input type="text" name="booklink" class="form-control" value="<?php echo $book_link ?>">
			</div>

			<div class="form-group">
				<label> Book Image: </label>
				<input type="file" name="photo" id="photo" class="form-control" value="<?php echo $book_img ?>">
			</div>

			<input type="submit" value="Submit Book" class="btn btn-primary">

			<input type="hidden" name="book_id" value="<?php echo $book_id ?>">
		</form>
	</div>
</body>

</html>