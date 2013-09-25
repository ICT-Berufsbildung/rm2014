<?php
/**
 *	ICT Championships 2014
 *	WebDesign
 *
 *	Represents a discussion about a question
 */
class Thread extends Model
{
	public function get($id_thread)
	{
		// TODO: Part 4
	}

	public function all()
	{
		$statement = $this->database->prepare('SELECT `id_thread`, `name_thread` FROM `thread` ORDER BY `id_thread` DESC');
		$statement->execute();
		return $statement->fetchAll();
	}

	public function best()
	{
		// TODO: Part 3
	}
}