<?php 

namespace InfoMail\Database;

include 'infomail/Config/PdoSetting.php';

class MailDb
{
	protected $pdo;
	protected $name;
	protected $pass;

	public function __construct ($array=PdoSetting::getConfig)
	{

	}

}