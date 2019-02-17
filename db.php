<?php

class db 
{
	private static function dbc()
	{	
		$dsn = 'mysql:host=127.0.0.1; dbname= Database_Name; charset=utf8';
		$user = '';
		$password = '';
		
		try 
		{
			$dbh = new PDO($dsn, $user, $password);
			return $dbh;
		} catch (PDOException $e) {echo $e->getMessage();}
		
	}
	
	
	public static function query($statement, $names = array())
	{
		$query = self::dbc()->prepare($statement);
		$query->execute($names);
		
		if (explode(' ',$statement)[0] == 'SELECT')
		{
			$value = $query->fetchAll();
			return $value;
		}
	}
}

?>
