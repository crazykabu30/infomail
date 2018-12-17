<?php 

use PHPUnit\Framework\TestCase;
use infomail\config\Pdo;

include 'vendor/autoload.php';
include 'infomail/config/pdo.php';

class PdoTest extends TestCase
{
	public function testGetConfig()
	{
		$class = new Pdo();
		$val = $class->getConfig();
		$user = $val['user'];
		$pass = $val['pass'];
		$pdo = $val['pdo'];
		$this->assertEquals('user',$user);
		$this->assertEquals('p',$pass);
		$this->assertEquals('mysql:dbname=crew_report;host=localhost',$pdo);
	}
}
