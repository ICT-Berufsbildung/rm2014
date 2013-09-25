<?php
/**
 *	ICT Championships 2014
 *	WebDesign
 *
 *	Abstract class for accessing the database
 */
abstract class Model
{
	/**
	 * PDO instance
	 *
	 * @var PDO
	 */
	protected $database;

	/**
	 * Class constructor
	 *
	 * Used to retrieve PDO instance
	 *
	 * @param PDO $database PDO instance for database accessing
	 */
	public function __construct(PDO $database)
	{
		$this->database = $database;
	}
}
