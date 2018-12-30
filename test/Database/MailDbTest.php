<?php 

use PHPUnit\Framework\TestCase;
use InfoMail\Database\MailDb;

include_once 'vendor/autoload.php';
include_once 'infomail/src/Database/MailDb.php';

class MailDbTest extends TestCase 
{
	public function testGetTerminals()
	{
		$class = new MailDb();
		$val = $class->getTerminals();
		$this->assertFalse($val);
		$class->setAcl('admin');
		$val = $class->getTerminals();
		$this->assertEquals(array(
			'1608'=>'1608',
			'1662'=>'1662',
			'2661'=>'2661',
			'3670'=>'3670',
			'391'=>'391',
			'4272'=>'4272',
			'4768'=>'4768',
			'4782'=>'4782',
			'515'=>'515',
			'608'=>'608',
			'787'=>'787',
			'8701'=>'8701',
			'8702'=>'8702',
			'8703'=>'8703',
			'8704'=>'8704',
			'8705'=>'8705',
			'hood'=>'幌',
			'long'=>'ロング',
			'roy1'=>'ロイ1',
			'roy2'=>'ロイ2',
			'wide'=>'ワイド'
		),$val);
	}
	public function testIsAdmin()
	{
		$class = new MailDb();
		$this->assertFalse($class->isAdmin());
		$class->setAcl('admin');
		$this->assertTrue($class->isAdmin());
	}
	// 出勤者を取得する（文字列リスト）
	public function testGetOids()
	{
		$class = new MailDb();
		$class->setAcl('admin');
		$this->assertTrue($class->isAdmin());
		$val = $class->getOids();
		$this->assertEquals(array(),$val);
		$val = $class->getOids('2018-10-31');
		$this->assertEquals(array('830','803','585'),$val);
	}
	public function testInsertMail()
	{
		$class = new MailDb();
		$class->setAcl('admin');
		# insertしてみる
		$isToAll = false;
		$title = 'test_title';
		$body = 'test_body';
		$this->assertTrue($class->insertMail($isToAll,$title,$body));
	}
	public function testGetTodayMails()
	{
		$class = new MailDb();
		$class->setAcl('admin');
		$this->assertEquals(array(
			array('test_title',date('H:i',time()))
		),$class->getTodayMails());
		// ゴミが溜まったら↓これでクリアすること
		// DELETE FROM mail_for_crew WHERE curdate() < datetime;
	}
	/* in progress ...
	public function testGetArchieves()
	{
		$class = new MailDb();
		$class->setAcl('admin');
		$this->assertEquals(array(
			array('test_title','22:54'),
			array('お知らせ[12.7 日付および時間関数]','14:35')
		),$class->getArchieves(1));
	}
	 */
	/* in progress ...
	public function testGetVisibleArchieves()
	{
		$class = new MailDb();
		# 
	}
	 */
	/* in progress ...
	public function testGetMailContent()
	{
		$class = new MailDb();
		$class->setAcl('admin');
		# 
	}
	 */
}
