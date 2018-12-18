<?php 

use PHPUnit\Framework\TestCase;
use InfoMail\Config\PdoSetting;

include 'vendor/autoload.php';
include 'infomail/Config/PdoSetting.php';

class PdoSettingTest extends TestCase
{
	public function testGetConfig()
	{
		$val = PdoSetting::getConfig();
		$user = $val['user'];
		$pass = $val['pass'];
		$pdo = $val['pdo'];
		$this->assertEquals('user',$user);
		$this->assertEquals('p',$pass);
		$this->assertEquals('mysql:dbname=crew_report;host=localhost',$pdo);
	}
}
