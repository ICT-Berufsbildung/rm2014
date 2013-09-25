<?php
/**
 *	ICT Championships 2014
 *	WebDesign
 *
 *	Website design
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />

	<title><?php echo $pageList[$currentPage]; ?> - IT Help</title>

	<meta name="description" lang="fr" content="Helping people in IT technologies" />
	<meta name="keywords" lang="fr" content="IT, help, computer, problem, question" />

	<link href="./styles/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<link href="./styles/design.css" rel="stylesheet" type="text/css" media="all" />
	<link href="./styles/pages.css" rel="stylesheet" type="text/css" media="all" />

	<script type="text/javascript" src="./scripts/jquery.min.js"></script>

	<!--[if lte IE 8]>
	<script src="./scripts/html5.js"></script>
	<![endif]-->
</head>

<body>
<div id="main">
	<header>
		<div>
			<a href="accueil.html" class="logo">
				<img src="./images/logo.png" alt="Logo" />
			</a>

			<nav>
				<a href="home.html"<?php echo pageActive('home'); ?>>Home</a>
				<a href="thread_list.html"<?php echo pageActive(array('thread_list', 'thread_detail')); ?>>Thread list</a>
				<a href="about.html"<?php echo pageActive('about'); ?>>About us</a>
			</nav>

			<hr class="clear" />
		</div>
	</header>

	<?php if (isset($_SESSION['success'])): ?>
		<div class="alert alert-success">
			<?php echo htmlentities($_SESSION['success']); ?>
		</div>
		<?php unset($_SESSION['success']); ?>
	<?php endif; ?>

	<?php if (isset($_SESSION['error'])): ?>
		<div class="alert alert-error">
			<?php echo htmlentities($_SESSION['error']); ?>
		</div>
		<?php unset($_SESSION['error']); ?>
	<?php endif; ?>

	<?php include(PATH_SOURCE.$currentPage.'.php'); ?>

	<footer>
		Copyright &copy; 2014 <strong>IT Help</strong> - ICT Championships 2014 <br /> Candidate
		<?php echo htmlentities($candidate['name'].' '.$candidate['surname'].', '.$candidate['school'].$candidate['company']); ?>
	</footer>
</div>
</body>

</html>