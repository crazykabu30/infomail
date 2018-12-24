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
 * var string
 */
$current_path = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/src/AdminPage/index.php';
/** 
 * reqire_page
 *
 * @var string
$require_page = array (
	'index' => __DIR__ . '/html/index.php',
	'detail' => __DIR__ . '/html/detail.php',
	'archieves' => __DIR__ . '/html/archieves.php',
	'createMail' => __DIR__ . '/html/createMail.php',
	'sendMail' => __DIR__ . '/html/sendMail.php'
);
 */
$require_page = array (
	'/index' => './html/index.php',
	'/detail' => './html/detail.php',
	'/archieves' => './html/archieves.php',
	'/createMail' => './html/createMail.php',
	'/sendMail' => './html/sendMail.php'
);
// if($_SERVER['REQUEST_METHOD']=='POST'){}
// var_dump($path_info);
// var_dump($require_page[$path_info]);
// exit;
require $require_page[$path_info];
