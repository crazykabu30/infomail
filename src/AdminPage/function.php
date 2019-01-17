<?php 

include_once '../Database/MailDb.php';

use InfoMail\Database\MailDb;

/**
 * [sendMail-onLoad]
 * ラジオボタンの値に応じて、確認画面に出力する車両番号を取得
 *
 * @return array
 */
function getTerminalName()
{
	if (!isset($_POST)) {return false;}
	if ($_POST['radio']=='all') {return false;}
	$obj = new MailDb;
	$obj->setAcl('admin');
	$terminals = $obj->getTerminals();
	if ($_POST['radio']=='ind') {
		// 画面に表示するための宛名一覧を取得
		if (count($_POST['ind'])==0) {return false;}
		$name = array();
		foreach ($_POST['ind'] as $id) {
			$name[] = $terminals[$id];
		}
		return $name;
	}
	$oids = $obj->getOids();
	if ($_POST['radio']=='out') {
		$name = array();
		// 画面に「出勤者（●●以外）」と表示するため、
		// 当日出勤者のうち選択から外した端末の一覧を取得
		$outs = $_POST['out'];
		foreach ($oids as $oid) {
			if (in_array($oid,$outs,true)) {
				// 処理なし
			} else {
				$name[] = $terminals[$oid];
			}
		}
		if (count($_POST['out'])==0) {return false;}
		return $name;
	}
}
/** 
 * DBの挿入する値を $_SESSION にセットする
 * 
 * @return bool
 */
function setSession() 
{
	session_start();
	if ($_POST['radio'] == 'all') {
		$_SESSION['for_all'] = '1';
	} else {
		$_SESSION['for_all'] = '0';
	}
	$_SESSION['title'] = $_POST['mail-title'];
	$_SESSION['body'] = $_POST['mail-body'];
	/* あて先アドレス取得 */
	$mailto = array();
	$obj = new MailDb;
	$obj->setAcl('admin');
	if ($_POST['radio'] == 'all') {
		$ids = $obj->getTerminals();
	} else {
		$ids = $_POST[$_POST['radio']];
	}
	foreach ($ids as $id) {
		if ($obj->getAddress($id)) {
			$mailto[] = $obj->getAddress($id);
		}
	}
	$_SESSION['mailto'] = $mailto;
	unset($obj);
	return true;
}
/** 
 * @return string new-mail-content-id
 */
function insertMailData()
{
	$obj = new MailDb;
	$obj->setAcl('admin');
	return $obj->insertMail(
		$_SESSION['for_all'],
		$_SESSION['title'],
		$_SESSION['body']
	);
}
/** 
 * @param string new-mail-content-id
 * @param time 
 */
function sendMail($id,$time)
{
	# 先頭文字列をタイトルから切り出す
	$str = $_SESSION['title'];
	$title = '[通知]' . $str;
	$content = <<< _content_
[新しいお知らせ]
件名：{$title}
時間：
本文：

_content_;
	mb_language('ja');
	mb_internal_encoding('UTF-8');
	foreach ($_SESSION['mailto'] as $address) {
		mb_send_mail($address,$title,$content);
	}
}
/** 
 * 画面描画に必要なデータを取得
 *
 * @var string path-info
 * @return array required-content-data
 */
function getData ($path)
{
	if ($path=='/index') {
		$obj = new MailDb;
		return $obj->getTodayMails();
	}
	if ($path=='/detail') {
		$obj = new MailDb;
		return $obj->getMailContet($_GET['id']);
	}
	if ($path=='/archieves') {
		$obj = new MailDb;
		$obj->setAcl('admin');
		$cur_pg = (int)$_GET['page'];
		$first_pg = 0;
		$prev_pg = 0;
		$max_pg = $obj->getCountArchieves(false);
		$next_pg = 0;
		$last_pg = 0;
		if ($cur_pg > 1) {$first_pg = 1;}
		if ($cur_pg > 1) {$prev_pg = $cur_pg - 1;}
		if (($max_pg - $cur_pg) > 0) {$next_pg = $cur_pg + 1;}
		if (($max_pg - $cur_pg) > 0) {$last_pg = $max_pg;}
		return array(
			'contents' => $obj->getArchieves($_GET['page'],false),
			'cur' => $cur_pg,
			'first' => $first_pg,
			'prev' => $prev_pg,
			'next' => $next_pg,
			'last' => $last_pg
		);
	}
	if ($path=='/createMail') {
		$obj = new MailDb;
		$obj->setAcl('admin');
		return array(
			'terminals'=>$obj->getTerminals(), 
			'oids'=>$obj->getOids()
		);
	}
	if ($path=='/confirm') {
		$name = getTerminalName();
		switch ($_POST['radio']) {
			case 'all':
				$to = '全員';
				break;
			case 'out':
				$to = '出勤者';
				if ($name) {$to = $to . '（' . implode('、',$name) .' 以外）';}
				break;
			case 'ind':
				$to = implode('、',$name);
				break;
			default:
				// 処理なし
				break;
		} 
		setSession();
		return array (
			'to' => $to,
			'title' => $_POST['mail-title'],
			'body' => $_POST['mail-body']
		);
	}
	if ($path=='/sendMail') {
		session_start();
		$val = insertMailData();
		sendMail($val['id'],$val['time']);
		// unset($_SESSION);
		// トップページに遷移
	}
}
