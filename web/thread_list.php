<?php

$database = require 'includes/database.php';

$sql = "
    SELECT
        t.id_thread,
        t.name_thread,
        c.id_comment,
        c.rating_up,
        c.rating_down,
        c.content
    FROM
        `thread` t
    INNER JOIN
        `comment` c ON c.id_thread = t.id_thread
    GROUP BY
        t.id_thread
    ORDER BY
        t.id_thread DESC
";

$threads = $database->query($sql);

$nameAuthor = isset($_POST['name_author']) ? $_POST['name_author'] : '';
$emailAuthor = isset($_POST['email_author']) ? $_POST['email_author'] : '';
$nameThread = isset($_POST['name_thread']) ? $_POST['name_thread'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $messages = array();

    if (!$nameAuthor) {
        $messages['name_author'] = 'Please enter your name.';
    }

    if (!$emailAuthor) {
        $messages['email_author'] = 'Please enter your email.';
    } else if (!filter_var($emailAuthor, FILTER_VALIDATE_EMAIL)) {
        $messages['email_author'] = 'Please enter a valid email.';
    }

    if (!$nameThread) {
        $messages['name_thread'] = 'Please enter a thread name.';
    }

    if (!$content) {
        $messages['content'] = 'Please enter a comment.';
    }

    if (count($messages) == 0) {

        $sql = '
            INSERT INTO
                `thread` (
                    `name_thread`
                )
            VALUES
                (
                    ?
                )
        ';

        $statement = $database->prepare($sql);
        $statement->execute(array($nameThread));
        $idThread = $database->lastInsertId();

        $sql = '
            INSERT INTO
                `comment` (
                    `name_author`,
                    `email_author`,
                    `content`,
                    `id_thread`
                )
            VALUES
                (
                    ?,
                    ?,
                    ?,
                    ?
                )
        ';

        $statement = $database->prepare($sql);
        $statement->execute(array($nameAuthor, $emailAuthor, $content, $idThread));

        header('Location: thread_detail.php?id=' . $idThread);
        exit;
    }
}

?>
<?php require 'includes/header.php'; ?>

<section class="section-breadcrumb">
    <ul class="breadcrumb">
      <li><a href="./">Home</a> <span class="divider">/</span></li>
      <li class="active">Thread list</li>
    </ul>
</section>

<?php foreach ($threads as $thread): ?>
    <section>
        <h1>
            <a href="thread_detail.php?id=<?php echo htmlentities($thread['id_thread']); ?>"><?php echo htmlentities($thread['name_thread']); ?></a>
            <ul class="rating pull-right">
                <li>
                    <a href="#" title="vote up" class="vote" data-id="<?php echo htmlentities($thread['id_comment']); ?>" data-rating="up">
                        <span class="badge badge-success">+<?php echo htmlentities($thread['rating_up']); ?></span>
                    </a>
                </li>
                <li>
                    <a href="#" title="vote down" class="vote" data-id="<?php echo htmlentities($thread['id_comment']); ?>" data-rating="down">
                        <span class="badge badge-important">-<?php echo htmlentities($thread['rating_down']); ?></span>
                    </a>
                </li>
            </ul>
        </h1>
        <p>
            <?php echo htmlentities(substr($thread['content'], 0, 200)); ?> …
        </p>
        <a href="thread_detail.php?id=<?php echo htmlentities($thread['id_thread']); ?>">Read more</a>
    </section>
<?php endforeach; ?>

<section>
    <h1 id="add_thread">Add thread</h1>
    <form action="#add_thread" method="post">
        <label for="add_name_author">Your name</label>
        <input type="text" id="add_name_author" name="name_author" value="<?php echo htmlentities($nameAuthor); ?>">
        <?php if (isset($messages['name_author'])): ?>
            <span class="help-inline"><span class="text-error"><?php echo htmlentities($messages['name_author']); ?></span></span>
        <?php endif; ?>
        <label for="add_name_thread">Your email</label>
        <input type="email" id="add_name_thread" name="email_author" value="<?php echo htmlentities($emailAuthor); ?>">
        <?php if (isset($messages['email_author'])): ?>
            <span class="help-inline"><span class="text-error"><?php echo htmlentities($messages['email_author']); ?></span></span>
        <?php endif; ?>
        <label for="add_name_thread">Thread name</label>
        <input class="input-xlarge" type="text" id="add_name_thread" name="name_thread" value="<?php echo htmlentities($nameThread); ?>">
        <?php if (isset($messages['name_thread'])): ?>
            <span class="help-inline"><span class="text-error"><?php echo htmlentities($messages['name_thread']); ?></span></span>
        <?php endif; ?>
        <label for="add_name_thread">Your question</label>
        <textarea class="input-xlarge" rows="3" name="content"><?php echo htmlentities($content); ?></textarea>
        <?php if (isset($messages['content'])): ?>
            <span class="help-inline"><span class="text-error"><?php echo htmlentities($messages['content']); ?></span></span>
        <?php endif; ?>
        <p><button type="submit" class="btn">Add thread</button></p>
    </form>
</section>

<?php require 'includes/footer.php'; ?>
