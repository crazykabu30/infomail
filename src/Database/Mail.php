<?php 

namespace InfoMail\Database;

class Mail
{
	/**
	 * @var string 全員宛/出勤者宛/個人宛
	 * 
	 * all/out/ind
	 */
	protected $visibility;
	/**
	 * @var array 送信先
	 */
	protected $sendTo;
	/**
	 * @var string 件名
	 */
	protected $title;
	/**
	 * @var string 本文
	 */
	protected $body;
	/**
	 * コンストラクタ関数
	 */
	public function __construct()
	{
		$this->visibility = 'ind';
		$this->sendTo = array();
		$this->title = '';
		$this->body = '';
	}
	/** 
	 * 通知範囲を設定する
	 */
	public function setVisibility($val)
	{
		if ($val !== 'all' && $val !== 'out' && $val !== 'ind') {
			return false;
		}
		$this->visibility = $val;
		return true;
	}
	/** 
	 * 通知範囲を取得する
	 */
	public function visibleTo()
	{
		return $this->visibility;
	}
	/**
	 * 送信先を登録する
	 * 
	 * @param string 送信先メールアドレス
	 * @return bool
	 */
	public function addSendTo($val)
	{
		$this->sendTo[] = $val;
		return true;
	}
	/**
	 * 送信先を確認する
	 * 
	 * @return array 連絡先メールアドレス一覧
	 */
	public function getSendTo()
	{
		return $this->sendTo;
	}
	/**
	 * 件名をセットする
	 * 
	 * @var string
	 */
	public function setTitle($val)
	{
		$this->title = $val;
		return true;
	}
	/**
	 * セットした件名を取得する
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}
	/**
	 * 本文をセットする
	 * 
	 * @var string
	 */
	public function setBody($val)
	{
		$this->body = $val;
		return true;
	}
	/**
	 * セットした本文を取得する
	 *
	 * @return string
	 */
	public function getBody()
	{
		return $this->body;
	}
	/**
	 * メール情報を取得する（データ登録用）
	 * 
	 * @return array|bool ('visible'=>'ind','to'=>array('***@gmail.com','***@gmail.com'),'title'=>'タイトル','body'=>'本文')
	 */
	public function getMailData()
	{
		if ($this->visibility!=='all' && $this->sendTo == array()) {
			return false;
		}
		if ($this->title=='' || $this->body=='') {
			return false;
		}
		return array(
			'visible'=>$this->visibility,
			'to'=>$this->sendTo,
			'title'=>$this->title,
			'body'=>$this->body
		);
	}
	/**
	 * メールを送る
	 */
}
