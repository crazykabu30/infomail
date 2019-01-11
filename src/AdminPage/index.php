<?php

include_once '../Database/MailDb.php';

use InfoMail\Database\MailDb;

/** 
 * PATH_INFO ether one of the followings
 * - index
 * - detail
 * - archieves
 * - createMail
 * - sendMail
 * 
 * @var string
 */
if (!isset($_SERVER['PATH_INFO']) || $_SERVER['PATH_INFO']=='/') {
	$path_info = '/index';
} else {
	$path_info = $_SERVER['PATH_INFO'];
}
/**
 * @var string
 */
$current_path = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/src/AdminPage';
/**
 * @var string
 */
$current_page = $current_path . '/index.php';
/** 
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
		return $obj->getArchieves($_GET['page'],false);
	}
	if ($path=='/createMail') {
		$obj = new MailDb;
		$obj->setAcl('admin');
		return array('terminals'=>$obj->getTerminals(), 'oids'=>$obj->getOids());
	}
}
$data = getData($path_info);
/** 
 * reqire_page
 *
 * @var string
 */
$require_page = array (
	'/index' => 'html/index.php',
	'/detail' => 'html/detail.php',
	'/archieves' => 'html/archieves.php',
	'/createMail' => 'html/createMail.php',
	'/sendMail' => 'html/sendMail.php'
);
// if($_SERVER['REQUEST_METHOD']=='POST'){}
// html読み込み
// var_dump($require_page);
// var_dump($path_info);
// var_dump($_GET['id']);
// var_dump($data);
// exit;

require $require_page[$path_info];
