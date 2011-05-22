<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Newsbook - An Online News Portal</title>
    </head>
    <body>
        <a href="newsbook.php">Home</a> | <a href="addArticle.php">Add Article</a> | <a href="filterArticle.php">Choose News Category</a> | <a href="searchArticle.php">Search Article</a> | <a href="updateArticle.php">Update/Delete Article</a>
        <?php

	// Open mysql connection

	$connect = mysqli_connect('localhost', 'root', '', 'c203') or die(mysqli_connect_error());
        
        ?>

        <h1>Newsbook</h1>

	<h2>Latest</h2>

	<?php

		$latest_query = mysqli_query($connect, "SELECT * FROM newsbook ORDER BY `date_submitted` DESC LIMIT 0, 1");
		$latest = mysqli_fetch_assoc($latest_query);

	?>

        <div style="margin:15px">

		<h3><?php echo $latest['headline']; ?></h3>
		<?php echo $latest['writer']; ?> - <?php echo $latest['date_submitted']; ?><br />

        </div>

	<h2>Most Recent</h2>

		<ul>

		<?php

			$mostrecent_query = mysqli_query($connect, "SELECT * FROM newsbook ORDER BY `date_submitted` DESC LIMIT 1, 5");
			while($mostrecent = mysqli_fetch_assoc($mostrecent_query)) {

		?>

			<li><?php echo $mostrecent['headline']; ?></li>


		<?php

			}

		?>

		</ul>

    <?php

	mysqli_close($connect);

    ?>
    </body>
</html>

<?php

    echo "<br/><br/>Name: Wong Chun Kiat ";
    echo "Student ID: 92807 ";
    echo "Class: E66D ";

?>