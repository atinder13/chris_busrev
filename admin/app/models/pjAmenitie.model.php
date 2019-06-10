<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}

class pjAmenitieModel extends pjAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'amenitie';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'amId', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'bus_id', 'type' => 'int', 'default' => ':NULL'),
		
	);
	
	public static function factory($attr=array())
	{
		
		return new pjAmenitieModel($attr);
	}
}
?>