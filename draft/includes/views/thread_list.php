<?php foreach ($threads as $thread): ?>
<section>
	<h1><?php echo htmlentities($thread['name_thread']); ?></h1>
	<a href="thread_detail.html?id=<?php echo $thread['id_thread']; ?>">Read more</a>
</section>
<?php endforeach; ?>