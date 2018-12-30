<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">

<!-- パス？ -->
	<link rel="stylesheet" href="./html/style/style.css">
	<title>メール</title>
</head>
<body>

<!-- オンクリックイベント -->
<div id="open" class="btn">新規メール</div>

<!-- クラス名？ -->
<div class="content-title">
<!-- パス？ -->
	<img class="status" src="./html/image/Folder-open.svg">
<!-- クラス名？ -->
	<div class="text">今日のお知らせ</div>
</div>
<!-- クラス名？ -->
<div class="newinfo_title">
</div>
<?php
	foreach (array_keys($data) as $key) {
		echo <<< EOT
<div class="newinfo_title">
	<img src="./html/image/Mail-close.png"><a href="./index.php/detail?id={$key}">{$data[$key]['datetime']}{$data[$key]['title']}</a>
</div>
EOT;
}
?>
<div id="BK" class="open content-title">
	<img id="BK_icon" class="status" src="./html/image/BK-Folder-open.svg">
	<div class="text">過去のお知らせ</div>
	<a href="./index.php/archieves?page=1">過去のお知らせ</a>
</div>
</body>
</html>
