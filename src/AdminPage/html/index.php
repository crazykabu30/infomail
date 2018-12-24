<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../html/style/style.css">
	<!--script src="../../script/mail_post.js"></script-->
	<title>メール</title>
</head>
<body>
<div id="open" class="btn">新規メール</div>
<div class="content-title">
	<img class="status" src="../html/image/Folder-open.svg">
	<div class="text">今日のお知らせ</div>
</div>
<div class="newinfo_title">
	<img src="../html/image/Mail-close.png"><a href="/index.php/">メール1</a>
</div>
<?php
	for ($i = 0 ; $i < count($today_mid); $i++) {
		echo <<< EOT
<div class="newinfo_title">
	<img src="../html/image/Mail-close.svg"><a href="/mail_form.php/$today_mid[$i]">$today_mtitle[$i]</a>
</div>
EOT;
}
?>
<div id="BK" class="open content-title">
	<img id="BK_icon" class="status" src="../html/image/BK-Folder-open.svg">
	<div class="text">過去のお知らせ</div>
</div>
<div class="archievinfo_link">
	<a></a>
</div>
<div id="mask" class="hidden"></div>
<!--script src="../../script/mail_form.js"></script-->

	<h2>index</h2>
	<a href=<?=$current_path . '/index'?>>index</a>
	<a href=<?=$current_path . '/detail'?>>detail</a>
	<a href=<?=$current_path . '/archieves'?>>archieves</a>
	<a href=<?=$current_path . '/createMail'?>>createMail</a>
	<a href=<?=$current_path . '/sendMail'?>>sendMail</a>
</body>
</html>