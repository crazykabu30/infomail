<?php 

use PHPUnit\Framework\TestCase;
use InfoMail\Config\PdoSetting;

include_once 'vendor/autoload.php';
include_once 'Config/PdoSetting.php';

class PdoSettingTest extends TestCase
{
	public function testGetConfig()
	{
		$pdo = new PdoSetting();
		$val = $pdo->getConfig();
		$user = $val['user'];
		$pass = $val['pass'];
		$pdo = $val['pdo'];
		$this->assertEquals('user',$user);
		$this->assertEquals('p',$pass);
		$this->assertEquals('mysql:dbname=crew_report;host=localhost',$pdo);
	}
}
