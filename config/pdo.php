<?php

namespace infomail\config;

class Pdo 
{
	// protected $user = 'ka-kikaku';
	// protected $pass = 'kaka7890';
	// protected $pdo = 'mysql:dbname=ka-kikaku_crew_report;host=ql465.db.sakura.ne.jp';
	// mysql -u ka-kikaku -p ka-kikaku_crew_report -h ql465.db.sakura.ne.jp
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
