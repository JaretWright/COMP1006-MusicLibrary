<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Album Details</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    </head>
<body>
    <main class="container">
        <h1>Album Details</h1>

        <?php
            if (!empty($_GET['albumID']))
                $albumID = $_GET['albumID'];
            else
                $albumID = null;

            $title = null;
            $year = null;
            $artist = null;
            $genrePicked = null;

            // if the albumID exists, it is an edit situation and we need to
            //load the album from the DB
            if (!empty($albumID))
            {
                $conn = new PDO('mysql:host=localhost;dbname=php','root','admin');
                $sql = "SELECT * FROM albums WHERE albumID = :albumID";
                $cmd = $conn->prepare($sql);
                $cmd->bindParam(':albumID', $albumID, PDO::PARAM_INT);
                $cmd->execute();
                $album = $cmd->fetch();
                $conn = null;

                $title = $album['title'];
                $year = $album['year'];
                $artist = $album['artist'];
                $genrePicked = $album['genre'];

            }
        ?>

        <form method="post" action="saveAlbum.php">
            <fieldset class="form-group">
                <label for="title" class="col-sm-1">Title: *</label>
                <input name="title" id="title" required placeholder="Album title"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="year" class="col-sm-1">Year:</label>
                <input name="year" id="year" type="number" min="1900" placeholder="Release Year"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="artist" class="col-sm-1">Artist: *</label>
                <input name="artist" id="artist" required placeholder="Artist Name"/>
            </fieldset>

            <fieldset>
                <label for="genre" class="col-sm-1">Genre: *</label>
                <select name="genre" id="genre">
                    <?php
                        //Step 1 - connect to the DB
                        $conn = new PDO('mysql:host=localhost;dbname=php','root','admin');
                        $conn->setAttribute(PDO::ERRMODE_EXCEPTION);

                        //Step 2 - create the SQL statement
                        $sql = "SELECT * FROM genres";

                        //Step 3 - prepare & execute the SQL statement
                        $cmd = $conn->prepare($sql);
                        $cmd->execute();
                        $genres = $cmd->fetchAll();

                        //Step 4 - disconnect from the DB
                        $conn = null;

                        //Step 5 - loop over the results to build the list with <option> </option>
                        foreach ($genres as $genre)
                        {
                            echo '<option>'.$genre['genre'].'</option>';
                        }

                    ?>
                </select>
            </fieldset>

            <button class="btn btn-success col-sm-offset-1">Save</button>


        </form>

    </main>


</body>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</html>
