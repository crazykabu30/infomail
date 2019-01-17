<?php

include_once './function.php';

/** 
 * PATH_INFO ether one of the followings
 * - index
 * - detail
 * - archieves
 * - createMail
 * - confirm
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
	'/confirm' => 'html/confirm.php',
	'/sendMail' => 'html/sendMail.php'
);
/* html読み込み */
require $require_page[$path_info];
