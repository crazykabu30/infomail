<!doctype html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./html/style/style.css">
	<title>過去のお知らせ</title>
</head>
<body>
	<table>
		<tr>
			<th>日付</th><th>件名</th>
		</tr>

<?php
foreach (array_keys($data) as $key) {
	echo <<< EOT
<tr>
	<td>{$data[$key]['date']}</td>
	<td><a href="../index.php/detail?id={$key}">{$data[$key]['title']}</a></td>
</tr>
EOT;
}
?>	
	</table>
</body>
</html>
