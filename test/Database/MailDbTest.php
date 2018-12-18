<?php 

use PHPUnit\Framework\TestCase;
use InfoMail\Database\MailDb;

include 'vendor/autoload.php';
include 'infomail/src/Database/MailDb.php';

class MailDbTest extends TestCase 
{
	/* public function testGetTids()
	{
		$pdo = new Pdo();
		$settings = $pdo->getConfig();
		$class = new MailDb($settings);
		$val = $class->getTerminals();
		$this->assertEquals(array(
			['1608']=>'1608',
			['1662']=>'1662',
			['2661']=>'2661',
			['3670']=>'3670',
			['391']=>'391',
			['4272']=>'4272',
			['4768']=>'4768',
			['4782']=>'4782',
			['515']=>'515',
			['608']=>'608',
			['787']=>'787',
			['8701']=>'8701',
			['8702']=>'8702',
			['8703']=>'8703',
			['8704']=>'8704',
			['8705']=>'8705',
			['hood']=>'幌',
			['long']=>'ロング',
			['roy1']=>'ロイ1',
			['roy2']=>'ロイ2',
			['wide']=>'ワイド'
		),$val);
	} */
	public function testGetTids()
	{
		$pdo = new Pdo();
		$settings = $pdo->getConfig();
		$class = new MailDb($settings);
		$val = $class->getTerminals();
		$this->assertEquals(array(
			'430',
			'585',
			'803',
			'830'
		),$val);
	}
}
