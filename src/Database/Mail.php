<?php 

namespace InfoMail\Database;

class Mail
{
	/**
	 * @var array list of send to addresses
	 */
	public $sendTo;
	public function __construct()
	{
		$this->sendTo = array();
	}
	/**
	 * 送信先を登録する
	 * 
	 * @param string str(adress)
	 * @return bool
	 */
	public function setSendTo($val)
	{
		$this->sendTo[] = $val;
		return true;
	}
	/**
	 * 送信先を確認する
	 * 
	 * @return array list-of-str(address)
	 */
	public function getSendTo()
	{
		return $this->sendTo;
	}
	/**
	 * メールを送る
	 */
	/**
	 * メールコンテンツをDBに登録する
	 */
}
