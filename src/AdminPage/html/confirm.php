<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>確認</title>
</head>
<body>
	<h2>入力内容</h2>
	<p>あて先: <?= $data['to'] ?></p>
	<p>タイトル:</p>
	<p><?= nl2br($data['title']) ?></p>
	<p>本文:</p>
	<p><?= nl2br($data['body']) ?></p>
	<button onclick="location.href='<?=$current_path . '/sendMail'?>';">送信</button>
</body>
</html>
