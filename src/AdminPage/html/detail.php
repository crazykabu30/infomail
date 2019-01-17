<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?=$current_path?>/html/style/style.css">
	<title>メール</title>
</head>
<body>
	<h2 class='title'><?=$data['title']?></h2>
	<p><?= $data['date'] ?> - <?= $data['time'] ?></p>
	<p><?= nl2br($data['body']) ?></p>
	<!-- パス -->
	<button onclick="history.back();">戻る</button>
</body>
</html>
