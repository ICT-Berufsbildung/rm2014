<?php

/**
 * Function to enable or disable a menu.
 * According to the currently visited
 *
 * @param String $page Page or page list for which the menu should activate
 * @return String HTML code for the menu activation
 */
function pageActive($page)
{
	global $currentPage;

	$page = (!is_array($page)) ? array($page) : $page;

	if (in_array($currentPage, $page))
		return ' class="active"';
}

/**
 * Function to truncate a text.
 * Don't truncate in a word
 *
 * @param String $text Text to truncate
 * @param int $length Length before truncate
 * @return mixed Truncated text
 */
function truncateText($text, $length = 50)
{
	return preg_replace('/\s+?(\S+)?$/', '', substr($text, 0, $length));
}