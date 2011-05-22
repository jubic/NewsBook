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

	function clean($string) {

		$string = trim($string);
		$string = htmlentities($string, ENT_COMPAT);

		return $string;

	}

	// Open mysql connection

	$connect = mysqli_connect('localhost', 'root', '', 'c203') or die(mysqli_connect_error());

        ?>

        <h1>Newsbook</h1>

        <?php

            if(($_POST['filter'])) {

                $category = clean($_POST['filtered']);

        ?>

            <h3><?php echo $category; ?></h3>

            <table border="1" width="1200px">
                
            <?php

                $filtered_query = mysqli_query($connect, "SELECT * FROM newsbook WHERE category = '{$category}' ORDER BY date_submitted DESC") or die('Error querying database');
                while($filtered = mysqli_fetch_assoc($filtered_query)) {

            ?>

                <tr>
                    <td><?php echo $filtered['category'] ?></td>
                    <td><?php echo $filtered['headline'] ?></td>
                    <td><?php echo $filtered['writer']; ?></td>
                    <td><?php echo $filtered['source']; ?></td>
                    <td><?php echo $filtered['date_submitted']; ?></td>
                    <td><?php echo $filtered['story']; ?></td>
                </tr>
            
            <?php

                }

            ?>
                
            </table>
            
        <?php

            } else {

        ?>

        <form method="post" action="">

            <label>

                Choose Category:

                <select name="filtered">

                <?php

                    $filtercat_query = mysqli_query($connect, "SELECT DISTINCT category FROM newsbook ORDER BY category ASC") or die('Error querying database');
                    while($filtercat = mysqli_fetch_assoc($filtercat_query)) {
                        
                ?>

                    <option><?php echo $filtercat['category'];?></option>

                <?php

                    }

                ?>

                </select>

            </label>

            <input type="submit" name="filter" value="Filter!" />

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