<?php 

use PHPUnit\Framework\TestCase;
use InfoMail\Database\Mail;

include_once 'vendor/autoload.php';
include_once 'infomail/src/Database/Mail.php';

class MailTest extends TestCase 
{
	public function testSetSendTo()
	{
		$mail = new Mail();
		$this->assertEquals(array(),$mail->getSendTo());
		$sendto = 'poshette24@gmail.com';
		$this->assertTrue($mail->setSendTo($sendto));
		$this->assertEquals(array('poshette24@gmail.com'),$mail->getSendTo());
		$sendto = 'yykyyk30@gmail.com';
		$this->assertTrue($mail->setSendTo($sendto));
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
}
