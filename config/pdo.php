<?php

namespace infomail\config;

class Pdo 
{
	protected $user = 'user';
	protected $pass = 'p';
	protected $pdo = 'mysql:dbname=crew_report;host=localhost';
	// mysql -u user -p crew_report

	public function getConfig()
	{
		return array(
			'pdo'=>$this->pdo,
			'user'=>$this->user,
			'pass'=>$this->pass,
		);
	}
}
