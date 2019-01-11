<?php 

use PHPUnit\Framework\TestCase;
use InfoMail\Database\Mail;

include_once 'vendor/autoload.php';
include_once 'src/Database/Mail.php';

class MailTest extends TestCase 
{
	public function testSetVisibility()
	{
		$mail = new Mail();
		$this->assertEquals('ind',$mail->visibleTo());
		$this->assertTrue($mail->setVisibility('all'));
		$this->assertEquals('all',$mail->visibleTo());
		$this->assertTrue($mail->setVisibility('out'));
		$this->assertEquals('out',$mail->visibleTo());
		$this->assertFalse($mail->setVisibility('any'));
	}
	public function testAddSendTo()
	{
		$mail = new Mail();
		$this->assertEquals(array(),$mail->getSendTo());
		$sendto = 'poshette24@gmail.com';
		$this->assertTrue($mail->addSendTo($sendto));
		$this->assertEquals(array('poshette24@gmail.com'),$mail->getSendTo());
		$sendto = 'yykyyk30@gmail.com';
		$this->assertTrue($mail->addSendTo($sendto));
		$this->assertEquals(array('poshette24@gmail.com','yykyyk30@gmail.com'),$mail->getSendTo());
	}
	public function testSetTitle()
	{
		$mail = new Mail();
		$this->assertEquals('',$mail->getTitle());
		$title = 'title1';
		$this->assertTrue($mail->setTitle($title));
		$this->assertEquals('title1',$mail->getTitle());
		$title = 'title2';
		$this->assertTrue($mail->setTitle($title));
		$this->assertEquals('title2',$mail->getTitle());
	}
	public function testSetBody()
	{
		$mail = new Mail();
		$this->assertEquals('',$mail->getBody());
		$title = 'body1';
		$this->assertTrue($mail->setBody($title));
		$this->assertEquals('body1',$mail->getBody());
		$title = 'body2';
		$this->assertTrue($mail->setBody($title));
		$this->assertEquals('body2',$mail->getBody());
	}
	public function testGetMailData()
	{
		$mail = new Mail();
		$this->assertFalse($mail->getMailData());
		$mail->setVisibility('all');
		$this->assertFalse($mail->getMailData());
		$mail->setTitle('タイトル');
		$this->assertFalse($mail->getMailData());
		$mail->setBody('本文');
		$this->assertEquals(array(
			'visible'=>'all',
			'to'=>array(), 
			'title'=>'タイトル', 
			'body'=>'本文'
		),$mail->getMailData());
		$mail->setVisibility('ind');
		$this->assertFalse($mail->getMailData());
		$mail->addSendTo('poshette24@gmail.com');
		$mail->addSendTo('yykyyk30@gmail.com');
		$this->assertEquals(array(
			'visible'=>'ind',
			'to'=>array('poshette24@gmail.com','yykyyk30@gmail.com'),
			'title'=>'タイトル', 
			'body'=>'本文'
		),$mail->getMailData());
	}
	// メールを送信する
}
