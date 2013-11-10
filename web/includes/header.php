<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />

    <title>Page name - IT Help</title>

    <meta name="description" lang="fr" content="Helping people in IT technologies" />
    <meta name="keywords" lang="fr" content="IT, help, computer, problem, question" />

    <link href="./stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="./stylesheets/design.css" rel="stylesheet" type="text/css" media="all" />

    <script type="text/javascript" src="./scripts/jquery.min.js"></script>

    <!--[if lte IE 8]>
    <script src="./scripts/html5.js"></script>
    <![endif]-->
</head>

<body>
<div id="main">
    <header>
        <div>
            <a href="./" class="logo">
                <img src="./images/logo.png" alt="Logo" />
            </a>

            <nav>
                <a href="./"<?php if (basename($_SERVER['SCRIPT_NAME']) == 'index.php'): ?> class="active"<?php endif; ?>>Home</a>
                <a href="thread_list.php"<?php if (basename($_SERVER['SCRIPT_NAME']) == 'thread_list.php'): ?> class="active"<?php endif; ?>>Thread list</a>
                <a href="about.php"<?php if (basename($_SERVER['SCRIPT_NAME']) == 'about.php'): ?> class="active"<?php endif; ?>>About us</a>
            </nav>

            <hr class="clear" />
        </div>
    </header>
