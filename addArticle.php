<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Newsbook - An Online News Portal</title>
    </head>
    <body>
        <a href="newsbook.php">Home</a> | <a href="addArticle.php">Add Article</a> | <a href="filterArticle.php">Choose News Category</a> | <a href="searchArticle.php">Search Article</a> | <a href="updateArticle.php">Update/Delete Article</a>
        <?php
        
	// The function to clean strings
        // To prevent unwanted input

	function clean($string) {

		$string = trim($string); // This function returns a string with whitespace stripped from the beginning and end of str. Without the second parameter, trim() will strip these characters
		$string = htmlentities($string, ENT_COMPAT); // This function is identical to htmlspecialchars() in all ways, except with htmlentities(), all characters which have HTML character entity equivalents are translated into these entities.
                $string = addslashes($string); // Returns a string with backslashes before characters that need to be quoted in database queries etc. These characters are single quote ('), double quote ("), backslash (\) and NUL (the NULL byte).

		return $string;

	}

	// Open mysql connection

	$connect = mysqli_connect('localhost', 'root', '', 'c203') or die(mysqli_connect_error());

        ?>

        <h1>Newsbook</h1>

        <?php

            //  Check if form submitted
            //  isset function to determine if the forms been posted or not.
            if(isset($_POST['submit'])) {

		$category = clean($_POST['category']);
		$headline = clean($_POST['headline']);
		$story = clean($_POST['story']);
		$writer = clean($_POST['writer']);
		$source = clean($_POST['source']);

		// Check for empty input

		if(!$category || !$headline || !$story || !$writer || !$source) {

			// Show error

			echo "There's empty fields, please rectify them before continuing";

		 } else {
                        // The default PHP timezone is not set to Singapore.
                        date_default_timezone_set('Asia/Singapore');
			$time = date('Y-n-d H:i:s');

			// Try submitting the article

			if(mysqli_query($connect, "INSERT INTO newsbook VALUES( NULL, '{$category}', '{$headline}', '{$story}', '{$writer}', '{$source}', '{$time}')") or die(mysqli_error()))  {


				// Articles submitted

	?>

	<h3>New Article Added <span style="color:green">Successfully</span></h3>

	<table width="500px" border="1">

		<tr>

			<td style="font-weight:bold">Category</td>
			<td><?php echo stripslashes($category); ?></td>

		</tr>
		<tr>

			<td style="font-weight:bold">Headline</td>
			<td><?php echo stripslashes($headline); ?></td>

		</tr>
		<tr>

			<td style="font-weight:bold">Writer</td>
			<td><?php echo stripslashes($writer); ?></td>

		</tr>
		<tr>

			<td style="font-weight:bold">Source</td>
			<td><?php echo stripslashes($source); ?></td>

		</tr>
		<tr>

			<td style="font-weight:bold">Story</td>
			<td><?php echo stripslashes($story); ?></td>

		</tr>

	</table>
        
        <meta http-equiv="refresh" content="10;url=addArticle.php">
        
		<?php

			} else {

				// Submit failed

				echo "There's a problem submitting the article, try again?<br />".mysql_error();

			}

		}

	} else {

                ?>

	<h3>Add Article</h3>

	<form method="POST" action="">

		<table width="400px" border="0">

			<tr>

				<td><label for="headline">Headline</label></td>
				<td><input type="text" id="headline" name="headline" /></td>

			</tr>
			<tr>

				<td><label for="category">Category</label></td>
				<td>

					<select id="category" name="category">
                                                
                                            <option> </option>
                                            <option>Entertainment</option>
                                            <option>Singapore</option>
                                            <option>Tech</option>

					</select>

				</td>

			</tr>
			<tr>

				<td><label for="writer">Writer</label></td>
				<td><input type="text" id="writer" name="writer" /></td>

			</tr>
			<tr>

				<td><label for="source">Source</label></td>
				<td><input type="text" id="source" name="source" /></td>

			</tr>
			<tr>

				<td><label for="story">Story</label></td>
				<td><textarea id="story" name="story" rows="10" cols="50"></textarea></td>

			</tr>
                        <tr>

                            <td>&nbsp;</td>
                            <td><input name="submit" value="Submit" type="submit"><input type="reset" value="Reset"></td>

                        </tr>

		</table>

	</form>

    <?php

	}

    ?>
        
    </body>
</html>

<?php

    echo "<br/><br/>Name: Wong Chun Kiat ";
    echo "Student ID: 92807 ";
    echo "Class: E66D ";
    
?>