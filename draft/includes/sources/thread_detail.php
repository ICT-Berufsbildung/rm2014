<?php
/**
 *	ICT Championships 2014
 *	WebDesign
 *
 *	Thread list
 */

// Thread ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Loading
$model = new Thread($database);
$thread = $model->get($id);

// Redirect if thread not found
if (!$thread)
{
	$_SESSION['error'] = 'Unknown thread';
	header('Location: ./thread_list.html');
}

require_once(PATH_VIEW.'thread_list.php');
