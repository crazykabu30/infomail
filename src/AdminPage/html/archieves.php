<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?=$current_path?>/html/style/style.css">
	<title>過去のお知らせ</title>
</head>
<body>
<div class="main">
<div class="content-title">
	<img class="status" src="<?=$current_path?>/html/image/Folder-open.svg">
<!-- クラス名？ -->
	<div class="text">過去のお知らせ</div>
</div>
<?php
foreach (array_keys($data['contents']) as $key) {
	echo <<< EOT
<div class="newinfo_title">
<img src="{$current_path}/html/image/Mail-close.png"><a>{$data['contents'][$key]['date']}</a><a href="{$current_page}/detail?id={$key}">{$data['contents'][$key]['title']}</a>
</div>
EOT;
}
?>
<a<?php
if ($data['first']>0) {
	echo ' class="active-link" href="' . $current_page . '/archieves?page=' . (string)$data['first'] . '"';
}
 ?>><<</a> <a<?php
if ($data['prev']>0){echo ' class="active-link" href="' . $current_page . '/archieves?page=' . (string)$data['prev'] . '"';}
 ?>><</a>  <?= (string)$data['cur'] ?> page  <a<?php
if ($data['next']>0){echo ' class="active-link" href="' . $current_page . '/archieves?page=' . (string)$data['next'] . '"';}
 ?>>></a> <a<?php
if ($data['last']>0){echo ' class="active-link" href="' . $current_page . '/archieves?page=' . (string)$data['last'] . '"';}
 ?>>>></a>
</div>
</body>
</html>
