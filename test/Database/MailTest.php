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
}
