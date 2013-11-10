<?php

$database = require 'includes/database.php';

$idComment = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$rating = isset($_POST['rating']) ? $_POST['rating'] : '';

$ratingColumn = 'rating_up';
$sign = '+';
if ($rating == 'down') {
    $ratingColumn = 'rating_down';
    $sign = '-';
}

$sql = "UPDATE `comment` SET $ratingColumn = $ratingColumn + 1 WHERE id_comment = ? LIMIT 1";

$statement = $database->prepare($sql);
$statement->execute(array($idComment));

$sql = 'SELECT c.rating_up, c.rating_down FROM `comment` c WHERE c.id_comment = ?';

$statement = $database->prepare($sql);
$statement->execute(array($idComment));

$comment = $statement->fetch();

?>
<?php echo $sign; ?><?php echo htmlentities($comment[$ratingColumn]); ?>
