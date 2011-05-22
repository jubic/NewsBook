<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Newsbook - An Online News Portal</title>
    </head>
    <body>
        <a href="newsbook.php">Home</a> | <a href="addArticle.php">Add Article</a> | <a href="filterArticle.php">Choose News Category</a> | <a href="searchArticle.php">Search Article</a> | <a href="updateArticle.php">Update/Delete Article</a>
        <h1>Newsbook</h1>

        <?php

        // The function to clean strings

	function clean($string) {

		$string = trim($string);
		$string = htmlentities($string, ENT_COMPAT);
                $string = addslashes($string);

		return $string;

	}

	// Open mysql connection

	$connect = mysqli_connect('localhost', 'root', '', 'c203') or die(mysqli_connect_error());

        if(isset($_POST['search'])) {

            $keywords = clean($_POST['keywords']);

        ?>

            <h3>Search Results</h3>

            <table border="1" width="1200px">

            <?php

                $search_query = mysqli_query($connect, "SELECT * FROM newsbook WHERE headline LIKE '%{$keywords}%' OR story LIKE '%{$keywords}%'") or die('Error querying database');
                $search_num = mysqli_num_rows($search_query);

                if($search_num) {
                
                  while($search = mysqli_fetch_assoc($search_query)) {

            ?>

                <tr>

                    <td><?php echo $search['headline']; ?></td>
                    <td><?php echo $search['writer']; ?></td>
                    <td><?php echo $search['source']; ?></td>
                    <td><?php echo $search['date_submitted']; ?></td>
                    <td><?php echo $search['story']; ?></td>

                </tr>

            <?php

                 }

                } else {

            ?>

                 No result found, <span style="color:red;font-weight:bold">try again</span>?
                 <meta http-equiv="refresh" content="1;url=searchArticle.php">

            <?php

                }

            ?>

           </table>

        <?php

        } else {

        ?>

            <h3>Search News</h3>

            <form method="post" action="">

                <label>

                    Keyword:

                    <input type="text" name="keywords" />
                    <input type="submit" name="search" value="Search" />

                </label>

            </form>

        <?php

            }

            mysqli_close($connect);

        ?>

    </body>
</html>

<?php

    echo "<br/><br/>Name: Wong Chun Kiat ";
    echo "Student ID: 92807 ";
    echo "Class: E66D ";

?>