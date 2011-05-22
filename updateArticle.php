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
                    $string = addslashes($string);

                    return $string;

            }

            // Open mysql connection

            $connect = mysqli_connect('localhost', 'root', '', 'c203') or die(mysqli_connect_error());

        ?>

        <h1>Newsbook</h1>
        <h3>Edit/Delete Article</h3>

        <?php

            if($_GET['action'] == 'delete' && $_GET['id']) {

                if(mysqli_query($connect, "DELETE FROM newsbook WHERE `id` = '{$_GET['id']}'")) {

        ?>

        <h3>Article Deleted <span style="color:green">Successfully</span>.</h3>

        <meta http-equiv="refresh" content="3;url=updateArticle.php">

        <?php

                } else {

                    echo "There's a problem deleting the article";
                
                }

            } elseif($_GET['action'] == 'edit' && $_GET['id']) {
                
                if($_POST['edit']) {
                    
                    $headline = clean( $_POST['headline'] );
                    $category = clean( $_POST['category'] );
                    $writer = clean( $_POST['writer'] );
                    $source = clean( $_POST['source'] );
                    $story = clean( $_POST['story'] );
                    
                    if(!$headline || !$category || !$writer || !$source || !$story) {
                        
                        echo "Some field was left blank, please fill them up!";
                    
                    } elseif(mysqli_query($connect, "UPDATE newsbook SET `headline` = '{$headline}', `category` = '{$category}', `writer` = '{$writer}', `source` = '{$source}', `story` = '{$story}' WHERE `id` = '{$_GET['id']}'")) {
                        
        ?>

        <h3>Article Edited <span style="color:green">Successfully</span>.</h3>

        <meta http-equiv="refresh" content="5;url=updateArticle.php">

        <?php
                        
                    } else {
                        
                        echo "There's a problem editing the article, try again.";
                        
                    }
                    
                }
                
                $editArticle_query = mysqli_query($connect, "SELECT * FROM newsbook WHERE `id` = '{$_GET['id']}'");
                $editArticle = mysqli_fetch_assoc($editArticle_query);

        ?>

	<form method="POST" action="">

		<table width="400px" border="0">

			<tr>

				<td><label for="headline">Headline</label></td>
				<td><input type="text" id="headline" name="headline" value="<?php echo $editArticle['headline']; ?>"/></td>

			</tr>
			<tr>

				<td><label for="category">Category</label></td>
				<td>

					<select id="category" name="category">

                                            <option> </option>
                                            <option <?php if($editArticle['category'] == 'Entertainment') {echo 'selected';}?>>Entertainment</option>
                                            <option <?php if($editArticle['category'] == 'Singapore') {echo 'selected';}?>>Singapore</option>
                                            <option <?php if($editArticle['category'] == 'Tech') {echo 'selected';}?>>Tech</option>

					</select>

				</td>

			</tr>
			<tr>

				<td><label for="writer">Writer</label></td>
				<td><input type="text" id="writer" name="writer" value="<?php echo $editArticle['writer'];?>"/></td>

			</tr>
			<tr>

				<td><label for="source">Source</label></td>
				<td><input type="text" id="source" name="source" value="<?php echo $editArticle['source'];?>"/></td>

			</tr>
			<tr>

				<td><label for="story">Story</label></td>
				<td><textarea id="story" name="story" rows="10" cols="50"><?php echo $editArticle['story'];?></textarea></td>

			</tr>
                        <tr>

                            <td>&nbsp;</td>
                            <td><input name="edit" value="Edit" type="submit"><input type="reset" value="Reset"></td>

                        </tr>

		</table>

	</form>

        <?php

            } else {

        ?>

            <table cellpadding="5px" cellspacing="0" border="1">

                <tr>

                    <td style="font-weight: bold">Headline</td>
                    <td style="font-weight: bold">Writer</td>
                    <td colspan="2" style="font-weight:bold">Action</td>
                    
                </tr>

             <?php

                $getarticle = mysqli_query($connect, "SELECT * FROM newsbook ORDER BY `date_submitted` DESC");
                while($articles = mysqli_fetch_assoc($getarticle)) {

             ?>

               <tr>

                    <td><?php echo $articles['headline'];?></td>
                    <td><?php echo $articles['writer']; ?></td>
                    <td><a href="?action=delete&id=<?php echo $articles['id']; ?>">Delete</a></td>
                    <td><a href="?action=edit&id=<?php echo $articles['id']; ?>">Edit</a></td>

               </tr>

        <?php

                }

        ?>

        </table>

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