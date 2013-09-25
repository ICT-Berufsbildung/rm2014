<?php
/**
 *	ICT Championships 2014
 *	WebDesign
 *
 *	About the candidate
 */

$candidate['name'] = '';
$candidate['surname'] = '';
$candidate['email'] = '';
$candidate['birthdate'] = ''; // Format DD.MM.YYYY
$candidate['company'] = ''; // Leave blank if you are in a school
$candidate['school'] = ''; // Leave blank if you are in a company

// Check candidate information
if (empty($candidate['name']) OR empty($candidate['surname']) OR empty($candidate['birthdate'])
	OR empty($candidate['email']) OR ( empty($candidate['company']) AND empty($candidate['school']) ))
{
	require_once(PATH_VIEW.'candidate.php');
	exit;
}