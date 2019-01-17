<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?=$current_path?>/html/style/style.css">
	<title>メール</title>
</head>
<body>

<div id="open" class="btn" onclick="location.href='<?=$current_page?>/createMail';">新規メール</div>

<div class="content-title">
	<img class="status" src="<?=$current_path?>/html/image/Folder-open.svg">
	<div class="text">今日のお知らせ</div>
</div>
<?php
// var_dump($data);
// exit;
	foreach (array_keys($data) as $key) {
		echo <<< EOT
<div class="newinfo_title">
	<img src="{$current_path}/html/image/Mail-close.png"><a>{$data[$key]['time']}</a><a href="{$current_page}/detail?id={$key}">{$data[$key]['title']}</a>
</div>
EOT;
}
?>
<div id="BK" class="open content-title">
	<img id="BK_icon" class="status" src="<?=$current_path?>/html/image/BK-Folder-open.svg">
	<div class="text" onclick="location.href='<?=$current_page?>/archieves?page=1';">過去のお知らせ</div>
</div>
</body>
</html>
