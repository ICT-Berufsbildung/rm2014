<?php
/**
 *	ICT Championships 2014
 *	WebDesign
 *
 *	Thread list
 */

// Loading
$model = new Thread($database);
$threads = $model->all();

require_once(PATH_VIEW.'thread_list.php');
