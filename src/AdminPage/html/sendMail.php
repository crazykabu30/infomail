<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
</head>
<body>
	<h2>sendMail</h2>
	<p>for_all: <?= $_SESSION['for_all'] ?></p>
	<p>mailto: <?php var_dump($_SESSION['mailto']); ?></p>
	<p>title: <?= $_SESSION['title'] ?></p>
	<p>body: <?= $_SESSION['body'] ?></p>
	
	<a href=<?=$current_path . '/index'?>>index</a>
	<a href=<?=$current_path . '/detail'?>>detail</a>
	<a href=<?=$current_path . '/archieves'?>>archieves</a>
	<a href=<?=$current_path . '/createMail'?>>createMail</a>
	<a href=<?=$current_path . '/sendMail'?>>sendMail</a>
</body>
</html>
