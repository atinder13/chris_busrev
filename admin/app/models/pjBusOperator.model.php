<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}

class pjBusOperatorModel extends pjAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'bus_operator';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'logo', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'operator', 'type' => 'varchar', 'default' => ':NULL'),
		array('name' => 'status', 'type' => 'enum', 'default' => 'T')
	);
	
	public $i18n = array('name');
	
	public static function factory($attr=array())
	{
		return new pjBusOperatorModel($attr);
	}
}
?>