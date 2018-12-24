<?php 

namespace InfoMail\Database;

class Mail
{
	/**
	 * @var array list of send to addresses
	 */
	public $sendTo;
	/**
	 * @var string title
	 */
	public $title;
	/**
	 * @var string content-body
	 */
	public $body;
	// constructor function
	public function __construct()
	{
		$this->sendTo = array();
		$this->title = '';
		$this->body = '';
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
	 * タイトルを登録する
	 * 
	 * @var string
	 */
	public function setTitle($val)
	{
		$this->title = $val;
		return true;
	}
	/**
	 * タイトルを確認する
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}
	/**
	 * 本文を登録する
	 * 
	 * @var string
	 */
	public function setBody($val)
	{
		$this->body = $val;
		return true;
	}
	/**
	 * 本文を確認する
	 *
	 * @return string
	 */
	public function getBody()
	{
		return $this->body;
	}
	/**
	 * メールを送る
	 */
	/**
	 * メールコンテンツをDBに登録する
	 */
}
