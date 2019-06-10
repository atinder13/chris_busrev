<?php
if (!defined("ROOT_PATH"))
{
	header("HTTP/1.1 403 Forbidden");
	exit;
}
class pjWalletModel extends pjAppModel
{
	protected $primaryKey = 'id';
	
	protected $table = 'wallet';
	
	protected $schema = array(
		array('name' => 'id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'operator_id', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'uuid', 'type' => 'int', 'default' => ':NULL'),
		array('name' => 'payment', 'type' => 'decimal', 'default' => ':NULL'),
		array('name' => 'deposit', 'type' => 'deposit', 'default' => ':NULL'),
		array('name' => 'status', 'type' => 'int', 'default' => ':NULL'),
	
	);
	
	public static function factory($attr=array())
	{
		return new pjWalletModel($attr);
	}
}
?>