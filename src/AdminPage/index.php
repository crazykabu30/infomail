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
$current_path = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/src/AdminPage/index.php';
/** 
 * reqire_page
 *
 * @var string
 */
$require_page = array (
	'/index' => './html/index.php',
	'/detail' => './html/detail.php',
	'/archieves' => './html/archieves.php',
	'/createMail' => './html/createMail.php',
	'/sendMail' => './html/sendMail.php'
);
// if($_SERVER['REQUEST_METHOD']=='POST'){}
// html読み込み
require $require_page[$path_info];
