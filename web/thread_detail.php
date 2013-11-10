<?php

$database = require 'includes/database.php';

$idThread = isset($_GET['id']) ? (int) $_GET['id'] : '';
$success = isset($_GET['success']) ? $_GET['success'] : '';

$sql = "
    SELECT
        t.id_thread,
        t.name_thread,
        c.id_comment,
        c.rating_up,
        c.rating_down,
        c.name_author,
        c.content
    FROM
        `thread` t
    INNER JOIN
        `comment` c ON c.id_thread = t.id_thread
    WHERE
        t.id_thread = ?
    ORDER BY
        c.id_comment
";

$statement = $database->prepare($sql);
$statement->execute(array($idThread));

$comments = $statement->fetchAll();

$sql = "
    SELECT
        t.name_tag
    FROM
        `tag` t
    INNER JOIN
        `thread_tag` tt ON tt.id_tag = t.id_tag
    WHERE
        tt.id_thread = ?
";

$statement = $database->prepare($sql);
$statement->execute(array($idThread));

$tags = $statement->fetchAll();

$nameAuthor = isset($_POST['name_author']) ? $_POST['name_author'] : '';
$emailAuthor = isset($_POST['email_author']) ? $_POST['email_author'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$nameTag = isset($_POST['name_tag']) ? $_POST['name_tag'] : '';

$messages = array();

if (!empty($_POST['add_comment'])) {

    if (!$nameAuthor) {
        $messages['name_author'] = 'Please enter your name.';
    }

    if (!$emailAuthor) {
        $messages['email_author'] = 'Please enter your email.';
    } else if (!filter_var($emailAuthor, FILTER_VALIDATE_EMAIL)) {
        $messages['email_author'] = 'Please enter a valid email.';
    }

    if (!$content) {
        $messages['content'] = 'Please enter a comment.';
    }

    if (count($messages) == 0) {

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

        header('Location: thread_detail.php?success=Comment+successfully+added.&id=' . $idThread);
        exit;
    }
}


if (!empty($_POST['add_tag'])) {

    if (!$nameTag) {
        $messages['name_tag'] = 'Please enter a tag.';
    }

    if (count($messages) == 0) {

        $nameTag = trim(strtolower($nameTag));

        $sql = 'SELECT t.id_tag FROM `tag` t WHERE t.name_tag = ?';

        $statement = $database->prepare($sql);
        $statement->execute(array($nameTag));

        $tag = $statement->fetch();

        if ($tag) {

            $idTag = $tag['id_tag'];

        } else {
            
            $sql = '
                INSERT INTO
                    `tag` (
                        `name_tag`
                    )
                VALUES
                    (
                        ?
                    )
            ';
            
            $statement = $database->prepare($sql);
            $statement->execute(array($nameTag));
            $idTag = $database->lastInsertId();
        }

        $sql = '
            INSERT INTO
                `thread_tag` (
                    `id_thread`,
                    `id_tag`
                )
            VALUES
                (
                    ?,
                    ?
                )
        ';

        $statement = $database->prepare($sql);
        $statement->execute(array($idThread, $idTag));

        header('Location: thread_detail.php?success=Tag+successfully+added.&id=' . $idThread);
        exit;
    }
}

?>
<?php require 'includes/header.php'; ?>

<section class="section-breadcrumb">
    <ul class="breadcrumb">
        <li><a href="./">Home</a> <span class="divider">/</span></li>
        <li><a href="thread_list.php">Threads</a> <span class="divider">/</span></li>
        <?php foreach ($comments as $comment): ?>
            <li class="active"><?php echo htmlentities($comment['name_thread']); ?></li>
            <?php break; ?>
        <?php endforeach; ?>
    </ul>
</section>

<?php if ($success): ?>
    <div class="alert alert-success">
        <?php echo htmlentities($success); ?>
    </div>
<?php endif; ?>

<?php foreach ($comments as $i => $comment): ?>
    <section>
        <h1>
            <?php if ($i === 0): ?>
                <?php echo htmlentities($comment['name_thread']); ?>
            <?php else: ?>
                <?php echo htmlentities($comment['name_author']); ?>
            <?php endif; ?>
            <ul class="rating pull-right">
                <li>
                    <a href="#" title="vote up" class="vote" data-id="<?php echo htmlentities($comment['id_comment']); ?>" data-rating="up">
                        <span class="badge badge-success">+<?php echo htmlentities($comment['rating_up']); ?></span>
                    </a>
                </li>
                <li>
                    <a href="#" title="vote down" class="vote" data-id="<?php echo htmlentities($comment['id_comment']); ?>" data-rating="down">
                        <span class="badge badge-important">-<?php echo htmlentities($comment['rating_down']); ?></span>
                    </a>
                </li>
            </ul>
        </h1>
        <?php if ($i === 0): ?>
            <p>Tags: <?php foreach ($tags as $tag): ?><span class="label label-info"><?php echo htmlentities($tag['name_tag']); ?></span> <?php endforeach; ?></p>
        <?php endif; ?>
        <p>
            <?php echo htmlentities($comment['content']); ?>
        </p>
    </section>
<?php endforeach; ?>

<section>
    <h1 id="add_comment">Add comment</h1>
    <form action="#add_comment" method="post">
        <input type="hidden" name="id" value="<?php echo htmlentities($idThread); ?>">
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
        <label for="add_name_thread">Comment</label>
        <textarea class="input-xlarge" rows="3" name="content"><?php echo htmlentities($content); ?></textarea>
        <?php if (isset($messages['content'])): ?>
            <span class="help-inline"><span class="text-error"><?php echo htmlentities($messages['content']); ?></span></span>
        <?php endif; ?>
        <p><input type="submit" name="add_comment" class="btn" value="Add comment"></p>
    </form>
</section>

<section>
    <h1 id="add_tag">Add tag</h1>
    <form action="#add_tag" method="post">
        <input type="hidden" name="id" value="<?php echo htmlentities($idThread); ?>">
        <label for="add_name_tag">Tag</label>
        <input type="text" id="add_name_tag" name="name_tag" value="<?php echo htmlentities($nameTag); ?>">
        <?php if (isset($messages['name_tag'])): ?>
            <span class="help-inline"><span class="text-error"><?php echo htmlentities($messages['name_tag']); ?></span></span>
        <?php endif; ?>
        <p><input type="submit" name="add_tag" class="btn" value="Add Tag"></p>
    </form>
</section>

<?php require 'includes/footer.php'; ?>
