<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving Album...</title>
</head>

<body>
<?php
    $title = $_POST['title'];
    $year = $_POST['year'];
    $artist = $_POST['artist'];

    echo 'title: '.$title.'<br />';
    echo 'year: '.$year.'<br />';
    echo 'artist: '.$artist.'<br />';
?>
</body>

</html>
